<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
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
        $getAllPermission = DB::table('role_permission')->where('role_id',$id)->pluck('permission_id');
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

    public function delete($id)
    {
        try{
            DB::beginTransaction();
            $role = $this->role->find($id);
            $role->delete($id);
            $role->roles()->detach();
            DB::commit();
            return redirect('/admin/roles');

        }catch(Exception $exception){
            DB::rollBack();
        }
    }
}
