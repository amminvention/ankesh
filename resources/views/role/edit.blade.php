@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Role</h4>
                        <form class="cmxform" method="POST" action="{{ route('role-permission.update', $role->id) }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label for="name">Role Name</label>
                                    <input id="name" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" name="name" value="{{ $role->name }}" type="text" required>
                                    @if ($errors->has('name'))
                                        <label class="error mt-2 text-danger">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                                <h4 class="card-title">Permissions</h4>
                                <div class="form-group">
                                    @foreach($permissions as $id => $name)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="permission[]" value="{{ $id }}" {{ in_array($id, $rolePermissions) ? 'checked':'' }}>
                                                {{ ucwords($name) }}
                                            </label>
                                        </div>
                                    @endforeach
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