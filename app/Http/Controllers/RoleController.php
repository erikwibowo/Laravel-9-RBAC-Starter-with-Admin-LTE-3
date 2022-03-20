<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index()
    {
        $x['title']         = 'Role';
        $x['data']          = Role::with('permissions')->get();
        $x['permission']    = Permission::get();
        return view('admin.role', $x);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => ['required'],
            'guard_name'    => ['required'],
            'permissions'   => ['required', 'array'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();
        try {
            $role = Role::create([
                'name'          => $request->name,
                'guard_name'    => $request->guard_name,
            ]);
            $role->givePermissionTo($request->permissions);
            DB::commit();
            Alert::success('Pemberitahuan', 'Data berhasil disimpan')->toToast();
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Pemberitahuan', 'Data gagal disimpan : ' . $th->getMessage())->toToast();
        }
        return back();
    }

    public function show(Request $request)
    {
        $role = Role::with('permissions')->find($request->id);
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
            'permissions'   => ['required', 'array'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();
        try {
            $role = Role::find($request->id);
            $role->update([
                'name'          => $request->name,
                'guard_name'    => $request->guard_name,
            ]);
            $role->syncPermissions($request->permissions);
            DB::commit();
            Alert::success('Pemberitahuan', 'Data berhasil disimpan')->toToast();
        } catch (\Throwable $th) {
            DB::rollback();
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
