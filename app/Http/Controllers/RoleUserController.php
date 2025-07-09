<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function index() {
        if (!auth()->user()->isAdmin()){
            abort(403, 'Unauthorized');
        }
        
        $users = User::all();
        return Inertia::render('Admin/Roles/Index', [
            'users' => $users
        ]);
    }

    public function update(Request $request, User $user){
        if(!auth()->user()->isAdmin()){
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'role' => 'required | in:user,admin'
        ]);

        return redirect()->back()->with('success', 'Role updated successfully');
    }
}
