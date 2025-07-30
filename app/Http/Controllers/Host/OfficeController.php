<?php

namespace App\Http\Controllers\Host;

use Exception;
use App\Models\Host\Host;
use Illuminate\Support\Str;
use App\Models\Host\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $host = auth()->guard('host')->user();

            if ($host->office !== null) {
                $office = $host->office;
                return view('host.profile.index', compact('host', 'office'));
            } else {
                $office = new Office();
                return view('host.office.create', compact('host', 'office'));
            }
        } else {
            die('you are not loggedin yet!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Host $host)  {
        $office = new Office();
        return view('host.office.create', compact('host', 'office'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Host $host, Request $request)  {

        if (auth()->guard('host')->check()) {
            try {
                $office = Office::create($this->requestValidate($request) + ['host_id' => auth()->guard('host')->id(), 'slug' => (Str::slug($host->name.'-'.$request->district.'-'.$request->state.'-'.$request->pin))]);
                if ($office) {
                    return redirect()-back()
                        ->with([
                            'tab' => 'office',
                            'status' => 'success',
                            'message' => $host->name . ' office address noted'
                        ]);
                }
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status'  => 'failure',
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
    public function show(Host $host, Office $office)  {
        return view('host.office.show', compact('host', 'office'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Host $host, Office $office) {
        return view('host.office.edit', compact('host', 'office'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Host $host, Office $office, Request $request) {
        if (auth()->guard('host')->check()) {
            try {
                $newoffice = $office->update($this->requestValidate($request) + ['host_id' => auth()->guard('host')->id(), 'slug' => (Str::slug($host->name.'-'.$request->district.'-'.$request->state.'-'.$request->pin))]);

                if ($newoffice) {
                    return redirect()->route('hostprofile.index', [$host, $office])
                        ->with([
                            'tab'  => 'office',
                            'status' => 'success',
                            'message' => $host->name . ' officeaddress updated successfully'
                        ]);
                }
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'tab' => 'office',
                    'status'  => 'failure',
                    'message' => $e->getMessage()
                ]);
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

    private function requestValidate($request) {
        return $request->validate([
            'companyName' => ['required', 'string', 'min:3', 'max:100'],
            'complexName' => ['required', 'string', 'min:3', 'max:100'],
            'floor' => ['required', 'string', 'min:3', 'max:100'],
            'doorNo' => ['required', 'string', 'min:1', 'max:50'],
            'streetNo' => ['required', 'string', 'min:1', 'max:50'],
            'area' => ['required', 'string', 'min:3', 'max:100'],
            'district' => ['required', 'string', 'min:3', 'max:25'],
            'state' => ['required', 'string', 'min:3', 'max:100'],
            'pin' => ['required', 'string', 'min:6', 'max:9'],
            'zone' => ['required', 'string', 'min:3', 'max:50'],
            'reachus' => ['required', 'string', 'min:3', 'max:255']
        ]);
    }
}
