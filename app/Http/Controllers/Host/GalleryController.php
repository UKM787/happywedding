<?php

namespace App\Http\Controllers\Host;

use App\Models\Host\Host;
use App\Models\Gallery;
use App\Models\Album;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Models\Host\Invitation;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()  {

        $host = auth()->guard('host')->user();
        $host = Host::where('id', $host->id)->with('profile')->first();
        $invitation=$host->invitations->first();
        $invitations=$host->invitations->first();
        $active = 'gallery';

        if($invitations == null){
                return redirect(route('hostinvitations.index'));
            }

        if(isset($invitations)){
            $albums=Album::with('images')->where('invitation_id',$invitations->id)->get();
            $galleries=Gallery::with(['invitation','album'])->where('invitation_id',$invitations->id)->get();
            $videos=Video::where('invitation_id',$invitations->id)->get();
        }
        else{
            $galleries=[];
            $videos=[];
            return "<h1> Please create invitation</h1>";
        }
        
        return view('host.gallery.index', compact('host','albums','invitations','galleries','videos', 'active', 'invitation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invitation $invitation) {
        $host = auth()->guard('host')->user();
        return view('host.gallery.create', compact('host', 'invitation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $host = auth()->guard('host')->user();
            $invitations = $host->invitations->first();

            $this->validate($request, [
                'galleryImage' => 'required',
                'galleryImage.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
            ]);

            // Make sure the directory exists
            $uploadPath = public_path('files/' . $invitations->id);
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($request->hasFile('galleryImage')) {
                foreach ($request->file('galleryImage') as $image) {
                    $name = time() . rand(1, 100) . '.' . $image->extension();
                    $image->move($uploadPath, $name);
                    $gallery = new Gallery();
                    $gallery->imageName = $name;
                    $gallery->invitation_id = $invitations->id;
                    
                    // album_id can now be null
                    $gallery->album_id = $request->albumId ?: null;
                    
                    $gallery->save();
                }
            }

            $albums = Album::with('images')->where('invitation_id', $invitations->id)->get();
            $galleries = Gallery::with(['invitation', 'album'])->where('invitation_id', $invitations->id)->get();
            $videos = Video::where('invitation_id', $invitations->id)->get();
            
            return [$albums, $galleries, $videos];
        } catch (\Exception $e) {
            \Log::error('Gallery upload error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createAlbum(Request $request){
        try {
            $host = auth()->guard('host')->user();
            $validated = $request->validate([
                'album' => 'required|string|max:255',
                'galleryImage'=>'required',
                'galleryImage.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            ], [], [
                'galleryImage.*' => 'Images'
            ]);

            $invitations = $host->invitations->first();
            if (!$invitations) {
                return response()->json(['error' => 'No invitation found'], 400);
            }

            $albumName = ucfirst(strtolower($request->album));
            $album = Album::where('name', $albumName)->where('invitation_id', $invitations->id)->first();

            if (!isset($album)) {
                $album = new Album();
                $album->name = $albumName;
                $album->description = "Image Collection";
                $album->coverimage = "default";
                $album->invitation_id = $invitations->id;
                $album->save();
            }

            // Make sure the directory exists
            $uploadPath = public_path('files/' . $invitations->id);
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($request->hasFile('galleryImage')) {
                foreach ($request->file('galleryImage') as $image) {
                    $name = time() . rand(1, 100) . '.' . $image->extension();
                    $image->move($uploadPath, $name);
                    $gallery = new Gallery();
                    $gallery->imageName = $name;
                    $gallery->invitation_id = $invitations->id;
                    $gallery->album_id = $album->id;
                    $gallery->save();
                }
            }

            $albums = Album::with('images')->where('invitation_id', $invitations->id)->get();
            $galleries = Gallery::with(['invitation','album'])->where('invitation_id', $invitations->id)->get();
            $videos = Video::where('invitation_id', $invitations->id)->get();

            return [$albums, $galleries, $videos];
        } catch (\Exception $e) {
            \Log::error('Album creation error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function videoStore(Request $request)
    {
        try {
            $host = auth()->guard('host')->user();
            $request->validate([
                'galleryVideo'=>'required',
                'galleryVideo.*' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,video/webm,video/ogg|max:10240'
            ], [], [
                'galleryVideo.*' => 'Videos'
            ]);

            $invitations = $host->invitations->first();
            if (!$invitations) {
                return response()->json(['error' => 'No invitation found'], 400);
            }

            // Make sure the video directory exists
            $uploadPath = public_path('videos/' . $invitations->id);
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($request->hasFile('galleryVideo')) {
                foreach ($request->file('galleryVideo') as $video) {
                    $exten = $video->extension();
                    $videoName = time() . rand(1, 100) . '.' . $exten;
                    $video->move($uploadPath, $videoName);
                    $videoModel = new Video();
                    $videoModel->name = $videoName;
                    $videoModel->invitation_id = $invitations->id;
                    $videoModel->save();
                }
            }

            $albums = Album::with('images')->where('invitation_id', $invitations->id)->get();
            $galleries = Gallery::with(['invitation','album'])->where('invitation_id', $invitations->id)->get();
            $videos = Video::where('invitation_id', $invitations->id)->get();

            return [$albums, $galleries, $videos];
        } catch (\Exception $e) {
            \Log::error('Video upload error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($gallery)
    {
        $host = auth()->guard('host')->user();
        $image=Gallery::find($gallery);
        unlink("files/$host->id/$image->imageName");
        $image->delete();
        return redirect()->route('hostgallery.index',$host)
                        ->with('success','Image deleted successfully');

    }

    public function videoDestroy($gallery)
    {
        $host = auth()->guard('host')->user();
        $image=Video::find($gallery);
        // dd($gallery);
        // dd($image->name);
            unlink("videos/$host->id/$image->name");
        $image->delete();
        return redirect()->route('hostgallery.index',$host)
                        ->with('success','Image deleted successfully');
    }

    // public function deleteAlbum(Host $host,$album){

    //     $album=Album::find($album);
    //     if(isset($album)){
    //         foreach($album->images as $image){
    //             if($image->video==0){
    //                 unlink("files/$host->id/$image->imageName");
    //                 $image->delete();
    //             }
    //             else{
    //                 unlink("videos/$host->id/$image->imageName");
    //                 $image->delete();
    //             }
    //         }
    //     }
    //     $album->delete();
    //     return redirect()->route('hostgallery.index',$host)
    //                     ->with('success','Album deleted successfully');


    // }
}



