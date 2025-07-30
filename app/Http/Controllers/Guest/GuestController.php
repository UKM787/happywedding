<?php

namespace App\Http\Controllers\Guest;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Album;
use App\Models\Video;
use App\Models\Gallery;
use App\Models\Admin\Tag;
use App\Models\Host\Host;
use App\Models\Host\Guest;
use Illuminate\Http\Request;
use App\Models\Guest\Arrival;
use App\Models\Host\Ceramony;
use App\Models\Guest\Departure;
use App\Models\Guest\Privilege;
use App\Models\Host\Invitation;
use App\Models\Admin\Testimonial;
use App\Http\Controllers\Controller;
use App\Models\Guest\GuestInvitation;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Collection;
use App\Notifications\Guest\InvitationNotifications;
use Exception;
use Illuminate\Support\Facades\Crypt;

class GuestController extends Controller
{

    public function inviDisplay($id, $mobile, $slug){
        //dd(strlen(request()->url()), );
        try{
            $inviSlug = Crypt::decrypt(request()->slug);
            $inviMobile = Crypt::decrypt(request()->num);
        }catch(Exception $e){
            return redirect()->route('welcome')->with([
                'message'    => 'Something went wrong!',
            ]);
        }
        $user = User::where('mobile', (int)$inviMobile)->first();
        $invitation = Invitation::where('id', (int)request()->id)->where('slug', $inviSlug)->first();
        if($user == null || $invitation == null){
            return redirect()->route('welcome')->with([
                'message'    => 'Not Authorised!',
            ]);
        }else{
           $status = GuestInvitation::where('user_id', $user->id)->where('invitation_id', $invitation->id)->first(); 
           //dd($invitation, $status);
            if($status && ($status->inviteStatus == 6 || $status->inviteStatus == 5)){
                return redirect()->route('login')->with([
                    'message'    => 'Login to view your invitation!',
                ]);
            }
           $response= $this->invitation($user, $invitation);
           //dd($abc);
            return $response;
        }
    }

    public function index(User $user){
        if (auth()->check()) {
            $user = auth()->user();
            $inviteNew = $this->getCeramonyTime($user->inviteNew()->with('venues')->get());
            $inviteAccepted = $this->getCeramonyTime($user->inviteAccepted()->with('venues')->get());
            $inviteRejected = $this->getCeramonyTime($user->inviteRejected()->with('venues')->get());
            $invitePending = $this->getCeramonyTime($user->invitePending()->with('venues')->get());
            $invitations = $this->getCeramonyTime($user->invitations()->where('invite', '!=', 0)->with('venues')->get());
            //dd($inviteNew);
            $notifications = $user->notifications;
            $events = new Collection();
            //dd($invitations);
            foreach($invitations as $invitaion){
                $ceramonies = array_keys( json_decode($invitaion->guest_invitation->ceremony_invite, true));
                //dd(array_keys($ceramonies));
                if(count($ceramonies) > 0){
                    $ceras = Ceramony::whereIn('id', $ceramonies)->where('invitation_id', $invitaion->id)->with('invitation', 'venues')->get();
                    $events = $events->merge($ceras);

                }
            }

            //dd($events);
            //dd($user->notifications);
            return view('guest.welcome', compact('user', 'invitations', 'inviteNew', 'inviteAccepted',  'inviteRejected', 'invitePending', 'notifications', 'events'));
        }else{
            return redirect()->route('login');
        }
    }

