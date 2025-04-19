<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommonFaqController extends Controller
{
    public function index()
    {
        //
      return  view('common.faq');
    }

}
