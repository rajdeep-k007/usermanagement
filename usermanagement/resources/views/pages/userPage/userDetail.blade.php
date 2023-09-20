
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Details: {{ $user->name }}</div>

                <div class="card-body">

                        <div>
                            <div class="row mb-3">
                                <label for="user" class="col-md-4 col-form-label text-md-end">User name:</label>

                                <div class="col-md-6">
                                    <div class="col-form-label text-grey">
                                    {{ $user->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row mb-3">
                                <label for="useremail" class="col-md-4 col-form-label text-md-end">User email:</label>

                                <div class="col-md-6">
                                    <div class="col-form-label text-grey">
                                    {{ $user->email }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row mb-3">
                                <label for="userrole" class="col-md-4 col-form-label text-md-end">User role:</label>

                                <div class="col-md-6">
                                    <div class="col-form-label text-grey">
                                    {{ $user->role=='1'?'Admin':'User' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="created_at" class="col-md-4 col-form-label text-md-end">{{ __('Created At') }}</label>

                            <div class="col-md-6">
                                <div class="col-form-label text-grey">
                                {{ $user->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="updated_at" class="col-md-4 col-form-label text-md-end">{{ __('Updated At') }}</label>

                            <div class="col-md-6">
                                <div class="col-form-label text-grey">
                                {{ $user->updated_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
