@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header spaceBetween" class="d-flex">
                    <a class="btn btn-info" href="createPermissionPage">+ Create Permission</a>
                    <hr>
                    <div >Permissions List</div>
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
                                    @if(Auth::user()->role=="1")
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($permissions)>0)
                                @foreach($permissions as $permission)

                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        @if(Auth::user()->role=="1")
                                        <td>

                                            @if($user->deleted_at != null)
                                            <a class="btn btn-danger"
                                                href="/removePermission/{{$permission->id}}"
                                                onclick="confirmation(event)">
                                                Remove
                                            </a>
                                            @else
                                            <a class="btn btn-info"
                                                href="/restorePermission/{{$permission->id}}">
                                                Restore
                                            </a>
                                            @endif
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
                                {{ $permissions->render() }}
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
