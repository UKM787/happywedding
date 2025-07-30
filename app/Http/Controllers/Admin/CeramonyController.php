<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Admin\CeramonyMaster;
use App\Http\Resources\Admin\CeramonyResource;
use App\Models\Host\Ceramony;
use App\Models\Image;

class CeramonyController extends Controller
{
    public $ceramonyCount;

    public function __construct()
    {
        $this->ceramonyCount = CeramonyMaster::count();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ceramonies = CeramonyMaster::latest()->paginate(15);
        //dd($this->ceramonyCount, $ceramonies);
        $loggedIn = auth()->guard('admin')->user();
        return view('admin.ceramonies.index', compact('ceramonies', 'loggedIn'))->with(['i' => (request()->input('page', 1) - 1) * 15, 'ceramonyCount' => $this->ceramonyCount]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loggedIn = auth()->guard('admin')->user();
        $ceramony = new CeramonyMaster();
        $ceracats = CeramonyMaster::pluck('id', 'name');
        return view('admin.ceramonies.create', compact('ceramony', 'ceracats', 'loggedIn'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);
        /*     $destinationPath = 'assets/ceramonies\/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage"; */


        $data = $this->requestValidate($request);
                //dd($data, $data['parent_id'] == 'NULL');
        if ($request->hasfile('imageOne')) {
            $destinationPath = '/assets/defaults/ceramonies/images/';
            $imgData = [];
            foreach ($request->file('imageOne') as $file) {
                $img = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . $destinationPath, $img);
                array_push($imgData, $img);
            }
            $data['imageOne'] = $imgData;
        }else{
            $data['imageOne'] = [];
        }
        // $ceramony = new CeramonyMaster();
        // $ceramony->name = $data['name'];
        // $ceramony->slug = Str::slug($data['name']);
        // $ceramony->admin_id =  auth()->guard('admin')->user()->id;
        // $ceramony->imageFile = json_encode($imgData);
        // $ceramony->image_path = json_encode($imgData);
        // $ceramony->save();
        //CeramonyMaster::create($data + ['slug' => Str::slug($request->name)]);
        //dd($data);
        // $data['imageOne'] = $imgData;
        // $data = $this->requestValidate($request);
        // $data['status'] = $request->input('status') == 'on' ? true : false;
        // $data['admin_id'] = auth()->guard('admin')->user()->id;
        //dd($request->hasFile('imageOne'));

        //dd($data);
        // $arr = [];
        // if ($imageOne = $request->file('imageOne')) {

        //     $destinationPath = 'assets/defaults/vendors/images/';
        //     $locationImage = $data['name'] . '-' . date('YmdHis') . "." . $imageOne->getClientOriginalExtension();
        //     $imageOne->move($destinationPath, $locationImage);
        //     $data['imageOne'] = json_encode("$locationImage");
        // } else {
        //     $data['imageOne'] = 'vendorDefault.png';
        // }
        if($data['parent_id'] == 'NULL') {
            $data['parent_id'] = null;
        }
        $data['status'] = $request->input('status') == 'on' ? true : false;
        $data['admin_id'] = auth()->guard('admin')->user()->id;
        //dd($data);
        if (auth()->guard('admin')->check()) {
            try {
                $ceramony = CeramonyMaster::create($data + ['slug' => Str::slug($request->name)]);
                return redirect()->route('adminceramony.index')
                    ->with([
                        'status' => 'success',
                        'message' => "$ceramony->name created successfully"
                    ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage()
                ]);
            }
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CeramonyMaster $ceramony)
    {
        $loggedIn = auth()->guard('admin')->user();
        return view('admin.ceramonies.show', compact('ceramony', 'loggedIn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CeramonyMaster $ceramony)
    {
        // dd('ss');
        $loggedIn = auth()->guard('admin')->user();
        // $ceramony = new CeramonyMaster();
        $ceracats = CeramonyMaster::pluck('id', 'name');
        return view('admin.ceramonies.edit', compact('ceramony', 'ceracats', 'loggedIn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CeramonyMaster $ceramony)
    {
        //dd($request);
        $data = $this->requestValidate($request);
        $input = $request->all();
        //dd($data);

        if ($image = $request->file('imageOne')) {
            $destinationPath = '/assets/defaults/ceramonies/images/';
            $imgData = [];
           foreach ($request->file('imageOne') as $file) {
                $img = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . $destinationPath, $img);
                array_push($imgData, $img);
            }
            $data['imageOne'] = $imgData;
        } else {
            unset($input['image']);
        }

        if($data['parent_id'] == 'NULL') {
            $data['parent_id'] = null;
        }
        $data['status'] = $request->input('status') == 'on' ? true : false;
        $data['admin_id'] = auth()->guard('admin')->user()->id;

        $ceramony->update($data);

        return redirect()->route('adminceramony.index')
                    ->with([
                        'status' => 'success',
                        'message' => "$ceramony->name updated successfully"
                    ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ceramony = CeramonyMaster::findOrFail($id);
        $ceramony->delete();
        return redirect()->back()->with([
            'status' => 'success',
            'message' => "$ceramony->name deleted successfully"
        ]);
    }

    private function requestValidate($request)
    {
        return $request->validate(
            [
                'name'  => ['required', 'string', 'min:3', 'max:255'],
                //'type'  => ['required', Rule::in(['H', 'O'])],
                'priority' => ['required'],
                'parent_id' => ['required'],
                'status'    => ['required'],
                //'imageOne' => ['required'],
                //'imageFile' => 'required',
                //'imageFile.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
                'imageOne.*' => 'required|mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
            ],
            [
                'name.required' => 'ceramony name is required and minimum character required are 3',
                 'imageOne.required' => 'Image is required',
                'priority.required'  => 'priority needs to be chosen',
                'parent_id.required'  => 'category needs to be chosen',
                'priority.status'  => 'publishing status needed',

            ]
        );
    }
}
