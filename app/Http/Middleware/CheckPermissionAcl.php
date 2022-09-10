<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckPermissionAcl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission = null)
    {
        $listRole = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('users.id',auth()->id())
            ->select('roles.*')
            ->get()->pluck('id')->toArray();

        $listRole = DB::table('roles')
        ->join('role_permission', 'roles.id', '=', 'role_permission.role_id')
        ->join('permissions', 'role_permission.permission_id', '=', 'permissions.id')
        ->whereIn('roles.id',$listRole)
        ->select('permissions.*')
        ->get()->pluck('id')->unique();

        $checkPermission = Permission::where('name',$permission)->value('id');

        if($listRole->contains($checkPermission)){
            return $next($request);
        }
        return abort(401);
    }
}
