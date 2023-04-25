<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\RoleService;

class RoleController extends Controller
{
    protected RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

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
        $this->roleService->create($request);
        return redirect()->route('admin.quyen.index')->with('success', 'Thêm quyền thành công');
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
    public function postSua(Request $request, $id)
    {
        // dd($request);
        $this->roleService->update($request, $id);
        return redirect()->route('admin.quyen.index')->with('success', 'Sửa quyền thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getXoa($id)
    {
        $this->roleService->delete($id);

        return redirect()->route('admin.quyen.index')->with('success', 'Đã xóa quyền thành công');
    }
}
