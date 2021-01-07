<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('is_admin', false)->get();
        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'min:8'
        ]);
        $is_admin = false;
        if ($request->is_admin) {
            $is_admin = true;
        }

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'is_admin' => $is_admin,
        ]);

        session()->flash('good', 'User Created Successfully');

        return redirect()->back();
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
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
        $user =    User::findOrFail($id);
        return view('admin.pages.users.edit', compact('user'));
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

        $request->validate([
            'username' => 'required',
            'email' => 'required',

        ]);
        $is_password = false;

        if ($request->password) {
            $request->validate([
                'password' => 'min:8',

            ]);
            $is_password = true;
        }
        $user =    User::findOrFail($id);
        if ($is_password) {
            $user->password =    Hash::make($request->password);
        }
        $is_admin = false;
        if ($request->is_admin) {
            $is_admin = true;
        }
        if (auth('sanctum')->id() == $user->id) {
            $is_admin = true;
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->is_admin = $is_admin;
        $user->save();
        session()->flash('good', 'User Updated Successfully');

        return redirect()->back();
    }



    public function banUserAndUnban($id)
    {
        $user  =  User::findOrFail($id);

        if ($user->is_banned) {
            $user->is_banned = false;
            session()->flash('good', 'User UnBanned Successfully');
        } else {
            session()->flash('good', 'User Banned Successfully');
            $user->is_banned = true;
        }
        $user->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        Server::where('user_id', $id)->delete();
        session()->flash('good', 'User Deleted Successfully');
        return redirect()->back();
    }
}
