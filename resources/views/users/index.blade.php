@extends('layouts.app')

@section('title', 'Users')

@section('headTitle', 'Users:')

@section('content')

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger position-absolute top-0 start-100">Logout</button>
    </form>

    <a href="{{ route('users.create') }}" class="btn btn-primary mt-3">Add User</a>
    <a href="{{ route('posts.index') }}" class="btn btn-warning mt-3">Posts</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th class="text-danger" scope="col">#</th>
                <th class="text-danger" scope="col">Name</th>
                <th class="text-danger" scope="col">Email</th>
                <th class="text-danger" scope="col">role</th>
                <th class="text-danger" scope="col">Update</th>
                <th class="text-danger" scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->is_admin == 1)
                            admin
                        @else
                            user
                        @endif
                    </td>
                    <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">update</a></td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
