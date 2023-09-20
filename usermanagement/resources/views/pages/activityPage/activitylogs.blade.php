@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header spaceBetween" class="d-flex">
                    <div >Activity Logs</div>
                    {{-- <button class="btn btn-info">+ Create Activity Logs</button> --}}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- activity Logs list  --}}
                    {{-- Table  --}}


                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Time</th>
                                    <th>Description</th>
                                    <th>User</th>
                                    <th>Method</th>
                                    <th>Route</th>
                                    <th>User Ip</th>
                                    @if(Auth::user()->role=="1")
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($activityLogs)>0)
                                @foreach($activityLogs->reverse() as $activityLog)

                                    <tr>
                                        <td>{{ $activityLog->id }}</td>
                                        <td>{{ $activityLog->created_at->diffForHumans() }}</td>
                                        <td>{{ $activityLog->description }}</td>
                                        <td>{{ $activityLog->user }}  ( {{$activityLog->user_agent=='1'?'Admin':'User' }} ) </td>
                                        <td>{{ $activityLog->method }}</td>
                                        <td>{{ $activityLog->route }}</td>
                                        <td>{{ $activityLog->user_ip }}</td>
                                        @if(Auth::user()->role=="1")
                                        <td>

                                            @if($activityLog->deleted_at != null)
                                            <a class="btn btn-info"
                                                href="/restoreActivity/{{$activityLog->id}}"
                                                onclick="confirmation(event)">
                                                Restore
                                            </a>
                                            @else
                                                <a class="btn btn-danger"
                                                href="/removeActivityLog/{{$activityLog->id}}"
                                                onclick="confirmation(event)">
                                                Remove
                                            </a>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>

                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8" class="text-grey text-md-center">No data to display!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        {{-- Pagination is possible to add but spoiling css  --}}
                        <div class="row">
                            <div class="col-md-6 col-sm-offset-5 dataCustomPagination">
                                {{ $activityLogs->render() }}
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
