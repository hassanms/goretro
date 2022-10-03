@extends('layouts.admin')
@section('pageTitle')
    Admin Dashboard
@endsection

@section('content')
    <div class="row justify-content-center" style="margin-top: 1%">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-body text-center">
                    <h2>Welcome! You are logged in as {{ auth()->user()->name }}</h2>
                </div>
            </div>
        </div>
    </div>

@endsection