    public function create(Host $host, Invitation $invitaion){

    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function store(Host $host, Invitation $invitation, Request $request) {

    }


    public function newinvitations(User $user) {
        if (auth()->check()) {
            $user = auth()->user();
            $invitations = $this->getCeramonyTime($user->inviteNew()->with('venues')->get());
            $link ='new';

            return view('guest.inviteList', compact('user', 'invitations', 'link'));
        }
    }

    public function acceptedinvitations(User $user) {
        //dd('came from route - guestinviteaccepted - url going method accepted');
        if (auth()->check()) {
            $user = auth()->user();
            $invitations = $this->getCeramonyTime($user->inviteAccepted()->with('venues')->get());
            $link ='accepted';

            return view('guest.inviteList', compact('user', 'invitations', 'link'));
        }
    }

    public function declinedinvitations(User $user) {
        //dd('came from route - guestinvitedeclined url declined method declined' );
        //dd($user, $invitation);
        if (auth()->check()) {
            $user = auth()->user();
            $invitations = $this->getCeramonyTime($user->inviteRejected()->with('venues')->get());
            $link ='declined';
            //dd($invitations, $link);

            return view('guest.inviteList', compact('user', 'invitations', 'link'));
        }
    }

    public function pendinginvitations(User $user, Invitation $invitation)  {
        //dd('came from route - guestpending-invitations url pending method pending');
        //dd($user, $invitation);
        if (auth()->check()) {
            $user = auth()->user();
            $invitations = $this->getCeramonyTime($user->invitePending()->with('venues')->get());
            $link ='pending';

            return view('guest.inviteList', compact('user', 'invitations', 'link'));
        }
    }

    public function testify(User $user)
    {
        //dd($user);
        // $loggedIn =  auth()->guard('web')->user();
        $loggedIn = $user;
        $testimonial = new Testimonial();
        $tags = array_filter(Tag::pluck('name', 'id')->toArray());
        return view('guest.testimonials.create', compact('loggedIn', 'testimonial', 'tags', 'user'));
    }

    //action routes
    public function noted(User $user, Invitation $invitation) {
        //dd($user, $invitation, 'sccepeted');
        $user->invitations()->where('invitation_id', $invitation->id)->update(['inviteStatus' => 4]);
        $invitation->host->notify(new InvitationNotifications($user, $invitation, $user->name.' viewed your invitation'));
        $invitePending = $this->getCeramonyTime($user->invitePending()->with('venues')->get());
        return $invitePending;
    }

    public function accepted(User $user,  Invitation $invitation)  {
        $user->invitations()->where('invitation_id', $invitation->id)->update(['inviteStatus' => 6]);
        $invitation->host->notify(new InvitationNotifications($user, $invitation, $user->name.' accepted your invitation!'));
        $inviteAccepted = $this->getCeramonyTime($user->inviteAccepted()->with('venues')->get());
        return $inviteAccepted;
    }

    public function declined(User $user,  Invitation $invitation)  {
        //dd($user, $invitation, 'declined');
        $user->invitations()->where('invitation_id', $invitation->id)->update(['inviteStatus' => 5]);
        $invitation->host->notify(new InvitationNotifications($user, $invitation, $user->name.' declined your invitation'));
        $inviteRejected = $this->getCeramonyTime($user->inviteRejected()->with('venues')->get());
        return $inviteRejected;
        
    }

    public function invitation(User $user, Invitation $invitation) {
        $inviStatus = $user->invitations()->with('venues')->get()->where('id', $invitation->id)->first();
        $allCeramonies = $inviStatus->ceramonies($invitation)->with(['venues', 'ceramonymaster'])->get();
        $ceremoniesInvited = json_decode($inviStatus->guest_invitation->ceremony_invite ?? '{}', true);
        $ceramonies = collect();
        if (!empty($ceremoniesInvited)) {
            $ceramonies = $allCeramonies->filter(function($item) use($ceremoniesInvited){
                $keys = array_keys($ceremoniesInvited);
                foreach($keys as $key){
                    if($item->id == $key){
                        if($ceremoniesInvited[$key] != 0){
                            $item->inviteWith = $ceremoniesInvited[$key];
                            $item->file = $item->ceramonymaster->file;
                            return $item;
                        }
                    }
                }
                return false;
            });
        }
        //dd($ceramonies);

        $family = $user->family;
        //dd($family);
        $inviStatus->guest_invitation->ceremony_invite = json_decode($inviStatus->guest_invitation->ceremony_invite);

        $accomodationInfo = Privilege::where('user_id', $user->id)->where('invitation_id', $invitation->id)->with('family')->get(); 
        //$accomodationInfo['guest'] = 'helo'
        $guestAccommodationInfo = $user->accommodations->first();
        $arrivalDetails = Arrival::where('guest_id', $user->id)->where('invitation_id', $invitation->id)->first();
        $departureDetails = Departure::where('guest_id', $user->id)->where('invitation_id', $invitation->id)->first();
        $helpLine = $invitation->contacts()->with('member')->get();
        $story = $invitation->story; 
        //dd($invitation->story);
        $albums=Album::with('images')->where('invitation_id',$invitation->id)->get();
        $galleries=Gallery::with(['invitation','album'])->where('invitation_id',$invitation->id)->get();
        $videos=Video::where('invitation_id',$invitation->id)->get();
        //dd($invitation->contacts);
        //dd(Schema::getColumnListing('guest_arrivals'));
        //dd($departureDetails);
       //// dd($inviStatus->guest_invitation->ceremony_invite);
              // dd('ss');
        if($inviStatus->guest_invitation->inviteStatus == 3){
            $user->invitations()->where('invitation_id', $invitation->id)->update(['inviteStatus' => 4]);
        }
        //dd($inviStatus->guest_invitation->inviteStatus == 4);

        return view('guest.invitation.invitation', compact('invitation','user', 'ceramonies','inviStatus', 'family', 'accomodationInfo', 'guestAccommodationInfo', 'arrivalDetails', 'departureDetails', 'helpLine', 'story', 'albums', 'galleries', 'videos'));
    }

    public function getCeramonyTime($invites){
        foreach($invites as $single){
            $ceremoniesInvited = array_keys( json_decode($single->guest_invitation->ceremony_invite, true));
            if(count($ceremoniesInvited)  > 0){
                $latest = Ceramony::whereIn('id', $ceremoniesInvited)->where('invitation_id', $single->id)->oldest('startDate')->first();
                if($latest){
                    $single->ceraStart = $latest->startDate;
                }
                $oldest = Ceramony::whereIn('id', $ceremoniesInvited)->where('invitation_id', $single->id)->latest('startDate')->first();
                if($oldest){
                    $single->ceraEnd = $oldest->startDate;
                }
            }            
        }
        //dd($invites);
        return $invites;
    }

    // public function cover(User $user, Invitation $invitation)  {
    //     return view('guest.invitation.cover', compact('user', 'invitation'));
    // }

    // public function savedate(User $user, Invitation $invitation) {
    //    if(isset($invitation->savedate)){
    //     $now = Carbon::now();
    //     $marriagedate = $invitation->savedate->startDate;
    //     $counter = $now->diffInSeconds($marriagedate);
    //     return view('guest.invitation.savedate', compact('user', 'invitation', 'counter'));
    //     }
    //     else {
    //         $notice = "Marriage Dates are yet to be finalized, stay Tuned !";
    //         return view('guest.invitation.savedate', compact('user', 'invitation','notice'));
    //     }
    // }

    // public function story(User $user, Invitation $invitation)  {
    //     if (isset($invitation->story)) {
    //     $story = $invitation->story;
    //     return view('guest.invitation.story', compact('user', 'invitation', 'story'));
    //     }
    //     else {
    //         $notice = "Story is yet to published. stay tuned !";
    //         return view('guest.invitation.story', compact('user', 'invitation', 'notice'));
    //     }
    // }

    // public function ceramonies(User $user, Invitation $invitation)  {
    //     if (isset($invitation->ceramonies)) {
    //         $notice = "Ceramonies are yet to be decided. stay Tuned ! ";
    //     return view('guest.invitation.ceramonies', compact('user', 'invitation','notice'));
    //     }
    //     else {
    //         $notice = "Ceramonies are yet to be decided. stay Tuned ! ";
    //         return view('guest.invitation.ceramonies', compact('user', 'invitation', 'notice'));
    //     }
    // }

}
