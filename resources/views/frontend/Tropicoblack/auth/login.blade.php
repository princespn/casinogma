@extends('frontend.Tropicoblack.layouts.auth')

@section('page-title', trans('app.login'))

@section('content')


    <div id="login-container" class=" h-100">
        <div class="w-100 border-0" id="login-card">
            <div class="login_logo">
                <img src="/frontend/Tropicoblack/img/auth/logo.png" alt="" data-xblocker="passed"
                    style="visibility: visible;height:100%">
            </div>
            <div class="login-card-body p-3">
                <form id="login-form" action="<?= route('frontend.auth.login.post') ?>" method="post">
                    @csrf
                    <input id="login-form-username" value="" type="text" name="username" />
                    <input id="login-form-password" type="password" name="password" />
                    <img class="login__check" src="/frontend/Tropicoblack/img/auth/check.png" alt=""
                        style="transition: all 0.5s ease 0s; opacity: 0;">
                    <img class="login__login game-button" src="/frontend/Tropicoblack/img/auth/log_btn.png" alt="">
                    <img class="login__back" src="/frontend/Tropicoblack/img/auth/login.png" alt=""
                        data-xblocker="passed" style="visibility: visible;">
                    {{-- <div class="custom-input-group mb-2">
                        <span class="custom-input-group-icon"><i class="fas fa-user"></i></span>

                    </div>
                    <div class="custom-input-group mb-2">
                        <span class="custom-input-group-icon"><i class="fas fa-key"></i></span>
                    </div>
                    <button type="submit" form="login-form" value="@lang('app.log_in')" class="btn primary-btn w-100 mt-4">
                        Log In
                    </button> --}}
                </form>
            </div>
        </div>
    </div>
    <div class="preloader-game">
        <img class="preloader-game-logo" src="/frontend/Tropicoblack/img/auth/logo.png" />
        <div class="preloader-game-bar-cont">
            <img class="preloader-game-bar" src="/frontend/Tropicoblack/img/preloader/ic_dragon.png" />
            <img class="preloader-game-bar-back" src="/frontend/Tropicoblack/img/preloader/bg.png" />
        </div>
        <span class="preloader-game-text">
            LOADING...
        </span>
    </div>
    <video autoplay loop muted class="bgvideo" id="bgvideo">
        <source src="/frontend/Tropicoblack/img/auth/back.mp4" type="video/mp4">
    </video>
    {{-- Preloader --}}


@stop

@section('scripts')
    {!! JsValidator::formRequest('VanguardLTE\Http\Requests\Auth\LoginRequest', '#login-form') !!}
@stop
