<?php

namespace App\Http\Controllers\Api\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    /**
     * Store a newly created city in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Log the request data for debugging
            Log::info('City store request data:', $request->all());
            
            // Validate the request
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'state' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                Log::warning('City validation failed:', $validator->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Create slug
            $slug = Str::slug($request->name . '-' . $request->state);
            
            // 1. Insert into location_masters table
            $cityId = DB::table('location_masters')->insertGetId([
                'city' => $request->name,
                'state' => $request->state,
                'slug' => $slug,
                'status' => 1,
                'admin_id' => 1,
                'imageOne' => 'locationDefault.png',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            // 2. Also insert into locationmaster table for admin panel
            try {
                // First, find the state in locationmaster
                $stateId = null;
                $state = DB::table('locationmaster')
                    ->where('name', $request->state)
                    ->first();
                
                // If state doesn't exist, create it
                if (!$state) {
                    // Get country ID (usually 1 for default country)
                    $countryId = DB::table('locationmaster')
                        ->whereNull('parent_id')
                        ->first()->id ?? 1;
                    
                    // Create state
                    $stateId = DB::table('locationmaster')->insertGetId([
                        'name' => $request->state,
                        'latitude' => '0',
                        'longitude' => '0',
                        'status' => 1,
                        'priority' => 0,
                        'parent_id' => $countryId, // Set parent to country
                        'icon' => '<i class="material-icons">place</i>',
                        'imageOne' => 'locationDefault.png',
                        'slug' => Str::slug($request->state) . '-state',
                        'admin_id' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    
                    Log::info('Created new state in locationmaster: ' . $request->state);
                } else {
                    $stateId = $state->id;
                }
                
                // Check if city already exists anywhere in the table
                $existingCity = DB::table('locationmaster')
                    ->where('name', $request->name)
                    ->first();

                if (!$existingCity && $stateId) {
                    // Add city with state as parent
                    DB::table('locationmaster')->insert([
                        'name' => $request->name,
                        'latitude' => '0',
                        'longitude' => '0',
                        'status' => 1,
                        'priority' => 0,
                        'parent_id' => $stateId, // Set parent to state
                        'icon' => '<i class="material-icons">place</i>',
                        'imageOne' => 'locationDefault.png',
                        'slug' => $slug . '-city',
                        'admin_id' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    
                    Log::info('City added to locationmaster table as a city');
                } else if ($existingCity && $existingCity->parent_id != $stateId) {
                    // City exists but under a different state
                    $modifiedName = $request->name . ' (' . $request->state . ')';
                    $modifiedSlug = Str::slug($modifiedName);
                    
                    // Add city with modified name
                    DB::table('locationmaster')->insert([
                        'name' => $modifiedName,
                        'latitude' => '0',
                        'longitude' => '0',
                        'status' => 1,
                        'priority' => 0,
                        'parent_id' => $stateId, // Set parent to state
                        'icon' => '<i class="material-icons">place</i>',
                        'imageOne' => 'locationDefault.png',
                        'slug' => $modifiedSlug . '-city',
                        'admin_id' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    
                    Log::info('City added to locationmaster with modified name to avoid duplicate');
                } else {
                    Log::info('City already exists in locationmaster table');
                }
            } catch (Exception $e) {
                // Log error but don't fail the main operation
                Log::error('Error adding to locationmaster: ' . $e->getMessage());
            }
            
            // Log success
            Log::info('City saved successfully with ID: ' . $cityId);

            // Get all cities for response
            $allCities = DB::table('location_masters')
                ->where('status', 1)
                ->orderBy('city', 'asc')
                ->get()
                ->map(function($location) {
                    return [
                        'name' => $location->city,
                        'state' => $location->state,
                        'code' => $location->id
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'City added successfully!',
                'data' => [
                    'id' => $cityId,
                    'name' => $request->name,
                    'state' => $request->state
                ],
                'all' => $allCities
            ]);
        } catch (Exception $e) {
            // Log the detailed error
            Log::error('Error in CityController@store: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString() // Include trace in development
            ], 500);
        }
    }

    /**
     * Update the specified city in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'state' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Create slug
            $slug = Str::slug($request->name . '-' . $request->state);
            
            // Get the old city data
            $oldCity = DB::table('location_masters')->where('id', $id)->first();
            
            // Update location_masters table
            DB::table('location_masters')
                ->where('id', $id)
                ->update([
                    'city' => $request->name,
                    'state' => $request->state,
                    'slug' => $slug,
                    'updated_at' => now()
                ]);
                
            // Also update locationmaster table if there's a matching entry
            try {
                if ($oldCity) {
                    $matchingLocation = DB::table('locationmaster')
                        ->where('name', $oldCity->city)
                        ->first();
                    
                    if ($matchingLocation) {
                        DB::table('locationmaster')
                            ->where('id', $matchingLocation->id)
                            ->update([
                                'name' => $request->name,
                                'slug' => $slug . '-admin',
                                'updated_at' => now()
                            ]);
                        
                        Log::info('Updated matching entry in locationmaster table');
                    }
                }
            } catch (Exception $e) {
                // Log error but don't fail the main operation
                Log::error('Error updating locationmaster: ' . $e->getMessage());
            }

            // Get all cities for response
            $allCities = DB::table('location_masters')
                ->where('status', 1)
                ->orderBy('city', 'asc')
                ->get()
                ->map(function($location) {
                    return [
                        'name' => $location->city,
                        'state' => $location->state,
                        'code' => $location->id
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'City updated successfully!',
                'data' => [
                    'id' => $id,
                    'name' => $request->name,
                    'state' => $request->state
                ],
                'all' => $allCities
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString() // Include trace in development
            ], 500);
        }
    }
    
    /**
     * Sync existing cities from location_masters to locationmaster
     * This can be called via an admin route
     */
    public function syncCities()
    {
        try {
            $hostCities = DB::table('location_masters')
                ->where('status', 1)
                ->get();
                
            $count = 0;
            
            foreach ($hostCities as $city) {
                // First, find or create the state
                $stateId = null;
                $state = DB::table('locationmaster')
                    ->where('name', $city->state)
                    ->first();
                
                // If state doesn't exist, create it
                if (!$state) {
                    // Get country ID (usually 1 for default country)
                    $countryId = DB::table('locationmaster')
                        ->whereNull('parent_id')
                        ->first()->id ?? 1;
                    
                    // Create state
                    $stateId = DB::table('locationmaster')->insertGetId([
                        'name' => $city->state,
                        'latitude' => '0',
                        'longitude' => '0',
                        'status' => 1,
                        'priority' => 0,
                        'parent_id' => $countryId, // Set parent to country
                        'icon' => '<i class="material-icons">place</i>',
                        'imageOne' => 'locationDefault.png',
                        'slug' => Str::slug($city->state) . '-state',
                        'admin_id' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                } else {
                    $stateId = $state->id;
                }
                
                // Check if city already exists
                $existingCity = DB::table('locationmaster')
                    ->where('name', $city->city)
                    ->where('parent_id', $stateId)
                    ->first();
                
                if (!$existingCity && $stateId) {
                    $slug = Str::slug($city->city . '-' . $city->state);
                    
                    // Add city with state as parent
                    DB::table('locationmaster')->insert([
                        'name' => $city->city,
                        'latitude' => '0',
                        'longitude' => '0',
                        'status' => 1,
                        'priority' => 0,
                        'parent_id' => $stateId, // Set parent to state
                        'icon' => '<i class="material-icons">place</i>',
                        'imageOne' => 'locationDefault.png',
                        'slug' => $slug . '-city',
                        'admin_id' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    
                    $count++;
                }
            }
            
            return response()->json([
                'success' => true,
                'message' => "Synced $count cities to admin panel",
                'count' => $count
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sync failed: ' . $e->getMessage()
            ], 500);
        }
    }
}





