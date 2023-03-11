@extends('shopify-app::layouts.default')

@section('content') 

    <section class="full-width">
    </section>

    <section class="full-width">
        <article>
            <div class="columns eight">
                <a class="button secondary" href="{{ custom_route('guide.index') }}"><i class="icon-question append-spacing"></i><span>User Guide</span></a>
                <a class="button secondary" href="{{route('billing.index',['shop' => Auth::user()->name, 'host' => app('request')->input('host')])}}">
                    <i class="icon-addition append-spacing"></i>
                    <span>Change Plan</span>
                </a>
                <a class="link" target="_blank" style="padding-right: 10px;" href="https://support.extendons.com/" >Get Support</a>
            </div>
            <div class="columns four align-right">
                <a class="button add-login-rule" href="">Add Rule</a>
                
            </div>
        </article>
        <br>
    </section>

    <section class="full-width" style = "padding: 0 2rem;">
        <article>
            <div id="success_message" class="column twelve" style="display:none"></div>
        </article>
    </section>

    <section class="full-width">
    <article>
        <div class="column twelve">
            <div class="columns has-sections card">
            <ul class="tabs">

                <li class="active column four active">
                    <a href="#after_registration" class="registration-page">
                        <i class="icon-customers append-spacing tab-icon-spacing"></i><span class = "tabs-title" data-name="registration">After Registration</span></a>
                </li>

                @can('isStandard')
                <li class="column four">
                    <a href="#after_login" class="login-page">
                        <i class="icon-globe append-spacing tab-icon-spacing"></i><span class = "tabs-title" data-name="login">After Login</span></a>
                </li>
                
                <li class="column three">
                    <a href="#after_log_out" class="logout-page"> 
                        <i class="icon-undo append-spacing tab-icon-spacing"></i><span class = "tabs-title" data-name="logout">After Logout</span></a>
                </li>
                @endcan

                @can('isStandardAnnual')
                <li class="column four">
                    <a href="#after_login" class="login-page">
                        <i class="icon-globe append-spacing tab-icon-spacing"></i><span class = "tabs-title" data-name="login">After Login</span></a>
                </li>
                
                <li class="column three">
                    <a href="#after_log_out" class="logout-page"> 
                        <i class="icon-undo append-spacing tab-icon-spacing"></i><span class = "tabs-title" data-name="logout">After Logout</span></a>
                </li>
                @endcan
             
            </ul> 
            @include('form.ruleModal')
            @include('form.ruleDeleteModal')
            @include('form.ruleEditModal')
            <div class="tab-folder">
                <div class="card-section tab-content " id="after_registration" style="display: block">
                    @include('form.registration_rule')
                </div>
                <div class="card-section tab-content" id="after_login" >
                    @include('form.login_rule')
                </div>
            <div class="card-section tab-content" id="after_log_out">
                @include('form.logout_rule')
                </div>
            </div>

            </div>
        </div>
    </article>
    </section>

@endsection