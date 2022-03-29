<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;
use Symfony\Component\HttpFoundation\Response;

class ModuleController extends Controller
{
    public function index(Request $request){
        $x['title']     = "Module";
        $x['enable']    = Module::allEnabled();
        $x['disable']   = Module::allDisabled();
        return view('admin.module', $x);
    }
}
