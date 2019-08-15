@if(isset($success))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-fill-success" role="alert">
                <i class="mdi mdi-checkbox-multiple-marked-circle"></i>
                {{ $success }}
            </div>
        </div>
    </div>
@endif