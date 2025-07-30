<?php

namespace App\Http\Controllers\Host;

use Exception;
use App\Models\Host\Host;
use App\Models\Host\Story;
use App\Models\SiteDefault;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Host\Invitation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;

class StoryController extends Controller
{

    use ImageUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($invi = null)   {

        if (auth()->guard('host')->check()) {
            if($invi == null){
                return redirect(route('hostinvitations.index'));
            }
            $host = auth()->guard('host')->user();
            $host = Host::where('id', $host->id)->with('profile')->first();
            $invitation = Invitation::where('slug', $invi)->first();
            $story = $invitation->story;
            $active = 'ourstory';
            return view('host.invitation.story.index', compact('host', 'invitation', 'story', 'active'));
            // if ($invitation->story != null ) {
            //     $story = $invitation->story;
            //     return view('host.invitation.story.index', compact('host', 'invitation', 'story'));
            // }
            // else {
            //     //return redirect()->route('hoststory.create', [$host, $invitation]);
            //     $story = new Story();
            //     $imageOne = SiteDefault::where('name', 'storyimageone')->inRandomOrder()->first()->img;
            //     $imageTwo = SiteDefault::where('name', 'storyimagetwo')->inRandomOrder()->first()->img;
            //     $imageThree = SiteDefault::where('name', 'storyimagethree')->inRandomOrder()->first()->img;
            //     $imageFour = SiteDefault::where('name', 'storyimagefour')->inRandomOrder()->first()->img;
            //     $imageFive = SiteDefault::where('name', 'storyimagefive')->inRandomOrder()->first()->img;
            //     $imageSix = SiteDefault::where('name', 'storyimagesix')->inRandomOrder()->first()->img;
            //     return view('host.invitation.story.create', compact('host', 'invitation', 'story', 'imageOne', 'imageTwo', 'imageThree', 'imageFour', 'imageFive', 'imageSix'));
            // }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invitation $invitation)  {
        $host = auth()->guard('host')->user();
        $story = new Story();
        $imageOne = SiteDefault::where('name', 'storyimageone')->inRandomOrder()->first()->img;
        $imageTwo = SiteDefault::where('name', 'storyimagetwo')->inRandomOrder()->first()->img;
        $imageThree = SiteDefault::where('name', 'storyimagethree')->inRandomOrder()->first()->img;
        $imageFour = SiteDefault::where('name', 'storyimagefour')->inRandomOrder()->first()->img;
        $imageFive = SiteDefault::where('name', 'storyimagefive')->inRandomOrder()->first()->img;
        $imageSix = SiteDefault::where('name', 'storyimagesix')->inRandomOrder()->first()->img;
        return view('host.invitation.story.create', compact('host', 'invitation', 'story','imageOne','imageTwo','imageThree','imageFour','imageFive','imageSix'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Invitation $invitation, Request $request, Story $currentStory)  {
        //dd($request->file('images'));
        $data =  $this->requestValidate($request);
        $destImgPath = 'Uploads/'.$invitation->host->slug.'/'.$invitation->slug ;

        if (auth()->guard('host')->check()) {
            $host = auth()->guard('host')->user();
            try {
                if(isset($data['images'])){
                    unset($data['images']);
                }
                
                $story = Story::create($data + ['invitation_id' => $invitation->id, 'slug' => Str::slug($invitation->brideName .'-'.$invitation->groomName.'-story'.rand(1, 10000))]);
                //dd($story);
                if ($story) {
                    if ($request->file('groom_image') !== null ) {
                        $this->storeImage($story, $destImgPath, 'groom_image', $currentStory);
                    }
                    if ($request->file('bride_image') !== null ) {
                        $this->storeImage($story, $destImgPath, 'bride_image', $currentStory);
                    }
                    if ($request->file('first_meet_image') !== null ) {
                        $this->storeImage($story, $destImgPath, 'first_meet_image', $currentStory);
                    }
                    if ($request->file('relation_start_image') !== null ) {
                        $this->storeImage($story, $destImgPath, 'relation_start_image', $currentStory);
                    }
                    if ($request->file('marriage_decide_image') !== null) {
                        $this->storeImage($story, $destImgPath, 'marriage_decide_image', $currentStory);
                    }
                    if ($request->file('images')!= null) {
                        $imgArr = [];
                        foreach($request->file('images') as $single){
                            $time = time().rand(1,100);
                            $single->move(public_path($destImgPath.'/'), $story->slug.'-'.$time.'.png');
                            $name = $destImgPath.'/'.$story->slug.'-'.$time.'.png';
                            array_push($imgArr, $name);
                        }
                        //dd($imgArr);
                        $story->update(['images' => $imgArr]);
                    }
                    // if ($request->file('images')!== null) {
                    //     foreach($request->file('images') as $single){
                    //         $this->storeImage($story, $destImgPath, 'imageSix', $currentStory);
                    //     }
                    // }
                }
                $storyCurrent = Story::where('id', $story->id)->first();
               return response([
                        'message' => $host->name . ' Savedate created successfully, Add our story for wedding' ,
                        'data' => $storyCurrent
                ]);
            } catch (Exception $e) {
                //sdd($e);
                return response([
                        'message' => $e->getMessage() ,
                ], 422);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation, Story $story) {
        $host = auth()->guard('host')->user();
        $storyImages = ['banner' => $story->imageOne, 'metone' => $story->imageTwo, 'mettwo' => $story->imageThree, 'base' => $story->imageFour, 'slide' => $story->imageFive, 'final' => $story->imageSix];
        return view('host.invitation.story.show', compact('host', 'invitation','story','storyImages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation, Story $story)  {
        $host = auth()->guard('host')->user();
        $imageOne = ''; $imageTwo=''; $imageThree=''; $imageFour=''; $imageFive=''; $imageSix='';
        return view('host.invitation.story.edit', compact('host', 'invitation', 'story','imageOne', 'imageTwo', 'imageThree', 'imageFour', 'imageFive', 'imageSix'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Invitation $invitation, Story $story, Request $request){

        //dd($request->images);
        $data =  $this->requestValidate($request);
        $imgOne = $story->groom_image;
        $imgTwo = $story->bride_image;
        $imgThree = $story->first_meet_image;
        $imgFour = $story->relation_start_image;
        $imgFive = $story->marriage_decide_image;
        //$imgSix = $story->imageSix;
        if(isset($data['images'])){
            unset($data['images']);
        }
        $oldStory = $story;

        //dd($data);
        $destImgPath = 'Uploads/'.$invitation->host->slug.'/'.$invitation->slug ;

        if (auth()->guard('host')->check()) {
            $host = auth()->guard('host')->user();
            try {
                $newstory = $story->update($data + ['invitation_id' => $invitation->id]);
                if ($newstory) {
                    if ($request->file('groom_image') !== null) {
                        $this->storeImage($oldStory, $destImgPath, 'groom_image', $imgOne);
                    }
                    if ($request->file('bride_image') !== null) {
                        $this->storeImage($oldStory, $destImgPath, 'bride_image', $imgTwo);
                    }
                    if ($request->file('first_meet_image') !== null) {
                        $this->storeImage($oldStory, $destImgPath, 'first_meet_image', $imgThree);
                    }
                    if ($request->file('relation_start_image') !== null) {
                        $this->storeImage($oldStory, $destImgPath, 'relation_start_image', $imgFour);
                    }
                    if ($request->file('marriage_decide_image') !== null) {
                        $this->storeImage($oldStory, $destImgPath, 'marriage_decide_image', $imgFive);
                    }
                    
                    if ($request->file('images')!== null) {
                        $imgArr = [];
                        foreach($request->file('images') as $single){
                            $time = time().rand(1,100);
                            $single->move(public_path($destImgPath.'/'), $oldStory->slug.'-'.$time.'.png');
                            $name = $destImgPath.'/'.$oldStory->slug.'-'.$time.'.png';
                            array_push($imgArr, $name);
                        } 
                        $existing = $story->images;
                        $add = array_merge($existing, $imgArr);
                        $story->update(['images' => $add]);
                    }
                }
                $story = Story::where('id', $story->id)->first();
                return response([
                        'message' => $host->name . ' Savedate updated successfully' ,
                        'data' => $story
                ]);
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

    private function requestValidate($request)  {
        $data = $request->all();
        //dd($request->all());
        return $request->validate([
            'groom_desc'             => ['required', 'string', 'min:10'],
            'bride_desc'            => ['required', 'string', 'min:10'],
            'first_meet'             => ['sometimes', 'string', 'min:10'],
            'relation_start'             => ['sometimes', 'string', 'min:10'],
            'marriage_decide'             => ['sometimes', 'string', 'min:10'],
            'first_meet_date'             => ['sometimes', 'string'],
            'relation_start_date'             => ['sometimes', 'string'],
            'marriage_decide_date'             => ['sometimes', 'string'],
            'groom_image'              =>  'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bride_image'              =>  'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'first_meet_image'            =>  'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'relation_start_image'             =>  'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'marriage_decide_image'             =>  'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*'             =>  'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[], [
            'images.*' => 'Images',
        ]);
    }

    // Check how the image paths are being stored
    public function storeImage($story, $destImgPath, $field, $currentImage = null) {
        if (request()->hasFile($field)) {
            // Generate a unique filename with field name to avoid collisions
            $file = request()->file($field);
            $uniqueId = time() . rand(1, 1000); // Add more randomness
            $filename = $story->slug . '-' . $field . '-' . $uniqueId . '.' . $file->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            if (!file_exists(public_path($destImgPath))) {
                mkdir(public_path($destImgPath), 0777, true);
            }
            
            // Move the file
            $file->move(public_path($destImgPath), $filename);
            
            // Update the story with the new image path
            $story->update([$field => $destImgPath . '/' . $filename]);
            
            return $destImgPath . '/' . $filename;
        }
        return null;
    }

}





