<?php

namespace App\Http\Controllers\APi\V1\Geodata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Log;
use Auth;
use DB;
use Str;
use Carbon;

//use App\Models\Distric;

class DistrictController extends Controller
{
    

    public function getDistricts(){

        $districts = DB::table('districts')->select('id', 'name', 'created_at')->get();

        if($districts === null){

            //info($districts);

            return response()->json([
                'message' => 'Error could not retrieved Districts'
            ], 403);

        }

        return response()->json([
            'success' => true,
            'details' => $districts,
            'messages' => 'Records retrieved successfully',

        ]);

    }


    

}
