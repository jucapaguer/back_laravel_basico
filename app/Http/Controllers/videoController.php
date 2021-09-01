<?php

namespace App\Http\Controllers;

use App\video;
use App\video_instrumento;
use Illuminate\Http\Request;
use Validator, Hash, DB;

class videoController extends Controller
{
   //------------CRUD--BASICO--------------------------------------------------
    public function list(){
        $video = video::all();
        return $video;
    }

    public function create(Request $request){

    }

    public function update(Request $request){

    }

    public function delete($id){
        
    }

}
