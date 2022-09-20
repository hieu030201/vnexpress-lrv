<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    private $role;
    private $permission;
    private $rolePermiss;
    public function __construct(Role $role, Permission $permission, RolePermission $rolePermiss)
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->rolePermiss = $rolePermiss;
    }

    public function index()
    {
        $roles = $this->role->all();
        return view('admin.roles.index',compact('roles'));
    }
    
    public function create(){
        $permissions = $this->permission->all();
        return view('admin.roles.new',compact('permissions'));
    }

    public function store(Request $request){
        $roles = $this->role->create([
            'name'=>$request->name,
            'display_name'=>$request->display_name
        ]);
        $roles->permissions()->attach($request->permission);
        $request->session()->flash('status',$request->name. 'is saved successfully');
        return redirect('/admin/roles');
    }

    public function edit($id)
    {
        $permissions = $this->permission->all();
        $role = $this->role->findOrfail($id);
        $getAllPermission = $this->rolePermiss->where('role_id',$id)->pluck('permission_id');
        return view('admin.roles.edit',compact('permissions','role','getAllPermission'));
    }
    
    public function update(Request $request,$id)
    {
        $this->role->find($id)->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
        ]);
        DB::table('role_permission')->where('role_id',$id)->delete();
        $roles = $this->role->find($id);
        $roles->permissions()->attach($request->permission);
        return redirect('/admin/roles');
    }

    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            $role = $this->role->find($id);
            $role->delete();
            $role->permissions()->detach();
            DB::commit();
            return redirect('/admin/roles');
        }catch(Exception $exception){
            DB::rollBack();
        }
    }
}
