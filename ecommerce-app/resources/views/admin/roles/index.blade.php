@extends('admin.layouts.app')

@section('title', 'User Roles')

@section('content')
@include('admin.partials.page-header', ['title' => 'User Roles', 'breadcrumb' => 'Many to Many'])

<div class="mb-6 grid gap-4 sm:grid-cols-3">
    @foreach ($roles as $role)
        <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Role</p>
            <p class="mt-1 text-xl font-bold capitalize text-slate-800">{{ $role->name }}</p>
            <p class="mt-2 text-sm text-slate-500">{{ $role->users_count }} user(s)</p>
        </div>
    @endforeach
</div>

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-4 py-3">
        <h3 class="text-base font-semibold text-slate-800">Assign Roles to Users</h3>
        <p class="text-xs text-slate-500">Users ↔ Roles (role_user pivot table)</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-left text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Roles</th>
                    <th class="px-4 py-3">Update</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($users as $user)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-slate-500">{{ $user->id }}</td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.roles.users.update', $user->id) }}" method="POST" id="roles-form-{{ $user->id }}">
                                @csrf
                                @method('PUT')
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($roles as $role)
                                        <label class="flex items-center gap-1.5 text-xs">
                                            <input
                                                type="checkbox"
                                                name="roles[]"
                                                value="{{ $role->id }}"
                                                form="roles-form-{{ $user->id }}"
                                                @checked($user->roles->contains('id', $role->id))
                                            >
                                            <span class="capitalize">{{ $role->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </form>
                        </td>
                        <td class="px-4 py-3">
                            <button type="submit" form="roles-form-{{ $user->id }}" class="rounded bg-admin-primary px-3 py-1 text-xs font-semibold text-white hover:bg-blue-600">Save</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="border-t border-slate-200 px-4 py-3">{{ $users->links() }}</div>
</div>
@endsection
