@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registration Started | Activation Required</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        {{ session()->put('user',$user) }}
                        <p class="text-grey">
                            Thank you for registering. <br>
                            An email was sent to {{ session()->get('user')->email }}. <br>
                            Please click the link in it to activate your account.
                        </p>
                    <button class="btn btn-primary btn-sm">Click here to resend email</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
