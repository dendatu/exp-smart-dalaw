@extends('layouts.admin')

@section('title', 'Add Admin Account | SmartDalaw')

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-[#0A2472] hover:underline">&larr; Admin accounts</a>
        <h1 class="mt-3 text-2xl font-bold text-[#102044]">Add admin account</h1>
        <p class="mt-2 text-sm text-slate-600">Create a sign-in for someone who needs access to visitation management.</p>
        @include('admin.users.form', ['formAction' => route('admin.users.store'), 'isEditing' => false])
    </div>
@endsection