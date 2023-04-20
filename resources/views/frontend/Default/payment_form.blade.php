@extends('frontend.Default.layouts.app')
@section('page-title', 'Payment form')
@section('add-main-class', 'main-redirect')
@section('add-header-class', 'main-redirect')
@php
    $currency = auth()->user()->present()->shop ? auth()->user()->present()->shop->currency : '';
@endphp



@section('content')

    @include('frontend.Default.partials.header_logged')
	<div class="modal" id="payment-form" style="display: block;">
        <header class="modal__header">
            <div class="span modal__title"><span>BTC Payment</span><span><img src="/frontend/Default/img/btcpay.png" style=" margin-left: 10px;"></span> </div>

            <span ng-click="closeModal($event)" class="modal__icon icon icon_cancel js-close-popup"></span>
        </header>
		<div class="modal__body">
            <div class="modal__content">
				<div class="redirect">
					<h3 class="redirect__title">
						Thank you for the payment! 
						<span class="redirect__time">Please click OK to continue!</span>

					</h>

					@if( is_array($data) )
					<form action="{{ $data['action'] }}" method="{{ $data['method'] }}" id="payment_form" >
						@foreach($data['fields'] AS $field=>$value)
							<input type="hidden" name="{{ $field }}" value="{{ $value }}">
						@endforeach
						<button type="submit" class="btn btn--redirect button button-neutral" >OK</button>
					</form>
					@else
						{!! $data !!}
					@endif
				</div>
				<div class="modal__error" style="display: none"></div>
            </div>
            <div class="modal-preloader" style="display:none"></div>
        </div>
	</div>

@endsection

@section('footer')
	@include('frontend.Default.partials.footer')
@endsection

@section('scripts')
	@include('frontend.Default.partials.scripts')
@endsection
