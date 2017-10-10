<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
  public static $INDEX_VIEW = "pages.index";
  public function index(Request $request)
  {
    return view(PageController::$INDEX_VIEW, []);
  }
}
