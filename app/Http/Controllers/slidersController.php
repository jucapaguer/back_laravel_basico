<?php

namespace App\Http\Controllers;

use App\sliders;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class slidersController extends Controller
{
    //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $sliders = sliders::all();
        return $sliders;
    }

    //------------PERSONALIZADAS--------------------------------------------------
    public function listMovil(){
        $sliders = sliders::where('aplicativo', 2 )->get();
        return $sliders;
    }

    public function listWeb(){
        $sliders = sliders::where('aplicativo', 1 )->get();
        return $sliders;
    }
}
