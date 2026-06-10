<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(): View
    {
        return view('admin.roles.index', [
            'roles' => Role::withCount('users')->orderBy('name')->get(),
            'users' => User::with('roles')->latest()->paginate(15),
        ]);
    }

    public function updateUserRoles(Request $request, int $userId): RedirectResponse
    {
        $user = User::findOrFail($userId);

        $validated = $request->validate([
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,id'],
        ]);

        $user->roles()->sync($validated['roles'] ?? []);

        return back()->with('success', 'User roles updated successfully.');
    }
}
