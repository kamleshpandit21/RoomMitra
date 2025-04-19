<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    //
    public function index(){
        return view('common.complaint');
    }
    public function store(Request $request){
        //
        
    }
}
