@if(isset($error))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-fill-warning" role="alert">
                <i class="mdi mdi-checkbox-multiple-marked-circle"></i>
                {{ $error }}
            </div>
        </div>
    </div>
@endif