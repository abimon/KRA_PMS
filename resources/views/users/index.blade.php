@extends('layouts.dashboard',['title'=>'Users'])
@section('dashboard')
<table class="table table-responsive h-100">
    <thead style="white-space:nowrap;">
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone No.</th>
        <th>KRA PIN</th>
        <th>ID</th>
        <th>Role</th>
        <th colspan="{{Auth()->user()->isAdmin?4:3}}" style="text-align:center;">Action</th>
    </thead>
    <tbody>
        @foreach ($users as $key => $user)
            <tr style="white-space:nowrap;">
                <td>{{$key + 1}}</td>
                <td>{{$user->fname}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->contact}}</td>
                <td>{{$user->kra_pin}}</td>
                <td>{{$user->id_number}}</td>
                <td>{{$user->role}}</td>
                <td>
                    <form action="{{route('user.show', $user->id)}}" method="post">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-primary">View</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('user.edit', $user->id)}}" method="post">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('user.destroy', $user->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                @if(AUth()->user()->isAdmin)
                <td>
                    <form action="{{route('user.update', $user->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="isAdmin" value="1">
                        <button type="submit" class="btn btn-danger">Make Admin</button>
                    </form>
                </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@endsection