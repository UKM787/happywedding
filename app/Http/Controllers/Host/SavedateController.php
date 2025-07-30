<?php

namespace App\Http\Controllers\Host;

use Exception;
use Carbon\Carbon;
use App\Models\Host\Host;
use App\Models\SiteDefault;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Host\Savedate;
use App\Models\Host\Invitation;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Traits\ImageUpload;

class SavedateController extends Controller {

    use ImageUpload;

    public $counter;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($invi = null) {
        // dd('sss');
        if (auth()->guard('host')->check()) {
            if($invi == null){
                return redirect(route('hostinvitations.index'));
            }
            $host = auth()->guard('host')->user();
            $host = Host::where('id', $host->id)->with('profile')->first();
            $invitation = Invitation::where('slug', $invi)->with('venues')->first();
            $savedate = $invitation->savedate;
            $active = 'savedate';
            return view('host.invitation.savedate.index', compact('host', 'invitation', 'savedate', 'active'));

            // if($invitation->savedate()->count() != 0) {
            //     $now = Carbon::now();
            //     $marriagedate= $invitation->savedate->startDate;
            //     $counter = $now->diffInSeconds($marriagedate);
            //     $data = $invitation->savedate()->get()->toJson();
            //     $savedate = $invitation->savedate;

            //         if($savedate->imageOne != null ){
            //         $pic = asset('storage'.'/'.$savedate->imageOne);
            //         }
            //         return view('host.invitation.savedate.index', compact('host', 'invitation','savedate','pic','counter'));
            // }else {
            //         //return redirect()->route('hostsavedate.create',[$host, $invitation]);
            //         $savedate = new Savedate();
            //         $pic = SiteDefault::where('name', 'savedate')->inRandomOrder()->first()->img;
            //         return view('host.invitation.savedate.create', compact('host', 'invitation', 'savedate', 'pic'));
            // }
        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invitation $invitation) {
        $savedate = new Savedate();
        $host = auth()->guard('host')->user();
        $pic = SiteDefault::where('name', 'savedate')->inRandomOrder()->first()->img;
        return view('host.invitation.savedate.create', compact('host', 'invitation','savedate','pic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Invitation $invitation)
    {
        try {
            $data = $request->validate([
                'imageOne' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'type' => 'nullable|string',
            ]);

            // Create a unique folder structure for this invitation
            $host = auth()->guard('host')->user();

            if (!$host) {
                return response()->json([
                    'message' => 'Authentication failed. Please log in again.',
                    'errors' => ['auth' => ['User not authenticated']]
                ], 401);
            }

            $folderPath = 'Uploads/' . $host->username . '-' . $host->id . '/' . $invitation->slug;

            // Ensure the directory exists
            $fullPath = public_path($folderPath);
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }

            if ($request->hasFile('imageOne')) {
                $file = $request->file('imageOne');

                // Create a unique filename (avoid colons in filename for Windows compatibility)
                $filename = date('Y-m-d_H-i-s') . '-' . $invitation->slug . '-' . time() . '.' . $file->getClientOriginalExtension();

                // Move the file to the public directory
                $file->move($fullPath, $filename);

                // Store the path with forward slashes
                $imagePath = $folderPath . '/' . $filename;
                $data['imageOne'] = str_replace('\\', '/', $imagePath);

                // Log the upload for debugging
                \Log::info('Savedate image uploaded', [
                    'path' => $data['imageOne'],
                    'full_path' => $fullPath . '/' . $filename,
                    'exists' => file_exists($fullPath . '/' . $filename),
                    'url' => asset($data['imageOne'])
                ]);
            }

            // Validate that invitation has a startDate
            if (!$invitation->startDate) {
                return response()->json([
                    'message' => 'Invitation must have a start date before creating save the date.',
                    'errors' => ['startDate' => ['Start date is required']]
                ], 422);
            }

            // Log the data being used for savedate creation
            \Log::info('Creating savedate with data', [
                'invitation_id' => $invitation->id,
                'invitation_startDate' => $invitation->startDate,
                'invitation_slug' => $invitation->slug,
                'imageOne' => $data['imageOne']
            ]);

            // Create the savedate record with all required fields
            $savedate = $invitation->savedate()->create([
                'imageOne' => $data['imageOne'],
                'invitation_id' => $invitation->id,
                'startDate' => $invitation->startDate,
                'slug' => \Str::slug($invitation->startDate . '-' . $invitation->slug),
                'counter' => false,
            ]);

            return response()->json([
                'message' => 'Save the date created successfully',
                'data' => $savedate,
                'image_url' => asset($data['imageOne'])
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Savedate creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'invitation_id' => $invitation->id,
                'host_id' => auth()->guard('host')->id()
            ]);

            return response()->json([
                'message' => 'Failed to create save the date. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation, Savedate $savedate)   {
        $pic = '';
        $host = auth()->guard('host')->user();
      return view('host.invitation.savedate.show',compact('host','invitation','savedate','pic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation, Savedate $savedate)  {
        $pic = '';
        $host = auth()->guard('host')->user();
        return view('host.invitation.savedate.edit', compact('host', 'invitation', 'savedate','pic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Invitation $invitation,Savedate $savedate, Request $request)  {

        $data =  $this->requestValidate($request);
        //$data = $request->all();
        $host = auth()->guard('host')->user();
        $destImgPath = 'Uploads/'.$invitation->host->slug.'/'.$invitation->slug;
        $currentImg = $savedate->imageOne;

        if (auth()->guard('host')->check()) {
            try {
                $newsavedate = $savedate->update($data + ['invitation_id' => $invitation->id, 'startDate' => $invitation->startDate ,'slug' => Str::slug($invitation->startDate .'-'. $invitation->slug)]);
                if ($newsavedate) {
                    if ($request->file('imageOne') != null) {
                        $this->storeImage($savedate, $destImgPath, 'imageOne', $currentImg);
                    }
                }
                $save = Savedate::where('id', $savedate->id)->first();
                return response([
                        'message' => $host->name . ' Savedate updated successfully' ,
                        'data' => $save
                ]);
                // return redirect()->route('hostsavedate.index', [$invitation])
                //     ->with([
                //         'status' => 'success',
                //         'message' => $host->name . ' Savedate updated successfully'
                //     ]);
            } catch (Exception $e) {
                return response([
                        'message' => $e->getMessage() ,
                ], 422);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Storing and updating the guest_image
     *
     * @param  App\Models\Host\Invitation
     * @return \Illuminate\Http\Response
     */

    private function requestValidate($request)   {

        return $request->validate([
            //'startDate'         => ['required', 'date'],
            'imageOne'          => 'exclude_if:type,update|required|image|mimes:jpeg,png,jpg,gif,svg|max:20248',
            'counter'            => ['sometimes']
        ],
        [
               // 'startDate.required'        => ['invitation date and time required', 'date'],
                'imageOne'                  => 'image files size should less than 2MB',
                'counter'                   => ['sometimes']
        ]

        );
    }
}







