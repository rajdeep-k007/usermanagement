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
                                    <th>Description</th>
                                    <th>User</th>
                                    <th>Method</th>
                                    <th>Route</th>
                                    <th>User Ip</th>
                                    <th>User Agent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($activityLogs)>0)
                                @foreach($activityLogs as $activityLog)

                                    <tr>
                                        <td>{{ $activityLog->id }}</td>
                                        <td>{{ $activityLog->description }}</td>
                                        <td>{{ $activityLog->user }}</td>
                                        <td>{{ $activityLog->method }}</td>
                                        <td>{{ $activityLog->route }}</td>
                                        <td>{{ $activityLog->route }}</td>
                                        <td>{{ $activityLog->ip_address }}</td>
                                        <td>{{ $activityLog->user_agent=='1'?'Admin':'User' }}</td>
                                        <td>
                                            <button class="btn btn-primary"
                                                href="/editActivityLog/{{$activityLog->id}}">
                                                Edit
                                            </button>
                                            <a class="btn btn-danger"
                                                href="/removeActivityLog/{{$activityLog->id}}"
                                                onclick="confirmation(event)">
                                                Remove
                                            </a>
                                        </td>
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
