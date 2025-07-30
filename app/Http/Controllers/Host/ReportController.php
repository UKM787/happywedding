<?php

namespace App\Http\Controllers\Host;

use App\Models\Host\Host;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use function PHPUnit\Framework\isEmpty;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $host = auth()->guard('host')->user();
        $host = Host::where('id', $host->id)->with('profile')->first();
        $invitation=$host->invitations->first();
        if($invitation == null){
                return redirect(route('hostinvitations.index'));
            }
        $active = 'reports';
       if($host->invitations->isNotEmpty()){
        $guests = $host->invitations->first()->guests;
        $notifications = $host->notifications;
        return view('host.reports.index', compact('host','guests', 'notifications', 'active', 'invitation'));

        } else {
          return view('404', compact('host'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function destroy($id)
    {
        //
    }
}
