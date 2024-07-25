<?php

namespace App\Console\Commands;

use App\Jobs\ImportSalons as JobsImportSalons;
use App\Services\SalonImportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ImportSalons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:salons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import salons from the salons API';

    /**
     * Execute the console command.
     */
    public function handle(SalonImportService $salonImportService)
    {        
        try {
            $salonImportService->importSalons();
        } catch (\Throwable $th) {
            Log::error('ImportSalons Job failed: ' . $th->getMessage());
        }
    }
}
