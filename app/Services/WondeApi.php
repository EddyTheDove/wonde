<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WondeApi 
{
    /**
     * Get all employees of a school
     */
    public static function getSchoolEmployees(string $schoolID, int $page = 1) : mixed
    {
        $url = 'schools/' . $schoolID . '/employees';
        
        $params = [
            'page' => $page,
            'include' => 'employment_details,contact_details',
        ];

        $response = self::get($url, $params);
        return $response->json();
    }


    /**
     * Get a school by ID
     */
    public static function getSchool(string $schoolID) : mixed
    {
        $response = self::get('schools/' . $schoolID );
        return $response->json();
    }


    /**
     * Execute a GET request to the Wonde API
     */
    public static function get(string $endPoint, array $params = [])
    {
        $url = config('services.wonde.url') . '/' . $endPoint;

        info('=== Wonde get URL ==> ' . $url);
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.wonde.token'),
        ])
        ->withQueryParameters($params)
        ->get($url);
    }
}