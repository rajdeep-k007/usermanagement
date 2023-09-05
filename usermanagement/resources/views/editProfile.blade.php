@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ session()->get('user')->name }}'s Profile</div> --}}
                <div class="card-header">Edit User Profile</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('userprofile.form.submit', session()->get('user')->id) }}">
                        @csrf
                        <!-- Form fields go here -->
                        <input type="hidden" name="id" id="userId" value="{{ session()->get('user')->id }}">
                        <div>
                            <div class="row mb-3">
                                <label for="location" class="col-md-4 col-form-label text-md-end">Your location:</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="location" id="location">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row mb-3">
                                <label for="bio" class="col-md-4 col-form-label text-md-end">Your bio:</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="textarea" name="bio" id="bio">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-4">
                            <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection
