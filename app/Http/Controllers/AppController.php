<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Services\WondeApi;

class AppController extends Controller
{
    const DATE_FORMAT = 'd F Y';

    public function index()
    {
        $currentPage = 1;
        $schoolID = 'A1930499544';
        $teachers = [];

        $response = WondeApi::getSchoolEmployees($schoolID, $currentPage);

        if (Arr::get($response, 'meta.pagination.more', false)) {
            while ($response['meta']['pagination']['more']) {
                $currentPage++;

                $res = WondeApi::getSchoolEmployees($schoolID, $currentPage);
                $response['data'] = array_merge($response['data'], $res['data']);
                $response['meta'] = $res['meta'];
            }
        }

        $employees = collect($response['data'])->map(function($employee) {
            $details = Arr::get($employee, 'employment_details.data', []);
            $emails = Arr::get($employee, 'contact_details.data.emails', []);

            return [
                'id' => $employee['mis_id'],
                'title' => Arr::get($employee, 'title'),
                'name' => Arr::get($employee, 'forename') . ' ' . Arr::get($employee, 'surname'),
                'isCurrent' => Arr::get($details, 'current'),
                'isTeacher' => Arr::get($details, 'teaching_staff'),
                'startDate' => Carbon::parse($details['employment_start_date']['date'])->format(self::DATE_FORMAT),
                'email' => Arr::get($emails, 'primary'),
            ];
        });
        
        $teachers = $employees->filter(function($employee) {
            return $employee['isCurrent'] && $employee['isTeacher'];
        })->sortBy('name');

        return view('welcome', compact('teachers'));
    }
}
