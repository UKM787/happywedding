<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CopyLogoFiles extends Command
{
    protected $signature = 'logo:copy';
    protected $description = 'Copy logo files to storage directory';

    public function handle()
    {
        // Create theme directory if it doesn't exist
        $storageThemeDir = storage_path('app/public/theme');
        if (!File::exists($storageThemeDir)) {
            File::makeDirectory($storageThemeDir, 0755, true);
        }

        // Copy logo file from assets to storage
        $assetLogoPath = public_path('assets/theme/logo.svg');
        $storageLogoPath = storage_path('app/public/theme/logo.svg');
        
        if (File::exists($assetLogoPath)) {
            File::copy($assetLogoPath, $storageLogoPath);
            $this->info('Logo file copied to storage successfully.');
        } else {
            // Create a default logo if the asset doesn't exist
            $defaultLogo = '<svg xmlns="http://www.w3.org/2000/svg" width="150" height="50" viewBox="0 0 150 50">
                <text x="10" y="30" font-family="Arial" font-size="24" fill="#FF5BFF" font-weight="bold">HAPPY</text>
                <path d="M45 10 L50 15 L45 20" fill="none" stroke="#FF5BFF" stroke-width="2"/>
                <circle cx="5" cy="10" r="3" fill="#FF5BFF"/>
            </svg>';
            
            File::put($storageLogoPath, $defaultLogo);
            File::put($assetLogoPath, $defaultLogo);
            $this->info('Default logo files created successfully.');
        }

        return 0;
    }
}

