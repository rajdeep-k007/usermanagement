@extends('layouts.app')

@section('content')
<div class="container">
    {{-- @php
       {{ $loggedInRole = session()-get('user')->role }};
    @endphp --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <div class="spaceBetween " >
                        <div class="align-self-end">
                            <a class="btn btn-info" href="createUserPage" >+ Create User</a>
                        </div>
                        <hr>
                        <div >Users List </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- User list  --}}
                    {{-- Table  --}}


                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users)>0)
                                @foreach($users as $user)

                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role=='1'?'Admin':'User' }}</td>
                                        @if(Auth::user()->role=='1')
                                        <td>
                                            <button class="btn btn-primary"
                                                href="/editUser/{{$user->id}}">
                                                Edit
                                            </button> |
                                            @if($user->deleted_at != null)
                                            <a class="btn btn-info"
                                                href="/restoreUser/{{$user->id}}"
                                                onclick="restoreconfirmation(event)">
                                                Restore
                                            </a>
                                            @else
                                                @if(Auth::user()->id!==$user->id)
                                                   <a class="btn btn-danger"
                                                       href="/removeUser/{{$user->id}}"
                                                       onclick="confirmation(event)">
                                                       Remove
                                                   </a>
                                                   @endif
                                            {{-- {{ Auth::user()->role=='1'?'01':'00' }} {{ $user->deleted_at}} --}}
                                            @endif
                                        </td>
                                        @else
                                        <td>
                                            <a class="btn btn-primary"
                                                href="/viewUser/{{$user->id}}">
                                                View
                                            </a>
                                        </td>
                                        @endif
                                    </tr>

                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-grey text-md-center">No data to display!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        {{-- Pagination is possible to add but spoiling css  --}}
                        <div class="row">
                            <div class="col-md-6 col-sm-offset-5 dataCustomPagination">
                                {{ $users->render() }}
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
