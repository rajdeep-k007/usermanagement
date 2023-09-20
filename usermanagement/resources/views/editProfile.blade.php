@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ session()->get('user')->name }}'s Profile</div> --}}
                <div class="card-header">Edit User Profile</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('userprofile.form.submit', Auth::user()->id) }}">

                        {{-- Needed because form support only GET/POST and here for update:patch was necessary  --}}
                        <input type="hidden" name="_method" value="PATCH">

                        @csrf
                        <!-- Form fields go here -->
                        <input type="hidden" name="id" id="userId" value="{{ Auth::user()->id }}" >
                        <div>
                            <div class="row mb-3">
                                <label for="city" class="col-md-4 col-form-label text-md-end">City:</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="city" id="city" required>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row mb-3">
                                <label for="country" class="col-md-4 col-form-label text-md-end">Country:</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="country" id="country" required>
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
