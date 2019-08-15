@push('scripts')
    <script src="{{ asset('js/file-upload.js') }}"></script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Settings</h4>
                        <div class="row">
                            <div class="col-4">
                                <ul class="nav nav-tabs nav-tabs-vertical" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab-vertical" data-toggle="tab" href="#home-2" role="tab" aria-controls="home-2" aria-selected="true">
                                            General Settings
                                            <i class="mdi mdi-settings text-danger ml-2"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab-vertical" data-toggle="tab" href="#profile-2" role="tab" aria-controls="profile-2" aria-selected="false">
                                            Mail Settings
                                            <i class="mdi mdi-email-outline text-success ml-2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-8">
                                <div class="tab-content tab-content-vertical">
                                    <div class="tab-pane fade show active" id="home-2" role="tabpanel" aria-labelledby="home-tab-vertical">
                                        <form class="cmxform" method="POST" action="{{ route('setting.store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <fieldset>
                                                <div class="form-group{{ $errors->has('site_name') ? ' has-danger' : '' }}">
                                                    <label for="name">Website Name</label>
                                                    <input id="name" class="form-control{{ $errors->has('site_name') ? ' form-control-danger' : '' }}" name="site_name" value="{{ $setting != null ? $setting->site_name : '' }}" type="text" required>
                                                    @if ($errors->has('site_name'))
                                                        <label class="error mt-2 text-danger">{{ $errors->first('site_name') }}</label>
                                                    @endif
                                                </div>

                                                <div class="form-group{{ $errors->has('site_logo') ? ' has-danger' : '' }}">
                                                    <label>Logo</label>
                                                    <input type="file" name="site_logo" class="file-upload-default">
                                                    <div class="input-group col-xs-12">
                                                        <input type="text" class="form-control file-upload-info{{ $errors->has('site_name') ? ' form-control-danger' : '' }}" disabled="" placeholder="Upload Image">
                                                        <span class="input-group-append">
                                                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                        </span>
                                                    </div>
                                                    @if ($errors->has('site_logo'))
                                                        <label class="error mt-2 text-danger">{{ $errors->first('site_logo') }}</label>
                                                    @endif
                                                    @if($setting->site_logo !== null)
                                                        <img src="{{ asset($setting->site_logo) }}" class="img-thumbnail mt-2">
                                                    @endif
                                                </div>

                                                <div class="form-group{{ $errors->has('site_fav') ? ' has-danger' : '' }}">
                                                    <label>Favicon</label>
                                                    <input type="file" name="site_fav" class="file-upload-default">
                                                    <div class="input-group col-xs-12">
                                                        <input type="text" class="form-control file-upload-info{{ $errors->has('site_name') ? ' form-control-danger' : '' }}" disabled="" placeholder="Upload Image">
                                                        <span class="input-group-append">
                                                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                        </span>
                                                    </div>
                                                    @if ($errors->has('site_fav'))
                                                        <label class="error mt-2 text-danger">{{ $errors->first('site_fav') }}</label>
                                                    @endif
                                                    @if($setting->site_fav !== null)
                                                        <img src="{{ asset($setting->site_fav) }}" class="img-thumbnail mt-2">
                                                    @endif
                                                </div>
                                                
                                                <input class="btn btn-primary" type="submit" value="Save">
                                            </fieldset>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-vertical">
                                        <form class="cmxform" method="POST" action="{{ route('setting.store') }}">
                                            @csrf
                                            <fieldset>
                                                <div class="form-group{{ $errors->has('mail_driver') ? ' has-danger' : '' }}">
                                                    <label for="name">Mail Driver</label>
                                                    <input id="name" class="form-control{{ $errors->has('mail_driver') ? ' form-control-danger' : '' }}" name="mail_driver" value="{{ $setting != null ? $setting->mail_driver : '' }}" type="text" required>
                                                    @if ($errors->has('mail_driver'))
                                                        <label class="error mt-2 text-danger">{{ $errors->first('mail_driver') }}</label>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('mail_host') ? ' has-danger' : '' }}">
                                                    <label for="name">Mail Host</label>
                                                    <input id="name" class="form-control{{ $errors->has('mail_host') ? ' form-control-danger' : '' }}" name="mail_host" value="{{ $setting != null ? $setting->mail_host : '' }}" type="text" required>
                                                    @if ($errors->has('mail_host'))
                                                        <label class="error mt-2 text-danger">{{ $errors->first('mail_host') }}</label>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('mail_port') ? ' has-danger' : '' }}">
                                                    <label for="name">Mail Port</label>
                                                    <input id="name" class="form-control{{ $errors->has('mail_port') ? ' form-control-danger' : '' }}" name="mail_port" value="{{ $setting != null ? $setting->mail_port : '' }}" type="text" required>
                                                    @if ($errors->has('mail_port'))
                                                        <label class="error mt-2 text-danger">{{ $errors->first('mail_port') }}</label>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('mail_username') ? ' has-danger' : '' }}">
                                                    <label for="name">Mail Username</label>
                                                    <input id="name" class="form-control{{ $errors->has('mail_username') ? ' form-control-danger' : '' }}" name="mail_username" value="{{ $setting != null ? $setting->mail_username : '' }}" type="text" required>
                                                    @if ($errors->has('mail_username'))
                                                        <label class="error mt-2 text-danger">{{ $errors->first('mail_username') }}</label>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('mail_password') ? ' has-danger' : '' }}">
                                                    <label for="name">Mail Password</label>
                                                    <input id="name" class="form-control{{ $errors->has('mail_password') ? ' form-control-danger' : '' }}" name="mail_password" value="{{ $setting != null ? $setting->mail_password : '' }}" type="password" required>
                                                    @if ($errors->has('mail_password'))
                                                        <label class="error mt-2 text-danger">{{ $errors->first('mail_password') }}</label>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('mail_from') ? ' has-danger' : '' }}">
                                                    <label for="name">Mail From</label>
                                                    <input id="name" class="form-control{{ $errors->has('mail_from') ? ' form-control-danger' : '' }}" name="mail_from" value="{{ $setting != null ? $setting->mail_from : '' }}" type="text" required>
                                                    @if ($errors->has('mail_from'))
                                                        <label class="error mt-2 text-danger">{{ $errors->first('mail_from') }}</label>
                                                    @endif
                                                </div>
                                                <input class="btn btn-primary" type="submit" value="Save">
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @includeIf('snippets.success', ['success' => session('success')])
    </div>
@endsection