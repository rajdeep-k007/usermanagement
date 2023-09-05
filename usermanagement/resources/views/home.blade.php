@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        {{-- we set USER in session here  --}}
        {{ session()->put('user',$user) }}

        {{-- if user not verified  --}}
        @if(session()->get('user')->isMailChecked=='0')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registration Started | Activation Required</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <p class="text-grey">
                            Thank you for registering. <br>
                            An email was sent to {{ session()->get('user')->email }}. <br>
                            Please click the link in it to activate your account.
                        </p>
                    <button class="btn btn-primary btn-sm">Click here to resend email</button>
                </div>
            </div>
        </div>
        {{-- if user is verified  --}}
        @else
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- OUTPUT  --}}
                    {{-- {{ session()->get('user') }}<br> --}}

                    {{ __('You are logged in!') }} <br>
                </div>
            </div>
        </div>
        @endif


    </div>
</div>
@endsection
