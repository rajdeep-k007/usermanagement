@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ session()->get('user')->name }}'s Profile</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-label">Username</div>
                    <p class="text-grey">{{ session()->get('user')->name }}</p>

                    <div class="form-label">Email</div>
                    <p class="text-grey">{{ session()->get('user')->email }}</p>

                    <a class="btn btn-primary btn-sm" role="button" href="{{ route('editProfile') }}" >Edit Profile</a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
