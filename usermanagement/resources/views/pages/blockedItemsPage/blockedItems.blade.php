@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header spaceBetween" class="d-flex">
                    <div >Blocked Items List</div>
                    <a class="btn btn-info" href="createBlockedItemPage">+ Add Item to Block</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- blocked item list  --}}
                    {{-- Table  --}}


                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Note</th>
                                    <th>Blocked By</th>
                                    <th>Blocked At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($blockedItems)>0)
                                @foreach($blockedItems as $blockedItem)

                                    <tr>
                                        <td>{{ $blockedItem->id }}</td>
                                        <td>{{ $blockedItem->type }}</td>
                                        <td>{{ $blockedItem->value }}</td>
                                        <td>{{ $blockedItem->note }}</td>
                                        <td>{{ $blockedItem->blocked_by }}</td>
                                        <td>{{ $blockedItem->created_at->diffForHumans() }}</td>
                                        <td>
                                            <button class="btn btn-primary"
                                                href="/editBlockedItem/{{$blockedItem->id}}">
                                                Edit
                                            </button>
                                            <a class="btn btn-danger"
                                                href="/removeBlockedItem/{{$blockedItem->id}}"
                                                onclick="confirmation(event)">
                                                Remove
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7" class="text-grey text-md-center">No data to display!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        {{-- Pagination is possible to add but spoiling css  --}}
                        <div class="row">
                            <div class="col-md-6 col-sm-offset-5 dataCustomPagination">
                                {{ $blockedItems->render() }}
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
