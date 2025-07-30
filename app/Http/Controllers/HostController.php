<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HostController extends Controller
{
    public function addMemories(Request $request, $host)
    {
        $request->validate([
            'memoriesImage.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $memories = [];
        if ($request->hasFile('memoriesImage')) {
            foreach ($request->file('memoriesImage') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                
                // Store the image in the memories directory
                $image->move(public_path('files/' . $host->invitation->id . '/memories'), $filename);
                
                // Create memory record in database
                $memory = Memory::create([
                    'invitation_id' => $host->invitation->id,
                    'image_name' => $filename,
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize()
                ]);
                
                $memories[] = $memory;
            }
        }

        return response()->json(['memories' => $memories]);
    }
} 