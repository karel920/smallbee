@extends('layouts.master')

@section('head')
<script src="{{ asset('js/resource.js') }}"></script>
@endsection

@section('content')
<div>
    <div class="sidebar">
        <div class="sidebar-inner">
            <!-- ### $Sidebar Header ### -->
            <div class="sidebar-logo">
                <div class="peers ai-c fxw-nw">
                    <div class="peer peer-greed">
                        <a class="sidebar-link td-n" href="index.html">
                            <div class="peers ai-c fxw-nw">
                                <div class="peer">
                                    <div class="logo">
                                        <img src="assets/static/images/logo.png" alt="">
                                    </div>
                                </div>
                                <div class="peer peer-greed">
                                    <h5 class="lh-1 mB-0 logo-text">Adminator</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="peer">
                        <div class="mobile-toggle sidebar-toggle">
                            <a href="" class="td-n">
                                <i class="ti-arrow-circle-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ### $Sidebar Menu ### -->
            <ul class="sidebar-menu scrollable pos-r">
                <!-- <li class="nav-item mT-30 actived">
                    <a class="sidebar-link" href="{{ url('/admin') }}">
                        <span class="icon-holder">
                            <i class="c-blue-500 ti-home"></i>
                        </span>
                        <span class="title">{{ Lang::get('localizedStr.side_dashboard') }}</span>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class='sidebar-link' href="{{ url('/users') }}">
                        <span class="icon-holder">
                            <i class="c-brown-500 ti-user"></i>
                        </span>
                        <span class="title">{{ Lang::get('localizedStr.side_users') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class='sidebar-link' href="{{ url('/devices') }}">
                        <span class="icon-holder">
                            <i class="c-blue-500 ti-mobile"></i>
                        </span>
                        <span class="title">{{ Lang::get('localizedStr.side_devices') }}</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class='sidebar-link' href="{{ url('/devicetypes') }}">
                        <span class="icon-holder">
                            <i class="c-blue-500 ti-file"></i>
                        </span>
                        <span class="title">{{ Lang::get('localizedStr.side_resources') }}</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class='sidebar-link' href="{{ url('/apps') }}">
                        <span class="icon-holder">
                            <i class="c-blue-500 ti-android"></i>
                        </span>
                        <span class="title">{{ Lang::get('localizedStr.side_apps') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class='sidebar-link' href="{{ url('/me/apps') }}">
                        <span class="icon-holder">
                            <i class="c-blue-500 ti-import"></i>
                        </span>
                        <span class="title">{{ Lang::get('localizedStr.side_my_app') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class='sidebar-link' href="{{ url('/news') }}">
                        <span class="icon-holder">
                            <i class="c-deep-orange-500 ti-bell"></i>
                        </span>
                        <span class="title">{{ Lang::get('localizedStr.side_news') }}</span>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>

    <div class="page-container">
        <div class="header navbar">
            <div class="header-container">
                <ul class="nav-left">
                    <li>
                        <a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
                            <i class="ti-menu"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav-right">
                    <li>
                        @if( App::getLocale() == 'zh' )
                        <a href="{{ route('changeLanguage', 'en') }}" id='lang_toggle' class="sidebar-toggle">
                            <img class="w-2r bdrs-50p" src="{{ asset('images/uk_us.svg') }}" alt="">
                        </a>
                        @else
                        <a href="{{ route('changeLanguage', 'zh') }}" id='lang_toggle' class="sidebar-toggle">
                            <img class="w-2r bdrs-50p" src="{{ asset('images/zh_cn.svg') }}" alt="">
                        </a>
                        @endif

                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                            <div class="peer mR-10">
                                <img class="w-2r bdrs-50p" src="https://randomuser.me/api/portraits/men/10.jpg" alt="">
                            </div>
                            <div class="peer">
                                <span class="fsz-sm c-grey-900">{{ Auth::user()->name }}</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu fsz-sm">
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                                    <i class="ti-power-off mR-10"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <main class='main-content bgc-grey-100'>
            <div id='mainContent'>
                <div class="container-fluid">
                    <h4 class="c-grey-900 mT-10 mB-30">{{ Lang::get('localizedStr.title_resource_manage') }}</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                <form style="display: flex">
                                    <h4 class="c-grey-900 mB-20" style="flex: 1 1 auto;">{{ Lang::get('localizedStr.resource_list') }}</h4>
                                    <button class="btn btn-danger" type="button" style="margin-bottom: 20px !important; margin-right: 20px;" id="btn_mile_resource">{{ Lang::get('localizedStr.resource_mile') }}</button>
                                    <button class="btn btn-danger" type="button" style="margin-bottom: 20px !important; margin-right: 20px;" id="btn_chang_resource">{{ Lang::get('localizedStr.resource_changbao') }}</button>                        
                                    <button class="btn btn-danger" type="button" style="margin-bottom: 20px !important;" id="btn_new_resource">{{ Lang::get('localizedStr.resource_new') }}</button>
                                </form>
                                <table id="dataTable" class="table table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>{{ Lang::get('localizedStr.device_type') }}</th>
                                            <th>{{ Lang::get('localizedStr.resource_app_name') }}</th>
                                            <th>{{ Lang::get('localizedStr.resource_update_date') }}</th>
                                            <th>{{ Lang::get('localizedStr.user_action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($resources as $i=>$resource)
                                        <tr>
                                            <td>{{ $resource['app_id'] }}</td>
                                            <td>{{ $resource['type'] }}</td>
                                            <td>{{ $resource['name'] }}</td>
                                            <td>{{ $resource['updated_at']}}</td>
                                            <td>
                                                <div class="peers mR-15">
                                                    <div class="peer">
                                                        <span id="upload_file" class="td-n c-deep-purple-500 cH-blue-500 fsz-md p-5" data-resId="{{ $resource['id'] }}">
                                                            <i class="ti-upload"></i>
                                                        </span>
                                                    </div>
                                                    <div class="peer">
                                                        <span id="download_file" class="td-n c-deep-red-500 cH-red-500 fsz-md p-5" data-resId="{{ $resource['id'] }}">
                                                            <i class="ti-download"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="new_resource">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="bd p-15">
                            <h5 class="m-0">{{ Lang::get('localizedStr.resource_new') }}</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('uploadResource') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group" style="visibility: hidden; max-height: 0px;">
                                    <label class="fw-500" for="type_id">Id</label>
                                    <input type="text" class="form-control" id="type_id" name="type_id" value="{{ $typeId }}">
                                </div>
                                <div class="form-group">
                                    <label for="app_list">{{ Lang::get('localizedStr.resource_choose_app') }}</label>
                                    <select id="app_list" name="app_list" class="form-control">
                                        <option value="0" selected>{{ Lang::get('localizedStr.choose_option') }}</option>
                                        @foreach($appsHasRes as $i=>$app)
                                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="file">{{ Lang::get('localizedStr.resource_choose_file') }}</label>
                                    <input type="file" class="form-control" style="border: 1px solid #00000000; padding: 0.375rem 0" id="file" name="file" />
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary cur-p" id="btn_add" type="submit">{{ Lang::get('localizedStr.resource_upload') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="changbao_resource">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="bd p-15">
                            <h5 class="m-0">{{ Lang::get('localizedStr.resource_changbao') }}</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('uploadChangbao') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group" style="visibility: hidden; max-height: 0px;">
                                    <label class="fw-500" for="type_id">Id</label>
                                    <input type="text" class="form-control" id="type_id" name="type_id" value="{{ $typeId }}">
                                </div>
                                <div class="form-group">
                                    <label for="app_list">{{ Lang::get('localizedStr.resource_choose_app') }}</label>
                                    <select id="app_list" name="app_list" class="form-control">
                                        <option value="0" selected>{{ Lang::get('localizedStr.choose_option') }}</option>
                                        @foreach($apps as $i=>$app)
                                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="file">{{ Lang::get('localizedStr.resource_choose_file') }}</label>
                                    <input type="file" class="form-control" style="border: 1px solid #00000000; padding: 0.375rem 0" id="file" name="file" />
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary cur-p" id="btn_add" type="submit">{{ Lang::get('localizedStr.resource_upload') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="mile_resource">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="bd p-15">
                            <h5 class="m-0">{{ Lang::get('localizedStr.resource_new') }}</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('uploadResMile') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group" style="visibility: hidden; max-height: 0px;">
                                    <label class="fw-500" for="type_id">Id</label>
                                    <input type="text" class="form-control" id="type_id" name="type_id" value="{{ $typeId }}">
                                </div>
                                <div class="form-group">
                                    <label for="file_name">{{ Lang::get('localizedStr.resource_name') }}</label>
                                    <input type="text" class="form-control" id="file_name" name="file_name">
                                </div>

                                <div class="form-group">
                                    <label for="file">{{ Lang::get('localizedStr.resource_choose_file') }}</label>
                                    <input type="file" class="form-control" style="border: 1px solid #00000000; padding: 0.375rem 0" id="file" name="file" />
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary cur-p" id="btn_add" type="submit">{{ Lang::get('localizedStr.resource_upload') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="update_resource">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="bd p-15">
                            <h5 class="m-0">{{ Lang::get('localizedStr.resource_update') }}</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('updateResource') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group" style="visibility: hidden; max-height: 0px;">
                                    <label for="resource_id">{{ Lang::get('localizedStr.resource_choose_file') }}</label>
                                    <input type="text" class="form-control" id="resource_id" name="resource_id">
                                </div>

                                <div class="form-group">
                                    <label for="file">{{ Lang::get('localizedStr.resource_choose_file') }}</label>
                                    <input type="file" class="form-control" style="border: 1px solid #00000000; padding: 0.375rem 0" id="file" name="file" />
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary cur-p" id="btn_add" type="submit">{{ Lang::get('localizedStr.resource_update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection