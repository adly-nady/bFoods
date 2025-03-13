<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use PDO;
use PDOException;

class InstallCustom extends Controller
{
    public function install(Request $request)
    {
        // إنشاء محتوى ملف .env
        $content = "APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST={$request->DB_HOST}
DB_PORT=3306
DB_DATABASE={$request->DB_DATABASE}
DB_USERNAME={$request->DB_USERNAME}
DB_PASSWORD={$request->DB_PASSWORD}

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync";

        // حفظ البيانات في ملف .env
        file_put_contents(base_path('.env'), $content);

        // التحقق من اتصال قاعدة البيانات
        if (!$this->check_database_connection(
            $request->DB_HOST,
            $request->DB_DATABASE,
            $request->DB_USERNAME,
            $request->DB_PASSWORD
        )) {
            return response()->json(['message' => 'Database connection failed!'], 500);
        }

        // تشغيل أوامر Laravel لإعداد المشروع
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('migrate', ['--force' => true]);

        return response()->json(['message' => 'Installation completed successfully!'], 200);
    }

    private function check_database_connection($host, $database, $username, $password)
    {
        try {
            // إنشاء اتصال PDO
            $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return true; // الاتصال ناجح
        } catch (PDOException $e) {
            return false; // فشل الاتصال
        }
    }
}
