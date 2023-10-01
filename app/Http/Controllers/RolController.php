<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    public function index(){
        $roles = Role::all();
        //dd($roles);
        return view('roles.index',compact('roles'));
    }

    public function create(){
        $permission = Permission::all();
        //dd($roles);
        return view('roles.create',compact('permission'));
    }

    public function edit($id){
        $role = Role::find($id);
        $permissions = Permission::all();
        //dd($roles);
        return view('roles.edit',compact('permissions','role')); 
    }

    public function update(Request $request){
        $role = Role::find(request()->input('id'));
        $role->name = request()->input('nombre');
        $role->syncPermissions(request()->input('operaciones'));
        $role->save();
        
        return redirect('/home/roleslist'); 
    }

    public function createrol(Request $request){
        $role = Role::create(['name' => $request->input('nombre')]);
        $role->syncPermissions($request->input('operaciones'));
        return redirect('/home/roleslist');
    }

    public function delete($id){
        $role = Role::find($id);
        $role->delete();
        return redirect('/home/roleslist');
    }

    public function show(){
        $roles = Role::all();
        //dd($roles);
        return view('roles.show');
    }
}
