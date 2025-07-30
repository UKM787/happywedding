<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\Admin\CategoryMaster;
use App\Models\Vendor\Service\Accommodation;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedIn = auth()->guard('admin')->user();
        if (Accommodation::all()->isEmpty()) {
            $locations = LocationMaster::orderBy('name', 'ASC')->pluck('id', 'name');
            $categories = CategoryMaster::latest()->whereNotNull('parent_id')->pluck('id', 'name');
            $accommodation = new Accommodation();
            return view('admin.accommodations.create', compact('loggedIn', 'accommodation', 'locations', 'categories'));
        } else {
            $accommodations = Accommodation::latest()->orderBy('name', 'ASC')->paginate(15);
            $locations = LocationMaster::orderBy('name', 'ASC')->pluck('id', 'name');
            return view('admin.accommodations.index')->with(['loggedIn' => $loggedIn, 'accommodations' =>  $accommodations, 'locations' => $locations])->with('i', (request()->input('page', 1) - 1) * 7);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loggedIn = auth()->guard('admin')->user();
        $locations = LocationMaster::orderBy('name', 'ASC')->pluck('id', 'name');
        $categories = CategoryMaster::latest()->whereNotNull('parent_id')->pluck('id', 'name');
        $accommodation = new Accommodation();
        return view('admin.accommodations.create', compact('loggedIn', 'accommodation', 'locations', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->requestValidate($request);

        $data['slug'] = Str::slug($request->name, '-', 'en') . '-' . rand(1, 10000);
        $loggedIn = auth()->guard('admin')->user();
        
        if ($imageOne = $request->file('imageOne')) {
            // Use a consistent approach for all image uploads
            $destinationPath = 'assets/hotels';
            
            // Create directory if it doesn't exist
            if (!file_exists(public_path($destinationPath))) {
                mkdir(public_path($destinationPath), 0755, true);
            }
            
            // Generate a unique filename
            $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $imageOne->getClientOriginalExtension();
            
            // Move the file
            $imageOne->move(public_path($destinationPath), $locationImage);
            
            // Store the path with forward slashes
            $data['imageOne'] = str_replace('\\', '/', $locationImage);
            
            // Log the upload for debugging
            \Log::info('Image uploaded', [
                'original_name' => $imageOne->getClientOriginalName(),
                'path' => $destinationPath . '/' . $locationImage,
                'exists' => file_exists(public_path($destinationPath . '/' . $locationImage))
            ]);
        } else {
            $data['imageOne'] = 'hotelDefault.png';
        }
        
        if (auth()->guard('admin')->check()) {
            $data['category_id'] = empty($request->category_id) ? Null : $request->category_id;
            $data['status'] = $request->status == 'on' ? 1 : 0;
            // dd($data);
            try {
                $loggedIn->accommodations()->create($data);
                return redirect()->route('adminaccommodation.index')
                    ->with([
                        'status' => 'success',
                        'message' => " $loggedIn->name! hotel added successfully"
                    ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => " $loggedIn->name Hotel creation creation failed, Try Again"
                ]);
            }
        } else {
            return back()->with(['status' => 'you need to login first']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Accommodation $accommodation)
    {
        $loggedIn = auth()->guard('admin')->user();
        return view('admin.accommodations.show', compact('accommodation', 'loggedIn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Accommodation $accommodation)
    {
        $loggedIn = auth()->guard('admin')->user();
        $locations = LocationMaster::pluck('id', 'name');
        $accommodations = Accommodation::where('category_id', null)->get();
        $categories = CategoryMaster::latest()->whereNotNull('parent_id')->pluck('id', 'name');
        //dd($venues,$venuecats);
        return view('admin.accommodations.edit', compact('loggedIn', 'locations', 'categories', 'accommodations', 'accommodation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Accommodation $accommodation, Request $request)
    {
        $data = $this->requestValidate($request);
        //dd($data);
        $data['category_id'] = empty($data['category_id']) ? null : $data['category_id'];
        $data['status'] = $request->input('status') == 'on' ? 1 : 0;
        // $data['locationmaster_id'] = $request->locationmaster_id;
        //$data['admin_id'] = auth()->guard('admin')->user()->id;
        $data['slug'] = Str::slug($request->name, '-', 'en') . '-' . rand(1, 10000);
        if ($image = $request->file('imageOne')) {
            $destinationPath = 'assets/hotels';
            $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $locationImage, 'public');
            $data['imageOne'] = "$locationImage";
        } else {
            unset($data['imageOne']);
        }
        $loggedIn = auth()->guard('admin')->user();
        $data['accommodatable_type'] = $accommodation->accommodatable_type;
        $data['accommodatable_id'] = $accommodation->accommodatable_id;
        //dd($data, $accommodation);
        try {
            $accommodation->update($data);
            //dd('reached');
            return redirect()->route('adminaccommodation.index')->with([
                'status' => 'success',
                'message' => " $loggedIn->name! hotel added successfully"
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => 'failure',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accommodation $accommodation)
    {
        $accommodation->delete();
        return redirect()->route('adminaccommodation.index')
            ->with('status', "$accommodation->name deleted successfully");
    }

    /**
     * Storing and updating the guest_image
     *
     * @param  App\Models\Guest\GuestProfile
     * @return \Illuminate\Http\Response
     */

    private function requestValidate($request)
    {

        return $request->validate([
            'name'          =>  ['required', 'string', 'min:3', 'max:255'],
            'description'   =>  ['required', 'string', 'min:3', 'max:1024'],
            'address'       => ['required', 'string', 'min:3', 'max : 255'],
            'longitude'     =>  ['required', 'string', 'min:3', 'max:20'],
            'latitude'      =>  ['required', 'string', 'min:3', 'max:20'],
            'map'           =>  ['required', 'string'],
            'status'        =>  ['sometimes'],
            'priority'      =>  ['sometimes'],
            'icon'          =>  ['required', 'string'],
            'category_id'   =>  ['sometimes'],
            'location_id'   =>  ['required'],
            'imageOne'      => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }
}

