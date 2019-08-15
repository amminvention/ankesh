@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Customer</h4>
                        <form class="cmxform" method="POST" action="{{ route('customer.store') }}">
                            @csrf
                            <fieldset>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label for="name">Customer Name</label>
                                            <input id="name" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" name="name" value="{{ old('name') }}" type="text">
                                            @if ($errors->has('name'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <label for="email">Customer Email</label>
                                            <input id="email" class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}" name="email" value="{{ old('email') }}" type="text">
                                            @if ($errors->has('email'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('email') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group{{ $errors->has('whatsapp') ? ' has-danger' : '' }}">
                                            <label for="whatsapp">Customer Whatsapp</label>
                                            <input id="whatsapp" class="form-control{{ $errors->has('whatsapp') ? ' form-control-danger' : '' }}" name="whatsapp" value="{{ old('whatsapp') }}" type="text">
                                            @if ($errors->has('whatsapp'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('whatsapp') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                            <label for="phone">Customer Phone No.</label>
                                            <input id="phone" class="form-control{{ $errors->has('phone') ? ' form-control-danger' : '' }}" name="phone" value="{{ old('phone') }}" type="text">
                                            @if ($errors->has('phone'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('phone') }}</label>
                                            @endif
                                        </div>
                                    </div>
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