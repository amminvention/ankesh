@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script>
        (function($) {
            'use strict';
            if ($(".js-example-basic-single").length) {
                $(".js-example-basic-single").select2();
            }
        })(jQuery);
    </script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Profile</h4>
                        <form class="cmxform" method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <fieldset>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label for="name">Name</label>
                                    <input id="name" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" name="name" value="{{ auth()->user()->name }}" type="text" required>
                                    @if ($errors->has('name'))
                                        <label class="error mt-2 text-danger">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label for="email">Email</label>
                                    <input id="email" class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}" name="email" value="{{ auth()->user()->email }}" type="email" required>
                                    @if ($errors->has('email'))
                                        <label class="error mt-2 text-danger">{{ $errors->first('email') }}</label>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label for="password">New Password (leave empty for unchanged)</label>
                                    <input id="password" class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}" name="password" value="{{ old('password') }}" type="password">
                                    @if ($errors->has('password'))
                                        <label class="error mt-2 text-danger">{{ $errors->first('password') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input id="confirm-password" class="form-control" name="password_confirmation" value="{{ old('password') }}" type="password">
                                </div>


                                <input class="btn btn-primary" type="submit" value="Save">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @includeIf('snippets.success', ['success' => session('success')])
    </div>
@endsection