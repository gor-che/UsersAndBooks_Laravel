@extends('layouts.app')

@section('content')
@include('head')

<center><h2>Users</h2></center>

<table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                </tr>
        @endforeach
    </table>

    {!! $users->links() !!}

@endsection