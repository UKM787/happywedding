<?php

namespace App\Http\Controllers\Host;

use Auth;
use App\Models\Admin\Tag;
use App\Models\Host\Host;
use App\Models\SiteDefault;
use Illuminate\Http\Request;
use App\Models\Host\Invitation;
use App\Models\Host\MemberTask;
use App\Models\Admin\Testimonial;
use App\Http\Controllers\Controller;
use App\Models\Host\Ceramony;
use App\Models\Memory;
use Illuminate\Support\Facades\Storage;

class HostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //dd(auth()->guard('host')->user());
        //dd('ss');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
       // dd('reached hostcontroller');
       // Debug: Check if user is authenticated and has subscription
       if (!auth()->guard('host')->check()) {
           return redirect()->route('login')->with('error', 'Please login first');
       }
        $lastShortCode = '';
        $generatedShortCodes = [];
        $guests = [];
        // for ($i = 0; $i < 500000; $i++) {
        //     $shortCode = $this->generateUniqueShortCode($lastShortCode);
        //     if (in_array($shortCode, $generatedShortCodes)) {
        //         echo "Duplicate found: $shortCode\n";
        //         break; // Exit the loop if a duplicate is found
        //     }
        //     array_push($generatedShortCodes, $shortCode);
        //     echo $shortCode . "\n";
        //     $lastShortCode = $shortCode;
        // }
        
        //dd(count($generatedShortCodes));
        
         if (auth()->guard('host')->check()) {
            
            $host = auth()->guard('host')->user();
            $host = Host::where('id', $host->id)->with('profile')->first();
                $invitation = $host->invitations->first();

                $guestCount = 0;
                
                if ($invitation) {
                    $guests = $invitation->guests()
                        ->where('users.deleted_at', null)
                        ->where('guest_invitation.deleted_at', null)
                        ->get();
                    
                    foreach($guests as $guest){
                        if($guest && $guest->pivot && $guest->pivot->invite == 3){
                            $guestCount += $guest->family->count();
                        }
                        if($guest && $guest->pivot && $guest->pivot->invite == 2){
                            $guestCount += 1;
                        }
                    }
                }
                
                $invitationCount = optional($invitation)->guests()
                    ?->where('invite', '>', 0)
                    ->where('users.deleted_at', null)
                    ->where('guest_invitation.deleted_at', null)
                    ->count();
                $members = Host::where('parent_id', auth()->guard('host')->user()->id)->count();
                $guestCount = $guestCount + $invitationCount;
                $invitationsaccepted = optional($invitation)->guestlist()?->where('inviteStatus', 6)->count();
                $invitationsdeclined = optional($invitation)->guestlist()?->where('inviteStatus', 5)->count();
                $invitationspending = optional($invitation)->guestlist()?->where('inviteStatus', 4)->count();
                $notifications = $host->notifications;

                //
                $sentAccomodation = optional($invitation)->guestlist()?->where('accommodation', 1)->count();
                $sentLogistics = optional($invitation)->guestlist()?->where('logistics', 1)->count();

                $accAccomodation = optional($invitation)->guestlist()?->whereIn('accommodationStatus', [2,4])->count();
                $accLogisitcs = optional($invitation)->guestlist()?->where(function ($query){
                    $query->where('logisticsArrivalStatus', 2)?->orWhere('logisticsDepartureStatus', 2)->orWhere('logisticsDepartureStatus', 4)->orWhere('logisticsArrivalStatus', 4);
                })->count();
                /////
                $decAccomodation = optional($invitation)->guestlist()?->where('accommodationStatus', 3)->count();
                $decLogisitcs = optional($invitation)->guestlist()?->where(
                    function ($query) {
                        $query->where('logisticsArrivalStatus', 3)?->orWhere('logisticsDepartureStatus', 3);
                    }
                )->count();

                $allAccomodation = optional($invitation)->guestlist()?->where('hostAccommodationStatus', 1)->count();
                $allLogisitcs = optional($invitation)->guestlist()?->where(
                    function ($query) {
                        $query->where('hostLogisticsArrivalStatus', 1)?->orWhere('hostLogisticsDepartureStatus', 1);
                    }
                )->count();



                $tasks = MemberTask::where('invitation_id', optional($invitation)->id)->with('assignable', 'category')->oldest('startDate')->get();

                // Fetch ceremonies associated with the invitation
                $ceremonies = [];
                if ($invitation) {
                    $ceremonies = Ceramony::where('invitation_id', $invitation->id)
                    ->get()
                    ->map(function ($ceremony) {
                        return [
                            'title' => $ceremony->name,
                            'startDate' => $ceremony->startDate,
                            'startTime' => $ceremony->startTime,
                            'category' => ['name' => 'Ceremony'],
                            'assignable' => ['name' => 'Host'],
                            'taskPriority' => 'High',
                            'id' => $ceremony->id,
                            'type' => 'ceremony',
                        ];
                    });
                }


                // Merge ceremonies with tasks
                $allTasks = $tasks->concat($ceremonies);

                $active = 'home';
                //dd($tasks);
                //$notifications = ['ddfdsf','fdfdsfdsfds'];
                return view('host.welcome', compact('host', 'guests', 'invitationCount','guestCount','invitation', 'invitationsaccepted', 'invitationsdeclined', 'invitationspending', 'notifications', 'sentAccomodation', 'accAccomodation', 'allAccomodation', 'sentLogistics', 'accLogisitcs', 'allLogisitcs', 'decAccomodation', 'decLogisitcs','members', 'tasks', 'active'))
                ->with('tasks', $allTasks); // Pass the combined tasks

        }
        else {
            //dd('ss');
            return redirect()->route('welcome');
        }
    }

    public function getinvi()
    {
        $loggedIn =  auth()->guard('host')->user();
        $invitation = null;
        if($loggedIn){
            $invitation = $loggedIn->invitations->first();
        }
        return [
            'user' => $loggedIn,
            'invi' => $invitation
        ];
    }


    public function testify()
    {
        $loggedIn =  auth()->guard('host')->user();
        $host = Host::where('id', $loggedIn->id)->with('profile')->first();
        $testimonial = new Testimonial();
        $tags = array_filter(Tag::pluck('name', 'id')->toArray());
        return view('host.testimonials.create', compact('loggedIn', 'testimonial', 'tags', 'host'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function mobilenumber(Request $request, Host $host)    {
        $validated = $request->validate([
            'mobile' => 'required|digits:10',
        ]);
        $host->mobile=$request->mobile;
        $host->save();
        return redirect()->back();

    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\host\host  $host
     * @return \Illuminate\Http\Response
     */
    public function show(host $host)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\host\host  $host
     * @return \Illuminate\Http\Response
     */
    public function edit(host $host)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\host\host  $host
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, host $host)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\host\host  $host
     * @return \Illuminate\Http\Response
     */
    public function destroy(host $host)
    {
        //
    }
    public function addMemories(Request $request, Host $host)
    {
        try {
            $request->validate([
                'memoriesImage.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            // Get the first invitation for the host
            $invitation = $host->invitations->first();
            
            if (!$invitation) {
                return response()->json(['error' => 'No invitation found for this host. Please create an invitation first.'], 404);
            }

            $memories = [];
            if ($request->hasFile('memoriesImage')) {
                $invitationId = $invitation->id;
                $storagePath = "public/files/{$invitationId}/memories";
                
                // Create directory if it doesn't exist
                if (!Storage::exists($storagePath)) {
                    Storage::makeDirectory($storagePath);
                }

                foreach ($request->file('memoriesImage') as $image) {
                    $filename = time() . '_' . $image->getClientOriginalName();
                    
                    // Store the image using Storage facade
                    $path = $image->storeAs($storagePath, $filename);
                    
                    if (!$path) {
                        throw new \Exception('Failed to store image');
                    }
                    
                    // Create memory record in database
                    $memory = Memory::create([
                        'invitation_id' => $invitationId,
                        'image_name' => $filename,
                        'original_name' => $image->getClientOriginalName(),
                        'mime_type' => $image->getMimeType(),
                        'size' => $image->getSize()
                    ]);
                    
                    $memories[] = $memory;
                }
            }

            return response()->json(['memories' => $memories]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
