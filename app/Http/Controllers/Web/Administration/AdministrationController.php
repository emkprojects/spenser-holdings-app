<?php

namespace App\Http\Controllers\Web\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Carbon;
use DB;
use Str;

class AdministrationController extends Controller
{
    

    public function getDashboard(){

        return view('web.administration.dashboard');
    }



    public function getUnauthorized(){

        return view('web.administration.401');
    }




}
