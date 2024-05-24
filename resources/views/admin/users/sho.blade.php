@extends('layouts.app')

@section('content')
    <h1>User Details</h1>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Roles:</strong></p>
    <ul>
        @foreach ($user->roles as $role)
            <li>{{ $role->name }}</li>
        @endforeach
    </ul>
@endsection
