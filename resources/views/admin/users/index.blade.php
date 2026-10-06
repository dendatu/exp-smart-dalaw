@extends('layouts.admin')

@section('title', 'Admin Accounts | SmartDalaw')

@section('content')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase text-[#0A2472]">Access management</p>
            <h1 class="mt-1 text-2xl font-bold text-[#102044]">Admin accounts</h1>
            <p class="mt-2 text-sm text-slate-600">Manage the accounts that can access the admin area.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex min-h-10 items-center justify-center rounded-md bg-[#0A2472] px-4 py-2 text-sm font-semibold text-white hover:bg-[#071D54]">Add admin account</a>
    </div>

    <div class="mt-7 overflow-x-auto border-y border-slate-200 bg-white">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase text-slate-500">Name</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase text-slate-500">Email</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase text-slate-500">Role / facility</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase text-slate-500">Created</th>
                    <th scope="col" class="px-4 py-3 text-right text-xs font-semibold uppercase text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $managedUser)
                    <tr>
                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-slate-900">{{ $managedUser->name }} @if(auth()->user()->is($managedUser))<span class="ml-1 text-xs font-normal text-slate-500">You</span>@endif</td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-slate-600">{{ $managedUser->email }}</td>
                        <td class="px-4 py-4 text-sm text-slate-700">
                            @if($managedUser->isSuperAdmin())
                                <span class="badge badge-warning">Super Admin</span>
                                <p class="mt-1 text-xs text-slate-500">All facilities</p>
                            @else
                                <span class="badge badge-ghost">Facility Admin</span>
                                <p class="mt-1 text-xs text-slate-500">{{ $managedUser->facility?->name ?? 'Unassigned' }}</p>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-slate-600">{{ $managedUser->created_at->format('M d, Y') }}</td>
                        <td class="whitespace-nowrap px-4 py-4 text-right text-sm">
                            <a href="{{ route('admin.users.edit', $managedUser) }}" class="font-semibold text-[#0A2472] hover:underline">Edit</a>
                            @if(! auth()->user()->is($managedUser))
                                <form action="{{ route('admin.users.destroy', $managedUser) }}" method="POST" class="ml-4 inline" onsubmit="return confirm('Delete this admin account?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-700 hover:underline">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-10 text-center text-sm text-slate-500">No admin accounts found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="mt-5">{{ $users->links() }}</div>
    @endif
@endsection