<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    //direct Documentation page
    public function directDocumentation(){
        return view('pages.documentation');
    }
}
