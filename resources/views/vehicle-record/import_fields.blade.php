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
                        <form class="cmxform" method="POST" action="{{ route('import_process') }}">
                            @csrf
                            <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
                            <div class="table-responsive">
                                <table class="table">
                                    @if (isset($csv_header_fields))
                                        <tr>
                                            @foreach ($csv_header_fields as $csv_header_field)
                                                <th>{{ $csv_header_field }}</th>
                                            @endforeach
                                        </tr>
                                    @endif
                                    @foreach ($csv_data as $row)
                                        <tr>
                                            @foreach ($row as $key => $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    <tr>
                                        @foreach ($csv_data[0] as $key => $value)
                                            <td>
                                                <select name="fields[{{ $key }}]">
                                                    @foreach (config('app.db_fields') as $db_field)
                                                        <option value="{{ (\Request::has('header')) ? $db_field : $loop->index }}"
                                                                @if ($key === $db_field) selected @endif>{{ $db_field }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        @endforeach
                                    </tr>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Import Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--@includeIf('snippets.success', ['success' => session('success')])--}}
    </div>
@endsection