<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    private $user;
    private $role;
    private $roleUser;
    public function __construct(User $user,Role $role,RoleUser $roleUser)
    {
        $this->user = $user;
        $this->role = $role;
        $this->roleUser = $roleUser;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->orderBy('id', "ASC")->where('level',1)->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role->all();
        return view('admin.users.new',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {    
        try {
            DB::beginTransaction();
            $imageName="noimage.png";
            //if a user upload image
            if($request->avatar){
                $request->validate([
                    'avatar' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
                ]);
                $imageName = date('mdYHis').uniqid().'.'.$request->avatar->extension();
                $request->avatar->move(public_path('avatar_images'),$imageName);
            }
                $users = $this->user;
                $users->name = $request->name;
                $users->email = $request->email;
                $users->password = Hash::make($request->password);
                $users-> avatar= $imageName;
                $users-> level = 1;
                $users->save();
                $users->roles()->attach($request->roles);
                $users->notify(new WelcomeEmailNotification($users));
                $request->session()->flash('status ',$request->name. 'is saved successfully. Email has been sent to '.$request->email);
                DB::commit();
            return redirect('/admin/users'); 
            }catch (Exception $exception){
                DB::rollBack();
                return view('error.users.403');
            }
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
    public function edit($id)
    {
        $user = $this->user->findOrfail($id);
        $roles= $this->role->all();
        $listRoleOfUser = DB::table('role_user')->where('user_id',$id)->pluck('role_id');
        return view('admin.users.edit',compact('roles','user','listRoleOfUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {   
        try {
            DB::beginTransaction();
            $imageName="noimage.png";
            if($request->avatar){
                $request->validate([
                    'avatar' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
                ]);
                $imageName = date('mdYHis').uniqid().'.'.$request->avatar->extension();
                $request->avatar->move(public_path('avatar_images'),$imageName);
            }
                $users = $this->user->find($id);
                $users->name = $request->name;
                $users->email = $request->email;
                $users->password = Hash::make($request->password);
                $users-> avatar= $imageName;
                $users-> level = 1;
                $users->save();
                DB::table('role_user')->where('user_id',$id)->delete();
                $users = $this->user->find($id);
                $users->roles()->attach($request->roles);
                session()->flash('status',$request->name. 'is saved successfully');
            DB::commit();
            return redirect('admin/users');
        }catch (Exception $exception){
            DB::rollBack();
            return view('error.users.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);
        $username = $user->name;
        $path = public_path('/avatar_images/'.$user->avatar);

        if(File::exists($path)){
            File::delete($path);
        }
        $user->delete();
        $user->roles()->detach();
        Session()->flash('status ', ''.$username.' '. 'The User is deleted successfully');
        return redirect('/admin/users');
    }

    public function change_password(){
        return view('admin.users.change-pass');
    }

    public function update_password(ChangePassRequest $request)
    {
        $user = auth()->user();
        if(Hash::check($request->old_password,$user->password)){
            $this->user->find($user->id)->update([
                'password'=>Hash::make($request->new_password),
            ]);
            session()->flash('status',$request->email. 'your password changed successfully');
            return redirect()->back();

        }else{
            session()->flash('status',$request->email. 'your password has not been changed, Old password or confirm pass not true');
            return redirect()->back();
        }
    }
}
