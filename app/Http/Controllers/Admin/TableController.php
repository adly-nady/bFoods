<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Branch;
use App\Model\Table;
use App\CentralLogics\Helpers;
use Brian2694\Toastr\Facades\Toastr;
// use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;



// use Toastr;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class TableController extends Controller
{
    public function __construct(
        private Branch $branch,
        private Table $table,
    ) {}

    /**
     * @param Request $request
     * @return Renderable
     */
    public function list(Request $request): Renderable
    {
        $branches = $this->branch->orderBy('id', 'DESC')->get();
        $search = $request['search'];
        $key = explode(' ', $request['search']);

        $tables = $this->table
            ->with('branch')
            ->when($search!=null, function($query) use($key){
                foreach ($key as $value) {
                    $query->where('number', 'like', "%{$value}%");
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate(Helpers::getPagination());

        return view('admin-views.table.list', compact('tables','search', 'branches'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // ✅ التحقق من البيانات المدخلة
        $request->validate([
            'number'  => [
                'required',
                Rule::unique('tables')->where(fn($query) => 
                    $query->where('number', $request->number)
                        ->where('branch_id', $request->branch_id)
                ),
            ],
            'branch_id' => 'required|exists:branches,id',
            'capacity'  => 'required|integer|min:1|max:99',
        ], [
            'number.required' => translate('Table number is required!'),
            'number.unique' => translate('Table number already exists in this branch!'),
            'capacity.required' => translate('Table capacity is required!'),
            'branch_id.required' => translate('Branch selection is required!'),
        ]);

        DB::transaction(function () use ($request) {
            // ✅ إنشاء الطاولة
            $table = new Table();
            $table->number = $request->number;
            $table->capacity = $request->capacity;
            $table->branch_id = $request->branch_id;
            $table->is_active = 1;
            $table->save();

            // ✅ إنشاء QR Code وحفظه كصورة
            $qrCode = QrCode::create(route('admin.table.scan', ['tableNumber' => $table->id]))
                            ->setSize(300)
                            ->setMargin(10);

            $writer = new PngWriter();
            $qrImage = $writer->write($qrCode)->getString();

            $fileName = "qr_table_{$table->id}.png";
            $filePath = "qrcodes/{$fileName}";

            Storage::disk('public')->put($filePath, $qrImage);

            // ✅ حفظ مسار QR Code في قاعدة البيانات
            $table->qr_code = $filePath;
            $table->save();
        });

        Toastr::success(translate('Table added successfully!'));
        return redirect()->route('admin.table.list');
    }
    
    public function scan($id)
    {
        return $id;
    }
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function status(Request $request): RedirectResponse
    {
        $table = $this->table->find($request->id);
        $table->is_active = $request->status;
        $table->save();

        Toastr::success(translate('Table status updated!'));
        return back();
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $branches = $this->branch->orderBy('id', 'DESC')->get();
        $table = $this->table->where(['id' => $id])->first();

        return view('admin-views.table.edit', compact('table', 'branches'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'number'  => [
                'required',
                Rule::unique('tables')->where(function ($query) use ($request, $id) {
                    return $query->where(['number' => $request->number, 'branch_id' => $request->branch_id])
                        ->whereNotIn('id', [$id]);
                }),
            ],
            'branch_id' => 'required',
            'capacity' => 'required|min:1|max:99',
        ], [
            'number.required' => translate('Table number is required!'),
            'number.unique' => translate('Table number is already exist in this branch!'),
            'capacity.required' => translate('Table capacity is required!'),
            'branch_id.required' => translate('Branch select is required!'),
        ]);

        $table = $this->table->find($id);
        $table->number = $request->number;
        $table->capacity = $request->capacity;
        $table->branch_id = $request->branch_id;
        $table->update();

        Toastr::success(translate('Table updated successfully!'));
        return redirect()->route('admin.table.list');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        $table = $this->table->find($request->id);
        $table->delete();

        Toastr::error(translate('Table removed!'));
        return back();
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $branches = $this->branch->orderBy('id', 'DESC')->get();
        return view('admin-views.table.index2', compact('branches'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getTableListByBranch(Request $request): JsonResponse
    {
        $tables = $this->table
            ->with(['order'=> function ($q){
                $q->whereHas('table_order', function($q){
                    $q->where('branch_table_token_is_expired', 0);
                });
            }])
            ->where(['branch_id' => $request->branch_id, 'is_active' => '1'])
            ->get()
            ->toArray();

        $view = view('admin-views.table.table_available_card2', compact('tables'))->render();

        return response()->json([
            'view' => $view,
        ]);
    }

}
