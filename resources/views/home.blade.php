@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <style>
        .child{
            border-color: #e67a7a;
            background-color: #f1b8b8;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="{{ asset('js/tooltips.js') }}"></script>
    <script>
        (function($) {
            'use strict';
            $(function() {
                $('#vehicle-record').DataTable({
                    responsive: true,
                    "aLengthMenu": [
                        [5, 10, 15, -1],
                        [5, 10, 15, "All"]
                    ],
                    "iDisplayLength": 10,
                    "language": {
                        search: ""
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        { extend: 'excelHtml5', className: 'btn btn-primary', title: 'Vehicle Records', text: 'Export to Excel', exportOptions: {
                                columns: "thead th:not(.noExport)"
                            }},
                        { extend: 'pdfHtml5', className: 'btn btn-primary', title: 'Vehicle Records', text: 'Export to PDF', exportOptions: {
                                columns: "thead th:not(.noExport)"
                            }},
                    ]
                });
                $('#vehicle-record-2').DataTable({
                    responsive: true,
                    "aLengthMenu": [
                        [5, 10, 15, -1],
                        [5, 10, 15, "All"]
                    ],
                    "iDisplayLength": 10,
                    "language": {
                        search: ""
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        { extend: 'excelHtml5', className: 'btn btn-primary', title: 'Vehicle Records', text: 'Export to Excel', exportOptions: {
                                columns: "thead th:not(.noExport)"
                            }},
                        { extend: 'pdfHtml5', className: 'btn btn-primary', title: 'Vehicle Records', text: 'Export to PDF', exportOptions: {
                                columns: "thead th:not(.noExport)"
                            }},
                    ]
                });
                $('#order-listing').each(function() {
                    var datatable = $(this);
                    // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                    var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                    search_input.attr('placeholder', 'Search');
                    search_input.removeClass('form-control-sm');
                    // LENGTH - Inline-Form control
                    var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                    length_sel.removeClass('form-control-sm');
                });
            });
        })(jQuery);
    </script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-xl-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">OVERDUE PAYMENT (CURRENT MONTH OVERDUE)</h4>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted">TOTAL AMOUNT: {{ $monthly_pending->sum('renewal_amount') }}</p>
                            <p class="text-muted">TOTAL NO. OF VEHICLES: {{ $monthly_pending->count() }}</p>
                        </div>
                        <div class="progress progress-md">
                            <div class="progress-bar bg-warning w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">OVERDUE PAYMENT (ALL PAST MONTHS OVERDUE)</h4>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted">TOTAL AMOUNT: {{ $vehicle_records->sum('renewal_amount') }}</p>
                            <p class="text-muted">TOTAL NO. OF VEHICLES: {{ $vehicle_records->count() }}</p>
                        </div>
                        <div class="progress progress-md">
                            <div class="progress-bar bg-danger w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">OVERDUE PAYMENTS CUSTOMERWISE (CURRENT MONTH)</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="vehicle-record" class="table dt-responsive nowrap" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer</th>
                                            <th>No. of Vehicles</th>
                                            <th>Amount</th>
                                            <th class="noExport">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($overdue_monthly->count() > 0)
                                            @foreach($overdue_monthly as $vehicle_record)
                                                <tr class="table-danger">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $vehicle_record->name }}</td>
                                                    <td>{{ $vehicle_record->nov }}</td>
                                                    <td>{{ $vehicle_record->amount }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('vehicle-record.edit', $vehicle_record->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit Record">
                                                                <i class="mdi mdi-lead-pencil"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">OVERDUE PAYMENTS CUSTOMERWISE (ALL PAST MONTHS)</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="vehicle-record-2" class="table dt-responsive nowrap" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer</th>
                                            <th>No. of Vehicles</th>
                                            <th>Amount</th>
                                            <th class="noExport">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($overdue_all->count() > 0)
                                            @foreach($overdue_all as $vehicle_record)
                                                <tr class="table-danger">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $vehicle_record->name }}</td>
                                                    <td>{{ $vehicle_record->nov }}</td>
                                                    <td>{{ $vehicle_record->amount }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('vehicle-record.edit', $vehicle_record->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit Record">
                                                                <i class="mdi mdi-lead-pencil"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Vehicle Records</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="vehicle-record" class="table dt-responsive nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vehicle No.</th>
                                    <th>Customer Name</th>
                                    <th>Installation Date</th>
                                    <th>Last Pay Date</th>
                                    <th>Last Pay Amount</th>
                                    <th>Renewal Date</th>
                                    <th>Renewal Amount</th>
                                    <th>Duration</th>
                                    <th class="noExport">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($vehicle_records->count() > 0)
                                    @foreach($vehicle_records as $vehicle_record)
                                        <tr class="table-danger">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $vehicle_record->vehicle_no }}</td>
                                            <td>{{ $vehicle_record->customers == null ? '' : $vehicle_record->customers->name }}</td>
                                            <td>{{ $vehicle_record->date_of_install }}</td>
                                            <td>{{ $vehicle_record->last_pay_date }}</td>
                                            <td>{{ $vehicle_record->last_pay_amount }}</td>
                                            <td>{{ $vehicle_record->renewal_date }}</td>
                                            <td>{{ $vehicle_record->renewal_amount }}</td>
                                            <td>{{ $vehicle_record->duration }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('vehicle-record.edit', $vehicle_record->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit Record">
                                                        <i class="mdi mdi-lead-pencil"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection