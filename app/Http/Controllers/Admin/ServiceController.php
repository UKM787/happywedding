<?php

namespace App\Http\Controllers\Admin;

use PDO;
use Exception;
use App\Wed\Happy;
use App\Models\Admin\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\ServiceMaster;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Exports\Admin\CategoryMasterExport;
use App\Imports\Admin\CategoryMasterImport;


class ServiceController extends Controller
{

    public $items, $services, $allServices, $locations;

    public function __construct()
    {
        $this->items = ServiceMaster::whereNull('parent_id')->paginate(18);
        $this->services = ServiceMaster::with('children')->get();
        $this->allServices = ServiceMaster::latest()->whereNull('parent_id')->orderBy('parent_id', 'ASC')->orderBy('name', 'ASC')->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (auth()->guard('admin')->check()) {
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.services.index', (['loggedIn' => $loggedIn, 'items' => $this->items, 'services' => $this->services, 'allServices' => $this->allServices, 'activeServices' => Happy::getActiveServices()]))->with('i', (request()->input('page', 1) - 1) * 18);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->guard('admin')->check()) {
            $loggedIn = auth()->guard('admin')->user();
            $service = new ServiceMaster();
            return view('admin.services.create', (['loggedIn' => $loggedIn, 'services' => $this->services, 'service' => $service]));
        }
    }


    public function export(Request $request)
    {
        if ($request->type == 'services') {
            return Excel::download(new CategoryMasterExport(), 'CategoryMaster.xlsx');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (auth()->guard('admin')->check()) {
            if (isset($request->all()['excel'])) {
                $request->validate([
                    'categoryList' => 'required|mimes:csv,xlsx,xls'
                ]);
                $headings = (new HeadingRowImport(3))->toArray(request()->file('categoryList'));
                $columns = $headings[0][0];

                if ($columns[0] == 'name' && $columns[1] == 'description' && $columns[2] == 'status' && $columns[3] == 'priority' && $columns[4] == 'parent_id' && $columns[5] == 'image' && $columns[6] == 'icon' && $columns[7] == 'relation' && $columns[8] == 'path' && $columns[9] == 'admin_id') {
                    $import = new CategoryMasterImport();
                    //dd('ss');
                    try {
                        $import->import(request()->file('categoryList'));
                        //dd(ServiceMaster::all());
                    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                        $failures = $e->failures();
                        //dd($import->errors(), $failures);
                        return redirect()->route('adminservice.index')->with(
                            [
                                'errorStatus' => $failures,
                            ],
                        );
                    }
                    //dd('s');
                    return redirect()->route('adminservice.index')->with([
                        'status' => 'success',
                        'message' => 'added successfully'
                    ]);
                } else {
                    return redirect()->route('adminservice.index')->with([
                        'status' => 'Kindly select the same format',
                        'message' => 'Kindly select the same format'
                    ]);
                    //if not found show error or something
                }
            }

            $data = $this->requestValidate($request);
            $data['parent_id'] = $data['parent_id'] == 'NULL' ? NULL : $request->parent_id;
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $data['slug'] = Str::slug($request->name);

            if ($imageOne = $request->file('imageOne')) {
                $destinationPath = 'assets/defaults/services/images/';
                $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $imageOne->getClientOriginalExtension();
                $imageOne->move($destinationPath, $locationImage);
                $data['imageOne'] = "$locationImage";
            } else {
                $data['imageOne'] = 'serviceDefault.png';
            }
            try {
                ServiceMaster::create($data);
                return redirect()->route('adminservice.index')->with([
                    'status' => 'success',
                    'message' => "$request->name added successfully."
                ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            return redirect()->route('admin.getlogin');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceMaster $service)
    {
        if (auth()->guard('admin')->check()) {
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.services.show', (['service' => $service, 'services' => $this->services, 'loggedIn' => $loggedIn]));
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceMaster $service)
    {
        if (auth()->guard('admin')->check()) {
            $loggedIn = auth()->guard('admin')->user();
            return view('admin.services.edit', (['service' => $service, 'services' => $this->services, 'loggedIn' => $loggedIn]));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceMaster $service, Request $request)
    {
        if (auth()->guard('admin')->check()) {
            $data = $this->requestValidate($request);
            if ($request->parent_id == 'NULL') {
                $data['parent_id'] = $request->parent_id == 'NULL' ? NULL : $data['parent_id'];
            } else {
                $parent_id = ServiceMaster::where('id', '=', $request->parent_id)->first()->parent_id;
                $data['parent_id'] = $parent_id == null ? ($service->id == $request->parent_id ? NULL : $request->parent_id) : $parent_id;
            }
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $data['slug'] = Str::slug($request->name);
            if ($image = $request->file('imageOne')) {
                $destinationPath = 'assets/defaults/services/images/';
                $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $locationImage, 'public');
                $data['imageOne'] = "$locationImage";
            } else {
                unset($data['imageOne']);
            }
            try {
                $service->update($data);
                return redirect()->route('adminservice.index')
                    ->with(['status' => 'success', 'message' => "$request->name updated successfully."]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            return redirect()->route('admin.getlogin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceMaster $service)
    {
        if (auth()->guard('admin')->check()) {
            $service->delete();

            return redirect()->route('adminservice.index')
                ->with(['status' => 'success', 'message' => "$service->name remove successfully"]);
        } else {
            return redirect()->route('admin.getlogin');
        }
    }

    public function requestValidate(Request $request)
    {
        return $this->validate(
            $request,
            [
                'name'    => ['required', 'string', 'min:3', 'max:255'],
                'description'   => ['required', 'string', 'min:3', 'max:255'],
                'priority' => ['required', 'string'],
                'parent_id' => ['sometimes'],
                'status'  => ['required'],
                'icon' => ['sometimes', 'string', 'min:3', 'max:255'],
                'imageOne' => 'Image|sometimes|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'name.required' => 'Service Name is required & minimum 3 characters are required',
                'description.required' => 'Service Business Description required',
                'priority.required' => 'Choose prioirty',
                'parent_id.required' => 'Choose category',
                'status.required' => 'Choose publishing status'
            ]
        );
    }

    public function filter(Request $request)
    {
        $query = ServiceMaster::query();
        $query->when($request->categoryId, function ($q, $categoryId) {
            return $q->where('id', $categoryId);
        });
        //dd($cat);
        //->when($request->order == 'descendantDateOrder', function ($q) {
        //     return $q->orderBy('created_at', 'DESC');
        // })->when(
        //     $request->order == 'ascendantDateOrder',
        //     function ($q) {
        //         return $q->orderBy('created_at', 'ASC');
        //         $ads = $query->get();
        //         return view('ad.index', compact('ads'));
        //     }


        $services = $query->get();
        $items = ServiceMaster::where('id', '=', $services[0]['id'])->paginate(9);
        $allServices = ServiceMaster::with('children')->get();
        $activeServices = Happy::getActiveServices();
        $loggedIn = auth()->guard('admin')->user();
        $admin = auth()->guard('admin')->user();
        $services = ServiceMaster::latest()->whereNull('parent_id')->orderBy('parent_id', 'ASC')->orderBy('name', 'ASC')->get();
        return view('admin.services.index', compact('services', 'items', 'allServices', 'activeServices', 'loggedIn'));
    }
}
