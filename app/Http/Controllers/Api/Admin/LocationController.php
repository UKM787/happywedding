<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use App\Models\LocationMaster as NewLocationMaster;
use App\Http\Resources\Admin\LocationResource;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return LocationResource::collection(LocationMaster::all());
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

    /**
     * Get all states from locationmaster table (parent_id = 1 for India)
     *
     * @return \Illuminate\Http\Response
     */
    public function getStates()
    {
        try {
            $states = LocationMaster::select('id', 'name')
                ->where('parent_id', 1) // States are children of India (id=1)
                ->orderBy('name', 'ASC')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $states
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching states: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cities by state from locationmaster table
     *
     * @param  int  $stateId
     * @return \Illuminate\Http\Response
     */
    public function getCitiesByState($stateId)
    {
        try {
            $cities = LocationMaster::select('id', 'name')
                ->where('parent_id', $stateId) // Cities are children of the state
                ->orderBy('name', 'ASC')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $cities
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching cities: ' . $e->getMessage()
            ], 500);
        }
    }
}
