<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Salon;
use Illuminate\Support\Facades\Log;

class SalonImportService
{
    protected $apiUrl;
    protected $defaultCities;
    protected $apiVersion;

    public function __construct()
    {
        $this->apiUrl = config('services.salon_api.url');
        $this->defaultCities = config('services.salon_api.cities');
        $this->apiVersion = 'v2';

        // Check if the API URL is valid
        if (filter_var($this->apiUrl, FILTER_VALIDATE_URL) === false) {
            Log::error('Invalid API URL configured: ' . $this->apiUrl);
            throw new \InvalidArgumentException('Invalid API URL configured.');
        }

        // Check if the DEFAULT CITIES are valid
        if (!is_array($this->defaultCities) || empty($this->defaultCities)) {
            Log::error('Invalid DEFAULT CITIES configured: ' . json_encode($this->defaultCities));
            throw new \InvalidArgumentException('Invalid DEFAULT CITIES configured.');
        }
    }

    public function importSalons()
    {
        foreach ($this->defaultCities as $cityId) {
            try {
                $response = Http::get("{$this->apiUrl}/{$this->apiVersion}/salons?city={$cityId}");

                if ($response->successful()) {
                    $responseResult = $response->json();
                    
                    $salons = [];
                    if(!empty($responseResult['results']))
                        $salons = $responseResult['results'];
    
                    foreach ($salons as $salon) {
                        $salonDB = Salon::updateOrCreate(
                            ['external_id' => $salon['id']],
                            [
                                'name' => $salon['name'],
                                'city' => $salon['city'],
                            ]
                        );
    
                        if (!empty($salon['services'])) {
                            foreach ($salon['services'] as $service) {
                                $salonDB->services()->updateOrCreate(
                                    ['external_id' => $service['id']],
                                    [
                                        'name' => $service['name'],
                                        'currency' => $service['price']['currency'],
                                        'display' => $service['price']['display'],
                                    ]
                                );
                            }
                        }
                    }
                } else {
                    Log::error('Failed to fetch salons from API. Status code: ' . $response->status() . ', Response: ' . $response->body() . ', City ID: ' . $cityId);
                    throw new \Exception('Failed to fetch salons from API');
                }
            } catch (\Exception $th) {
                Log::error('Error during importing salons: ' . $th->getMessage());
                throw $th;
            }
        }
    }
}
