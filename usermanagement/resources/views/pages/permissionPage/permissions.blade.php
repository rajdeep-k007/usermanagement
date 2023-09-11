@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header spaceBetween" class="d-flex">
                    <div >Permissions List</div>
                    <a class="btn btn-info" href="createRolePage">+ Create Role</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- permission list  --}}
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
                                @if(count($permissions)>0)
                                @foreach($permissions as $permission)

                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->email }}</td>
                                        <td>{{ $permission->role=='1'?'Admin':'User' }}</td>
                                        <td>
                                            <button class="btn btn-primary"
                                                href="/editPermission/{{$permission->id}}">
                                                Edit
                                            </button>
                                            <a class="btn btn-danger"
                                                href="/removePermission/{{$permission->id}}"
                                                onclick="confirmation(event)">
                                                Remove
                                            </a>
                                        </td>
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
                                {{ $permissions->render() }}
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
