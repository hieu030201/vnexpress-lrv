<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user;
    private $role;
    public function __construct(User $user,Role $role)
    {
        $this->user = $user;
        $this->role = $role;
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
    public function store(Request $request)
    {    
        try {
            DB::beginTransaction();
            $request->validate([
                'email'=>'required|max:255',
            ]);
            $imageName="noimage.png";
            //if a user upload image
            if($request->avatar){
                $request->validate([
                    'avatar' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
                ]);
                $imageName = date('mdYHis').uniqid().'.'.$request->avatar->extension();
                $request->avatar->move(public_path('avatar_images'),$imageName);
            }
                // $users = $this->user->create([
                //     'name' => $request->name,
                //     'email' => $request->email,
                //     'password' => Hash::make($request->password),
                //     'avatar' => $imageName,
                // ]);
                $users = new User();
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
    public function update(Request $request, $id)
    {   
        try {
            DB::beginTransaction();
            $request->validate([
                'name'=>'required|max:255',
                'email'=>'required|max:255',
            ]);
            $imageName="noimage.png";
            //if a user upload image
            if($request->avatar){
                $request->validate([
                    'avatar' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
                ]);
                $imageName = date('mdYHis').uniqid().'.'.$request->image->extension();
                $request->image->move(public_path('avatar_images'),$imageName);
            }
                $users = User::find($id);
                $users->name = $request->name;
                $users->email = $request->email;
                $users->password = Hash::make($request->password);
                $users-> avatar= $imageName;
                $users-> level = 1;
                $users->save();
                DB::table('role_user')->where('user_id',$id)->delete();
                $users = $this->user->find($id);
                $users->roles()->attach($request->roles);
            $request->session()->flash('status',$request->name. 'is saved successfully');
            DB::commit();
            return redirect('admin/users');
        }catch (Exception $exception){
            DB::rollBack();
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
        $user = User::find($id);
        $username = $user->name;
        $user->delete();
        $user->roles()->detach();
        Session()->flash('status ', ''.$username.' '. 'The User is deleted successfully');
        return redirect('/admin/users');
    }
}
