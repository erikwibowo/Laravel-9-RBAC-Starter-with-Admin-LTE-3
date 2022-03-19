<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index()
    {
        $x['title']     = 'Role';
        $x['data']      = Role::get();
        return view('admin.role', $x);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => ['required'],
            'guard_name'    => ['required'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }
        try {
            Role::create([
                'name'          => $request->name,
                'guard_name'    => $request->guard_name,
            ]);
            Alert::success('Pemberitahuan', 'Data berhasil disimpan')->toToast();
        } catch (\Throwable $th) {
            Alert::error('Pemberitahuan', 'Data gagal disimpan : ' . $th->getMessage())->toToast();
        }
        return back();
    }

    public function show(Request $request)
    {
        $role = Role::find($request->id);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'message'   => 'Data role by id',
            'data'      => $role
        ], Response::HTTP_OK);
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => ['required'],
            'guard_name'    => ['required'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }
        try {
            Role::find($request->id)->update([
                'name'          => $request->name,
                'guard_name'    => $request->guard_name,
            ]);
            Alert::success('Pemberitahuan', 'Data berhasil disimpan')->toToast();
        } catch (\Throwable $th) {
            Alert::error('Pemberitahuan', 'Data gagal disimpan : ' . $th->getMessage())->toToast();
        }
        return back();
    }

    public function destroy(Request $request)
    {
        try {
            Role::find($request->id)->delete();
            Alert::success('Pemberitahuan', 'Data berhasil dihapus')->toToast();
        } catch (\Throwable $th) {
            Alert::error('Pemberitahuan', 'Data gagal dihapus : ' . $th->getMessage())->toToast();
        }
        return back();
    }
}
