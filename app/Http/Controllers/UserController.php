<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use app\User;
use Auth;
use Hash;
use DataTables;

class UserController extends Controller
{
    public function form(){
    	$data = User::where('id', Auth::id())->first();
    	return view('dashboard.user.setting',compact('data'));
    }

    public function update_form(Request $request){

    	$id = Auth::id();

    	\Validator::make($request->all(), [
            'name'  => 'required|min:5|string',
            'email' => 'email|required|unique:users,email,' .$id,
            'password' => 'nullable|confirmed|min:6',
            'password_confirmation' => 'same:password',
        ])->validate();

    	if(!empty($request->password)){
    		$field = [
    			'name' => $request->name,
    			'email' => $request->email,
    			'password' => bcrypt($request->password),
    		];
    	}else{
    		$field = [
    			'name' => $request->name,
    			'email' => $request->email,
    		];
    	}

    	$result = User::where('id', $id)->update($field);

    	if($result){
    		return back()->with('result','success');
    	}else{
    		return back()->with('result','fail');
    	}

    }

    public function index(){
    	return view('dashboard.user.index');
    }

    public function create(){
    	return view('dashboard.user.create');
    }

    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'name'  => 'required|min:5|string',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' =>'required',
            'status' =>'required'
        ])->validate();

        $request->merge([
            'password' => Hash::make($request->password)
        ]);
        $user = User::create($request->except('password_confirmation'));

        if ($user) {
            return redirect()->route('user.index')->with('info', 'User Berhasil di Buat');
        }else{
            return redirect()->route('user.index')->with('danger', 'User Gagal di Buat');
        }
    }

   public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $request->merge([
                'password' => Hash::make($request->password)
            ]);
            $user->update($request->except('password_confirmation'));
            return redirect()->route('user.index')->with('info', 'User Berhasil di Update');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('info', 'User Berhasil di hapus');
    }

     public function data()
    {
        $data = User::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('name', function($item) {
                            $nama = $item->name.'<br>';
                            $edit = '<a href="'. route('user.edit', $item->id) .'">Edit</a> ';
                            $delete = '<a href="'. route('user.destroy', $item->id) .'">Delete</a>';
                            return $nama.$edit.$delete;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }
}
