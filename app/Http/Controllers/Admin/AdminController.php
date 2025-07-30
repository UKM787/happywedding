<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Exports\Admin\CategoryMasterExport;
use App\Exports\Admin\LocationMasterExport;
use App\Exports\Admin\TaskMasterExport;
use App\Imports\Admin\CategoryMasterImport;
use App\Imports\Admin\TaskMasterImport;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['index', 'export', 'import', 'sample', 'getimport']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('reached index of welcome controller');
        if (auth()->guard('admin')->check()) {
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.welcome', compact('loggedIn'));
        } else {
            return redirect()->route('adminLogin');
        }
    }

    public function getimport(Request $request)
    {
        $type = $request->type;
        $admin = auth()->guard('admin')->user();
        return view('admin.import', compact('admin', 'type'));
    }

    public function import(Request $request, $data)
    {
        $request->validate([
            'excelList' => 'required|mimes:csv,xlsx,xls'
        ]);
        $import =  null;
        $redirect = null;
        $file = null;
        $headings = (new HeadingRowImport(3))->toArray(request()->file('excelList'));
        $columns = $headings[0][0];
        //dd($data);
        if ($data == 'vendors') {
            if (!($columns[0] == 'name' && $columns[1] == 'description' && $columns[2] == 'status' && $columns[3] == 'priority' && $columns[4] == 'parent_id' && $columns[5] == 'image' && $columns[6] == 'icon' && $columns[7] == 'relation' && $columns[8] == 'path' && $columns[9] == 'admin_id')) {
                return redirect()->route('adminvendor.index')->with([
                    'status' => 'success',
                    'message' => 'Kindly select the same format'
                ]);
            }
            $import = new CategoryMasterImport();
            $redirect =  'adminvendor.index';
            $file = 'excelList';
        } elseif ($data == 'tasks') {
            //dd('sss');
            if (!($columns[0] == 'name' && $columns[1] == 'description' && $columns[2] == 'status' && $columns[3] == 'priority' && $columns[4] == 'parent_id' && $columns[5] == 'image' && $columns[6] == 'icon' && $columns[7] == 'admin_id')) {
                return redirect()->route('admintask.index')->with([
                    'status' => 'success',
                    'message' => 'Kindly select the same format'
                ]);
            }
            $import = new TaskMasterImport();
            $redirect =  'admintask.index';
            $file = 'excelList';
        }
        try {
            $import->import(request()->file($file));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            // dd($import->errors(), $failures);
            return redirect()->route($redirect)->with(
                [
                    'errorStatus' => $failures,
                ],
            );
        }
        //dd('done');
        return redirect()->route($redirect)->with([
            'status' => 'success',
            'message' => 'added successfully'
        ]);
    }

    public function export(Request $request, $data)
    {
        if ($data == 'vendors') {
            return Excel::download(new CategoryMasterExport(), 'CategoryMaster.xlsx');
        } elseif ($data == 'locations') {
            return Excel::download(new LocationMasterExport(), 'LocationMaster.xlsx');
        } elseif ($data == 'tasks') {
            return Excel::download(new TaskMasterExport(), 'TaskMaster.xlsx');
        }
    }
    public function sample(Request $request, $data)
    {
        if ($data == 'vendors') {
            $path = public_path('CategoryMaster.xlsx');
            return response()->download($path);
        } elseif ($data == 'tasks') {
            $path = public_path('TaskMaster.xlsx');
            return response()->download($path);
        }
    }
}
