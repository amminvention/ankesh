@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Sale Type</h4>
                        <form class="cmxform" method="POST" action="{{ route('sale-type.update', $sale_type->id) }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label for="name">Type (required)</label>
                                    <input id="name" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" name="name" value="{{ $sale_type->name }}" type="text" required>
                                    @if ($errors->has('name'))
                                        <label class="error mt-2 text-danger">{{ $errors->first('name') }}</label>
                                    @endif
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