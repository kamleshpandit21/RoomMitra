<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermConditionController extends Controller
{
    //
    public function index()
    {
        return view('admin.terms-condition');
    }
}
