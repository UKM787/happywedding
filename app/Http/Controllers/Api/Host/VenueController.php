<?php

namespace App\Http\Controllers\Api\Host;

use App\Http\Controllers\Controller;
use App\Models\Vendor\Service\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VenueController extends Controller
{
    public function index()
    {
        $host = Auth::guard('host')->user();
        return response()->json([
            'venues' => $host->venues
        ]);
    }

    public function store(Request $request)
    {
        try {
            $host = Auth::guard('host')->user();

            // Debug: Log received data
            \Log::info('Venue creation data:', $request->all());

            $venue = new Venue([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description ?? '',
                'address' => $request->address,
                'longitude' => $request->longitude ?? null,
                'latitude' => $request->latitude ?? null,
                'category_id' => $request->category_id ?? null,
                'location_id' => $request->location_id ?? null,
                'state' => $request->state ?? null,
                'status' => 1 // Set status to 1 for active
            ]);

            $host->venues()->save($venue);

            return response()->json([
                'success' => true,
                'message' => 'Venue created successfully',
                'venue' => $venue
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        $host = Auth::guard('host')->user();
        $venue = $host->venues()->find($id);
        
        if (!$venue) {
            return response()->json([
                'success' => false,
                'message' => 'Venue not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'venue' => $venue
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $host = Auth::guard('host')->user();
            $venue = $host->venues()->find($id);
            
            if (!$venue) {
                return response()->json([
                    'success' => false,
                    'message' => 'Venue not found'
                ], 404);
            }

            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description ?? $venue->description,
                'address' => $request->address,
                'longitude' => $request->longitude ?? $venue->longitude,
                'latitude' => $request->latitude ?? $venue->latitude,
                'category_id' => $request->category_id ?? $venue->category_id,
                'location_id' => $request->location_id ?? $venue->location_id,
                'state' => $request->state ?? $venue->state,
                'status' => $request->status ?? $venue->status
            ];

            $venue->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Venue updated successfully',
                'venue' => $venue
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        $host = Auth::guard('host')->user();
        $venue = $host->venues()->find($id);
        
        if (!$venue) {
            return response()->json([
                'success' => false,
                'message' => 'Venue not found'
            ], 404);
        }

        $venue->delete();

        return response()->json([
            'success' => true,
            'message' => 'Venue deleted successfully'
        ]);
    }
} 