@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script>
        $('#last_pay_date').datepicker({
            todayHighlight: true,
            format: 'dd/mm/yyyy',
        });
        $('#date_of_install').datepicker({
            todayHighlight: true,
            format: 'dd/mm/yyyy',
        });
        $('#renewal_date').datepicker({
            todayHighlight: true,
            format: 'dd/mm/yyyy',
        });
        // Jquery Tag Input Starts
        $('#tags').tagsInput({
            'width': '100%',
            'height': '75%',
            'interactive': true,
            'defaultText': 'Add More',
            'removeWithBackspace': true,
            'minChars': 0,
            'maxChars': 20, // if not provided there is no limit
            'placeholderColor': '#666666'
        });
        $(".js-example-basic-single").select2();
    </script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Vehicle Record</h4>
                        <form class="cmxform" method="POST" action="{{ route('vehicle-record.store') }}">
                            @csrf
                            <fieldset>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('vehicle_no') ? ' has-danger' : '' }}">
                                            <label for="vehicle_no">Vehicle No.</label>
                                            <input id="vehicle_no" class="form-control{{ $errors->has('vehicle_no') ? ' form-control-danger' : '' }}" name="vehicle_no" value="{{ old('vehicle_no') }}" type="text">
                                            @if ($errors->has('vehicle_no'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('vehicle_no') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group{{ $errors->has('customer_id') ? ' has-danger' : '' }}">
                                            <label for="customer_id">Customer</label>
                                            <select id="customer_id" name="customer_id" class="js-example-basic-single w-100">
                                                @foreach($customers as $id => $name)
                                                    <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $id.") " . " " . $name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('customer_id'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('customer_id') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('device_model') ? ' has-danger' : '' }}">
                                            <label for="device_model">Device Model</label>
                                            <input id="device_model" class="form-control{{ $errors->has('device_model') ? ' form-control-danger' : '' }}" name="device_model" value="{{ old('device_model') }}" type="text">
                                            @if ($errors->has('device_model'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('device_model') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('device_imei') ? ' has-danger' : '' }}">
                                            <label for="device_imei">Device IMEI</label>
                                            <input id="device_imei" class="form-control{{ $errors->has('device_imei') ? ' form-control-danger' : '' }}" name="device_imei" value="{{ old('device_imei') }}" type="text">
                                            @if ($errors->has('device_imei'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('device_imei') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('sim_no') ? ' has-danger' : '' }}">
                                            <label for="sim_no">SIM No.</label>
                                            <input id="sim_no" class="form-control{{ $errors->has('sim_no') ? ' form-control-danger' : '' }}" name="sim_no" value="{{ old('sim_no') }}" type="text">
                                            @if ($errors->has('sim_no'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('sim_no') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('last_pay_date') ? ' has-danger' : '' }}">
                                            <label for="last_pay_date">Last Payment Date</label>
                                            <div class="input-group date datepicker">
                                                <input id="last_pay_date" class="form-control{{ $errors->has('last_pay_date') ? ' form-control-danger' : '' }}" name="last_pay_date" value="{{ old('last_pay_date') }}" type="text">
                                                <span class="input-group-addon input-group-append border-left">
                                                  <span class="mdi mdi-calendar input-group-text"></span>
                                                </span>
                                            </div>
                                            @if ($errors->has('last_pay_date'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('last_pay_date') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('last_pay_amount') ? ' has-danger' : '' }}">
                                            <label for="last_pay_amount">Last Payment Amount</label>
                                            <input id="last_pay_amount" class="form-control{{ $errors->has('last_pay_amount') ? ' form-control-danger' : '' }}" name="last_pay_amount" value="{{ old('last_pay_amount') }}" type="text">
                                            @if ($errors->has('last_pay_amount'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('last_pay_amount') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('sale_type_id') ? ' has-danger' : '' }}">
                                            <label for="sale_type_id">Sale Type</label>
                                            <select id="sale_type_id" name="sale_type_id" class="js-example-basic-single w-100">
                                                @foreach($sale_types as $id => $name)
                                                    <option value="{{ $id }}" {{ old('sale_type_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('sale_type_id'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('sale_type_id') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('date_of_install') ? ' has-danger' : '' }}">
                                            <label for="date_of_install">Date of Installation</label>
                                            <div class="input-group date datepicker">
                                                <input id="date_of_install" class="form-control{{ $errors->has('date_of_install') ? ' form-control-danger' : '' }}" name="date_of_install" value="{{ old('date_of_install') }}" type="text">
                                                <span class="input-group-addon input-group-append border-left">
                                                  <span class="mdi mdi-calendar input-group-text"></span>
                                                </span>
                                            </div>
                                            @if ($errors->has('date_of_install'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('date_of_install') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('renewal_date') ? ' has-danger' : '' }}">
                                            <label for="renewal_date">Renewal Date</label>
                                            <div class="input-group date datepicker">
                                                <input id="renewal_date" class="form-control{{ $errors->has('renewal_date') ? ' form-control-danger' : '' }}" name="renewal_date" value="{{ old('renewal_date') }}" type="text">
                                                <span class="input-group-addon input-group-append border-left">
                                                  <span class="mdi mdi-calendar input-group-text"></span>
                                                </span>
                                            </div>
                                            @if ($errors->has('renewal_date'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('renewal_date') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('renewal_amount') ? ' has-danger' : '' }}">
                                            <label for="renewal_amount">Renewal Amount</label>
                                            <input id="renewal_amount" class="form-control{{ $errors->has('renewal_amount') ? ' form-control-danger' : '' }}" name="renewal_amount" value="{{ old('renewal_amount') }}" type="text">
                                            @if ($errors->has('renewal_amount'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('renewal_amount') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('duration') ? ' has-danger' : '' }}">
                                            <label for="duration">Duration</label>
                                            <input id="duration" class="form-control{{ $errors->has('duration') ? ' form-control-danger' : '' }}" name="duration" value="{{ old('duration') }}" type="text">
                                            @if ($errors->has('duration'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('duration') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('agreed_rate') ? ' has-danger' : '' }}">
                                            <label for="agreed_rate">Agreed Rate</label>
                                            <input id="agreed_rate" class="form-control{{ $errors->has('agreed_rate') ? ' form-control-danger' : '' }}" name="agreed_rate" value="{{ old('agreed_rate') }}" type="text">
                                            @if ($errors->has('agreed_rate'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('agreed_rate') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('sales_person') ? ' has-danger' : '' }}">
                                            <label for="tags">Names of Sale Person</label>
                                            <input id="tags" class="form-control{{ $errors->has('sales_person') ? ' form-control-danger' : '' }}" name="sales_person" type="text" value="{{ old('sales_person') }}" autocomplete="off">
                                            @if ($errors->has('sales_person'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('sales_person') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group{{ $errors->has('remarks') ? ' has-danger' : '' }}">
                                            <label for="remarks">Remarks</label>
                                            <textarea rows="6" id="remarks" class="form-control{{ $errors->has('remarks') ? ' form-control-danger' : '' }}" name="remarks" type="text">{{ old('remarks') }}</textarea>
                                            @if ($errors->has('remarks'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('remarks') }}</label>
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