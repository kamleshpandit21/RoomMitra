<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class CommonFaqController extends Controller
{
  public function index()
  {
    //
    $faqs = Faq::where('is_active', true)->orderBy('category')->get()->groupBy('category');
    return view('common.faq', compact('faqs'));
  }

}
