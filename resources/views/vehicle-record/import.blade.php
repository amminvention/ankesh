@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script>
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
                        <h4 class="card-title">Import Vehicle Records</h4>
                        <form class="cmxform" method="POST" action="{{ route('process.import') }}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group{{ $errors->has('import_file') ? ' has-danger' : '' }}">
                                            <label for="import_file">CSV file to import</label>
                                            <input id="import_file" class="form-control{{ $errors->has('import_file') ? ' form-control-danger' : '' }}" name="import_file" type="file" required>
                                            @if ($errors->has('import_file'))
                                                <label class="error mt-2 text-danger">{{ $errors->first('import_file') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @includeIf('snippets.success', ['success' => session('success')])
    </div>
@endsection