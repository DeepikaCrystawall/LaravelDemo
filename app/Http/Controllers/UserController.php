<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        view()->share('usr_menuactive','active');
    }
    public function index()
    {
        //
        $title    = "Users";
        $users     = User::where('role_id',2)->get();
        return view('users.list',compact('title','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $title    = "Create User";
        $action   = route('users.store');
        $btn_name  = 'Create';
        return view('users.add',compact('title','action','btn_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $inputs = $request->all();
       // $inputs['pwd'] = Str::random(6);
        $inputs['password']= Hash::make(Str::random(6));
        User::create($inputs);
        return redirect()->route('users.list')->with('success','User created successfully.');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $row     = User::find($id);
        $title    = 'Edit User';
        $action   = route('users.update',$id);
        $btn_name  = 'Update';
        return view('users.add',compact('title','row','action','btn_name'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $row     = User::find($id);
        $inputs = $request->all();
        $row->fill($inputs)->save();
        return redirect()->route('users.index')->with('success','Updated successfully.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        //
        // print_r('fdjfh'); exit;
        User::find($id)->delete();
        return redirect()->route('users')->with('success','Deleted successfully.');
    }
    public function delete(string $id)
    {
        //
        User::where('id', $id)->delete();
        return redirect()->route('users.index')->with('success','Deleted successfully.');
    }
}
