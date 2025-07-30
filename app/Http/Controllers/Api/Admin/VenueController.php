<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\VenueMaster;
use App\Models\Vendor\Service\Venue;
use App\Models\Admin\LocationMaster;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VenueResource;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return VenueResource::collection(Venue::all());
        return VenueResource::collection(VenueMaster::all());
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
     * Get venues by city ID from both locationmaster and location_masters tables
     *
     * @param  int  $cityId
     * @return \Illuminate\Http\Response
     */
    public function getVenuesByCity($cityId)
    {
        try {
            // Get venues from both tables based on the city ID
            // First, try to get venues from the venues table using location_id (locationmaster table)
            $venuesFromLocationMaster = Venue::with(['location', 'stateLocation'])
                ->where('status', 0) // Active venues
                ->where('location_id', $cityId)
                ->orderBy('name', 'ASC')
                ->get();

            // Also try to get venues using locationmaster_id (location_masters table)
            $venuesFromLocationMasters = Venue::with(['location', 'stateLocation'])
                ->where('status', 0) // Active venues
                ->where('locationmaster_id', $cityId)
                ->orderBy('name', 'ASC')
                ->get();

            // Merge and remove duplicates
            $allVenues = $venuesFromLocationMaster->merge($venuesFromLocationMasters)->unique('id');

            // Format the response to match the expected structure
            $formattedVenues = $allVenues->map(function ($venue) {
                return [
                    'name' => $venue->name,
                    'code' => $venue->id,
                    'address' => $venue->address,
                    'city' => $venue->city ?? ($venue->location ? $venue->location->name : ''),
                    'state' => $venue->state ?? ($venue->stateLocation ? $venue->stateLocation->name : ''),
                    'description' => $venue->description,
                    'imageOne' => $venue->imageOne
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedVenues
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching venues: ' . $e->getMessage()
            ], 500);
        }
    }
}
