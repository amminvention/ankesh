@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    <style>
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 7px;
            right: -22px;
            width: 20px;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/tooltips.js') }}"></script>
    <script>
        $(".js-example-basic-single").select2();
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
                        { extend: 'excelHtml5', className: 'btn btn-primary', title: 'Pending Payment Report', text: 'Export to Excel'},
                        { extend: 'pdfHtml5', className: 'btn btn-primary', title: 'Pending Payment Report', text: 'Export to PDF'},
                    ],
                    "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;

                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };

                        // Total over all pages
                        var total = api
                            .column( 3 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        // Total over this page
                        var pageTotal = api
                            .column( 3, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        // Update footer
                        $( api.column( 3 ).footer() ).html(
                            ''+pageTotal +' ( '+ total +' total)'
                        );
                    }
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
        function deleteData(id)
        {
            var id = id;
            var url = '{{ route("vehicle-record.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
        $('.datepicker-popup').datepicker({
            todayHighlight: true,
            format: 'dd/mm/yyyy',
        });
    </script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">Received Payments Customerwise</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <form class="form-inline" method="GET" action="{{ route('received.report') }}">
                            <label class="sr-only" for="pending-payment">Payment</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" name="last_pay_amount" id="pending-payment" placeholder="Pending Payment">
                            <label class="sr-only" for="date">Date</label>
                            <div class="input-group mb-2 mr-sm-2 date datepicker datepicker-popup">
                                <input type="text" class="form-control" id="date" placeholder="Date" name="last_pay_date" readonly>
                                <span class="input-group-addon input-group-append border-left">
                                  <span class="mdi mdi-calendar input-group-text"></span>
                                </span>
                            </div>
                            <label class="sr-only" for="customer-name">Customer</label>
                            <div class="form-group mb-2 mr-sm-2">
                                <select id="customer_id" name="customer_id" class="form-control js-example-basic-single w-100">
                                    @foreach($customers as $id => $name)
                                        <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $id.") " . " " . $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span style="padding-left: 30px;"></span>
                            <button type="submit" class="btn btn-primary mb-2"><i class="mdi mdi-filter-outline"></i> Filter</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="vehicle-record" class="table dt-responsive nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vehicle No.</th>
                                    <th>Customer Name</th>
                                    <th>Payment</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($vehicle_records->count() > 0)
                                    @foreach($vehicle_records as $vehicle_record)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $vehicle_record->vehicle_no }}</td>
                                            <td>{{ $vehicle_record->customers == null ? '' : $vehicle_record->customers->name }}</td>
                                            <td>{{ $vehicle_record->last_pay_amount }}</td>
                                            <td>{{ $vehicle_record->last_pay_date }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="3" style="text-align:right">Total :</th>
                                    <th colspan="2"></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection