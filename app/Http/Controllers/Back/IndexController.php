<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //后台首页
    public function index(){
      return view('back.index.index');
    }
    public function welcome(){
      return view('back.index.welcome');
    }
}
