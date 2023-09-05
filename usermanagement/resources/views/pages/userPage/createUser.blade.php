
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create User</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('createUser') }}">
                        @csrf

                        <div>
                            <div class="row mb-3">
                                <label for="user" class="col-md-4 col-form-label text-md-end">User name:</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="username" id="username">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row mb-3">
                                <label for="useremail" class="col-md-4 col-form-label text-md-end">User email:</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="email" name="useremail" id="useremail">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row mb-3">
                                <label for="userrole" class="col-md-4 col-form-label text-md-end">User role:</label>

                                <div class="col-md-6">
                                    <select name="userrole" class="form-control">
                                        @foreach (['User'=>'0','Admin'=>'1'] as $key => $value)
                                            <option value="{{ $value }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
