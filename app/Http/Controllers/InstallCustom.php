<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use PDO;
use PDOException;

class InstallCustom extends Controller
{   
    public function index()
    {
        if ($this->checkDatabaseExists(env('DB_DATABASE'))) {
            return redirect()->route('admin.auth.login');
        } else {
            return view('install');
        }
    }

    public function install(Request $request)
    {
        try {
            // التحقق من الاتصال الأساسي بالخادم
            $pdo = $this->check_database_connection($request->DB_HOST, $request->DB_USERNAME, $request->DB_PASSWORD);
            if (!$pdo) {
                return back()->with('error', 'خطأ في الاتصال بخادم قاعدة البيانات.');
            }

            // التحقق من وجود قاعدة البيانات وإنشائها إذا لم تكن موجودة
            $dbExists = $this->checkDatabaseExists($request->DB_DATABASE, $pdo);
            if (!$dbExists) {
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$request->DB_DATABASE}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            }

            // كتابة ملف .env
            $this->writeEnvFile($request);

            // تحديث إعدادات الاتصال في Laravel
            config([
                'database.connections.mysql.host' => $request->DB_HOST,
                'database.connections.mysql.database' => $request->DB_DATABASE,
                'database.connections.mysql.username' => $request->DB_USERNAME,
                'database.connections.mysql.password' => $request->DB_PASSWORD,
            ]);

            // إعادة تهيئة الاتصال
            DB::purge('mysql');
            DB::reconnect('mysql');

            // تنفيذ الـ Migrations
            Artisan::call('migrate', ['--force' => true]);

            // تنفيذ الـ Seeders مع تمرير بيانات الطلب
            Artisan::call('db:seed', [
                '--force' => true,
                '--class' => 'DatabaseSeeder',
                '--admin_f_name' => $request['admin_f_name'] ?? 'Admin',
                '--admin_l_name' => $request['admin_l_name'] ?? 'User',
                '--admin_email' => $request['admin_email'] ?? "admin@admin.com",
                '--admin_password' => $request['admin_password'],
                '--admin_phone' => $request['phone_code'] . $request['admin_phone'],
                '--web_name' => $request['web_name'] ?? 'My Business',
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'تم التثبيت بنجاح!');

        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء التثبيت: ' . $e->getMessage());
        }
    }
    
    private function writeEnvFile($request)
    {
        $key = base64_encode(random_bytes(32));
        $content = "
            APP_NAME=efood
            APP_ENV=live
            APP_KEY=base64:$key
            APP_DEBUG=false
            APP_INSTALL=true
            APP_URL=" . URL::to('/') . "
            
            DB_CONNECTION=mysql
            DB_HOST={$request->DB_HOST}
            DB_PORT=3306
            DB_DATABASE={$request->DB_DATABASE}
            DB_USERNAME={$request->DB_USERNAME}
            DB_PASSWORD={$request->DB_PASSWORD}
            
            CACHE_DRIVER=file
            SESSION_DRIVER=file
            QUEUE_DRIVER=sync";
    
        file_put_contents(base_path('.env'), $content);
    }

    private function check_database_connection($host, $username, $password)
    {
        try {
            $dsn = "mysql:host=$host;charset=utf8mb4";
            $pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
            return $pdo;
        } catch (PDOException $e) {
            return false;
        }
    }

    private function checkDatabaseExists($databaseName, $pdo = null)
    {
        try {
            if ($pdo) {
                $stmt = $pdo->query("SELECT COUNT(*) FROM information_schema.schemata WHERE schema_name = '$databaseName'");
                return $stmt->fetchColumn() > 0;
            }
            
            $result = DB::selectOne("
                SELECT COUNT(*) AS count 
                FROM information_schema.schemata 
                WHERE schema_name = ?
            ", [$databaseName]);
    
            return $result->count > 0 ? 1 : 0;
        } catch (\Exception $ex) {
            return 0;
        }
    }
}