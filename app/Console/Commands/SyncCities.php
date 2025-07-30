<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;

class SyncCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync cities from location_masters to locationmaster';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting city sync...');
        
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
                    
                    $this->info("Creating state: {$city->state}");
                    
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
                
                // Check if city already exists anywhere in the table
                $existingCity = DB::table('locationmaster')
                    ->where('name', $city->city)
                    ->first();
                
                if (!$existingCity && $stateId) {
                    $slug = Str::slug($city->city . '-' . $city->state);
                    
                    $this->info("Adding city: {$city->city} (State ID: {$stateId})");
                    
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
                } else if ($existingCity && $existingCity->parent_id != $stateId) {
                    // City exists but under a different state
                    $this->info("City {$city->city} exists but under a different state. Creating with modified name.");
                    
                    $modifiedName = $city->city . ' (' . $city->state . ')';
                    $slug = Str::slug($modifiedName);
                    
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
                        'slug' => $slug . '-city',
                        'admin_id' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    
                    $count++;
                } else {
                    $this->info("City already exists: {$city->city}");
                }
            }
            
            $this->info("Synced $count cities to admin panel");
            return 0;
        } catch (Exception $e) {
            $this->error('Sync failed: ' . $e->getMessage());
            return 1;
        }
    }
}

