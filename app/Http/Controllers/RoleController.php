<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDanhSach()
    {
        $roles = Role::all()->groupBy('group');
        return view('admin.quyen.danhsach', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getThem()
    {
        // $role = Role::find($id);
        $permissions = Permission::all()->groupBy('group');
        return view('admin.quyen.them', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postThem(Request $request)
    {
        $dataCreate = $request->all();
        $dataCreate['guard_name'] = 'web';
        $role = Role::latest('id')->paginate(5);
        $role->permissions()->attach($request->permission_ids);
        return redirect()->route('admin.quyen.index', with('success', 'Them thanh cong'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSua($id)
    {
        $role = Role::find($id);
        // dd($role);
        $permissions = Permission::all()->groupBy('group');
        return view('admin.quyen.sua', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getXoa($id)
    {
        $orm = Role::find($id);
        $orm->delete();

        return redirect()->route('admin.quyen.index')->with('success', 'Đã xóa quyền thành công');
    }
}
