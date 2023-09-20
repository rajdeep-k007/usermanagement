
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Item to Block</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('addItemToBlock') }}">
                        @csrf

                        <div>
                            <div class="row mb-3">
                                <label for="block_type" class="col-md-4 col-form-label text-md-end">Block Type:</label>

                                <div class="col-md-6">
                                    <select name="block_type" class="form-control">
                                        @foreach(['email'=>'E-mail','location'=>'Location', 'domain'=>'Domain','ip'=>'Ip Address'] as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row mb-3">

                                <label for="block_value" class="col-md-4 col-form-label text-md-end">Block Value:</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="block_value" id="block_value" required>
                                </div>

                            </div>
                        </div>

                        <div>
                            <div class="row mb-3">
                                <label for="blocked_user" class="col-md-4 col-form-label text-md-end">Blocked User:</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="blocked_user" id="blocked_user">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="block_note" class="col-md-4 col-form-label text-md-end">Blocked Note:</label>

                            <div class="col-md-6">
                                <textarea class="form-control" type="text" name="block_note" id="block_note"></textarea>
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
