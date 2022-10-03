@extends('layouts.app')
@section('pageTitle')
    Change Password
@endsection

@section('content')
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.updatePassword', [$user->id]) }}" method="post"
                class="form-horizontal">
                @csrf
                @method('put')
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3> 
                            
                    </div>

                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Password<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="password" id="password" name="password" required placeholder=""
                                    class="form-control" data-error="#errorAY">
                                <span id="errorAY"></span>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">New Password<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="password" id="new_password" name="new_password" required placeholder=""
                                    class="form-control" data-error="#errorNP">
                                <span id="errorNP" class="text-danger"></span>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Confirm Password<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="password" id="confirm_password" name="confirm-password" required placeholder=""
                                    class="form-control" data-error="#errorCP">
                                <span id="errorCP"></span>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">
                            Change Password
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection


