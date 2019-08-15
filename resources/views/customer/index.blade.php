@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
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
                        { extend: 'excelHtml5', className: 'btn btn-primary', title: 'Customers', text: 'Export to Excel', exportOptions: {
                                columns: "thead th:not(.noExport)"
                            }},
                        { extend: 'pdfHtml5', className: 'btn btn-primary', title: 'Customers', text: 'Export to PDF', exportOptions: {
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
        function deleteData(id)
        {
            var id = id;
            var url = '{{ route("customer.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">Customers</h4>
                    </div>
                    @can('customer-create')
                    <div class="col-lg-6">
                        <a href="{{ route('customer.create') }}" class="btn btn-primary float-right">Add customer</a>
                    </div>
                    @endcan
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="vehicle-record" class="table dt-responsive nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Customer Whatsapp</th>
                                    <th>Customer Phone</th>
                                    <th data-priority="1" class="noExport">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($customers->count() > 0)
                                        @foreach($customers as $customer)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->whatsapp }}</td>
                                                <td>{{ $customer->phone }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        @can('customer-edit')
                                                        <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit Record">
                                                            <i class="mdi mdi-lead-pencil"></i>
                                                        </a>
                                                        @endcan
                                                        @can('customer-delete')
                                                        <span data-toggle="modal" onclick="deleteData({{$customer->id}})" data-target="#DeleteModal">
                                                            <button class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete Record">
                                                                <i class="mdi mdi-delete-variant"></i>
                                                            </button>
                                                        </span>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @include('snippets.delete-confirm')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection