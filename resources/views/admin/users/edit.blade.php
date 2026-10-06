@extends('layouts.admin')

@section('title', 'Edit Admin Account | SmartDalaw')

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-[#0A2472] hover:underline">&larr; Admin accounts</a>
        <h1 class="mt-3 text-2xl font-bold text-[#102044]">Edit admin account</h1>
        <p class="mt-2 text-sm text-slate-600">Update the account details for {{ $managedUser->name }}.</p>
        @include('admin.users.form', ['formAction' => route('admin.users.update', $managedUser), 'isEditing' => true])
    </div>
@endsection