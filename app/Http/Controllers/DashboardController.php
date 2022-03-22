<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(Request $request){
        $x['title']         = 'Dashboard';
        $x['user']          = User::get();
        $x['role']          = Role::get();
        $x['permission']    = Permission::get();
        return view('admin.dashboard', $x);
    }
}
