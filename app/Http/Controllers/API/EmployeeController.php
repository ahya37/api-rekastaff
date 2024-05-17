<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HrdPosition;
use App\Services\DatabaseClient;
use App\Services\HrdPositionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseFormatter;
use App\Services\CityService;

class EmployeeController extends Controller
{
    protected $dbName;
    
    public function __construct(Request $request)
    {
        $this->dbName = DatabaseClient::dbClient($request);        
    }

    public function create(Request $request)
    {
        // get data posisi
        $positions = HrdPositionService::getFullPositions($this->dbName);

        // get data kota atau kabupaten
        $cities    = CityService::getFullCity($this->dbName);

        return ResponseFormatter::success([
            'positions' => $positions,
            'cities'    => $cities
        ]);
    }
}
