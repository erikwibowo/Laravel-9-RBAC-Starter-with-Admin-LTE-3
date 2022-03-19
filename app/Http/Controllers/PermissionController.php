<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    public function index()
    {
        $x['title']     = 'Permission';
        $x['data']      = Permission::get();
        return view('admin.Permission', $x);
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
            Permission::create([
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
        $permission = Permission::find($request->id);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'message'   => 'Data permission by id',
            'data'      => $permission
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
            Permission::find($request->id)->update([
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
            Permission::find($request->id)->delete();
            Alert::success('Pemberitahuan', 'Data berhasil dihapus')->toToast();
        } catch (\Throwable $th) {
            Alert::error('Pemberitahuan', 'Data gagal dihapus : ' . $th->getMessage())->toToast();
        }
        return back();
    }
}
