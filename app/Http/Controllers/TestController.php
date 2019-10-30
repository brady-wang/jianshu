<?php

namespace App\Http\Controllers;

use App\CustomFacades\Foo;
use App\Lib\Tools\FooBar;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(FooBar $fooBar)
    {
    	dd($fooBar->get());
    }
}
