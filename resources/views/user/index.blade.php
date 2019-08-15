@push('styles')
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/tooltips.js') }}"></script>
    <script>
        (function($) {
            'use strict';
            $(function() {
                $('#sale-type').DataTable({
                    "aLengthMenu": [
                        [5, 10, 15, -1],
                        [5, 10, 15, "All"]
                    ],
                    "iDisplayLength": 10,
                    "language": {
                        search: ""
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
            var url = '{{ route("user.destroy", ":id") }}';
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
                        <h4 class="card-title">Users</h4>
                    </div>
                    @can('user-create')
                    <div class="col-lg-6">
                        <a href="{{ route('user.create') }}" class="btn btn-primary float-right">Add User</a>
                    </div>
                    @endcan
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="sale-type" class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($users->count() > 0)
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if($user->status == 1)
                                                        <label class="badge badge-info">Active</label>
                                                    @else
                                                        <label class="badge badge-warning">Inactive</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($user->getRoleNames()))
                                                        @foreach($user->getRoleNames() as $role)
                                                            <label class="badge badge-success">{{ $role }}</label>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        @can('user-edit')
                                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit Record">
                                                            <i class="mdi mdi-lead-pencil"></i>
                                                        </a>
                                                        @endcan
                                                        @can('user-delete')
                                                        <span data-toggle="modal" onclick="deleteData({{$user->id}})" data-target="#DeleteModal">
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