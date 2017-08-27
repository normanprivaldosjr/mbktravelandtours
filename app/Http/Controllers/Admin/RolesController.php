<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleFormRequest;
use App\Role;
use app\Permission;

class RolesController extends Controller
{
    public function create()
    {
        return view('backend.roles.create');
    }
    public function store(RoleFormRequest $request)
	{
		$owner = new Role();
		$owner->name = $request->get('name');
		$owner->save();

	    return redirect('/admin/roles/create')->with('status', 'A new role has been created!');
	}

	public function index()
	{
	    $roles = Role::all();
	    return view('backend.roles.index', compact('roles'));
	}
}
