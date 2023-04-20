@extends('backend.layouts.app')

@section('page-title', trans('app.statistics'))
@section('page-heading', trans('app.statistics'))

@section('content')

	<section class="content-header">
		@include('backend.partials.messages')
	</section>

	<section class="content">
<style>
.columns-parent {

    
}

.my-column {
height:80px;
}
.my-column2 {
font-size: 12px;    
height:70%;
}
.my-column3 {
    font-size: 12px;
height:30%;
}
.my-column-datum-top {
font-size: 12px;
height:30%;
}
.my-column-datum-bottom {
font-size: 10px;
height:70%;
}
</style>



   
       <!--Grid distributor start-->
                                  
   @if(auth()->user()->hasRole(['admin', 'agent', 'distributor', 'cashier' ]))
      
   @php
   
   
   $abfragen = request();
   
   $monyin=0;
   $monyout=0;
   $creditin=0;
   $creditout=0;
   $distributorin=0;
   $distributorout=0;
   
   $distributorinshop=0;
   $distributoroutshop=0;
   
   $datum=$abfragen->input('dates');
   //$datum=$datum->format(config('app.date_time_format'));
   $username=$abfragen->input('user');
   $userrol=1;
   $shopid=auth()->user()->shop_id;
   $userid='';
   $datumstring='Gesamtzeitraum';
   $datumvon='';
   $datumbis='';
   $distributouserid=auth()->user()->id;
   $totoalx=0;
   $shopguthaben=0;
   $shopguthaben=DB::table('shops')->where(['id' => $shopid])->value('balance');

   
   
   
   $aufstellerabfrage=1;
   
   $query = DB::table('statistics_add')->where(['shop_id' => $shopid]); 
   
   $query2 = DB::table('statistics_add')->where(['shop_id' => 0, 'user_id'=>$distributouserid]); 
   
   if(!empty($username)){
   $userid=DB::table('users')->where(['username' => $username])->value('id');
   $query =$query->where(['user_id'=>$userid]);
    $aufstellerabfrage=0;
   }
   
   
   if(!empty($datum)){
   $datumvon=substr($datum,0,16).':00';
   $datumbis=substr($datum, -16).':00';
   $datumstring="Von: ".$datumvon."<br>Bis: ".$datumbis;
   
   
   $query = $query->whereBetween('created_at', [$datumvon, $datumbis]);
                  
                  
                   
   $query2 = $query2->whereBetween('created_at', [$datumvon, $datumbis]);
                  
   }
   
   
   
   $statisticstab =$query->get();
   
   foreach ($statisticstab as $einzelzeile) {
   
   
   
   
   if($einzelzeile->money_in != NULL ){
   $monyin=$monyin+ $einzelzeile->money_in;
   }
   
   if($einzelzeile->credit_out != NULL){
      $creditout=$creditout+ $einzelzeile->credit_out;
      }
   
   if($einzelzeile->money_out != NULL ){
   $monyout=$monyout+ $einzelzeile->money_out;
   }
   
   if($einzelzeile->credit_in != NULL){
      $creditin=$creditin+ $einzelzeile->credit_in;
   }
   
   if($einzelzeile->distributor_in != NULL){
   $distributorinshop=$distributorinshop+ $einzelzeile->distributor_in;
   }
   
   
   if($einzelzeile->distributor_out != NULL){
   $distributoroutshop=$distributoroutshop+ $einzelzeile->distributor_out;
   }
   
   }
   
   
if($aufstellerabfrage==1){   
   $distributorquery=$query2->get();
   foreach ($distributorquery as $einzelzeile) {
   
   if($einzelzeile->distributor_in != NULL){
   $distributorin=$distributorin+$einzelzeile->distributor_in;
   }
   
   
   if($einzelzeile->distributor_out != NULL){
   $distributorout=$distributorout+$einzelzeile->distributor_out;
   }
   
   
   }
}
     $totoalx=$monyin-$monyout;
   
    @endphp 

    
   @endif
       

       @if(auth()->user()->hasRole(['admin', 'agent', 'distributor', 'cashier']))
<div class="heye ">
    <div class="kutu">
<p class="h4 "><strong>Shop Balance:  {{number_format($shopguthaben,2)}} </strong> </p>
</div>
<style>.kutu{
            
            font-size: 30px;
            margin-right: -15px;
            margin-left: -15px;
             color:red;
            text-align: center;
           
        }


    </style>
    
<div class="container">
    <div class="row">
         <div class="col-6 col-md-3 text-center align-self-center border my-column">
            <div class="row my-column2 align-items-center">
                <div  class="h4"><strong> TOP UP Balance </strong><br>(Paid to Store)</div>
            </div>      
            <div class="row my-column3 align-items-center">
                 <div class="col text-red"><strong><font size="5">{{number_format($totoalx,2)}}</font></strong></div>
            </div>
        </div>
        
        <div class="col-6 col-md-3 text-center align-self-center border my-column">
            
            <div class="row my-column2 align-items-center">
               <div  class="h4"><strong>MONEY IN</strong><br>(Received from Player)</div>
             </div>  
            <div class="row my-column3 align-items-center">
                 <div class="col text-success"><strong><font size="4">{{number_format($monyin,2)}}</font></strong></div>
            </div>
            
        </div>
        
        
        <div class="col-6 col-md-3 text-center align-self-center border my-column">
            <div class="row my-column2 align-items-center">
                <div  class="h4"><strong>MONEY OUT</strong><br>(Paid to Player)</div>
            </div>      
            <div class="row my-column3 align-items-center">
                 <div class="col text-danger"><strong><font size="4">{{number_format($monyout,2)}}</strong></div>
            </div>
        </div>
        
        
        
         <div class="col-6 col-md-3 text-center align-self-center border my-column">
             <div class="row my-column2 align-items-center">
                <div  class="h4"><strong>TOTAL</strong><br>(Shop Profits)</div>
             </div>
             <div class="row my-column3 align-items-center">
                <div class="col text-primary"><strong><font size="4">{{number_format($totoalx,2)}}</strong></div>
             </div>
        </div>
        
        
        
        
    </div>
</div>


</div>

@endif
<br>
<!--Grid distributor End-->  
		<form action="" method="GET">
			<div class="box box-danger collapsed-box shift_stat_show">
				<div class="box-header with-border">
					<h3 class="box-title">@lang('app.filter')</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>@lang('app.user')</label>
								<input type="text" class="form-control" name="user" value="{{ Request::get('user') }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>@lang('app.type_in_out')</label>
								{!! Form::select('type_in_out', [0 => __('app.no'), 1 => __('app.yes')], Request::get('type_in_out'), ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="col-md-3">

							<div class="form-group">
								<label> @lang('app.date_start')</label>
								<div class="input-group">
									<button type="button" class="btn btn-default pull-right" id="daterange-btn">
									<span><i class="fa fa-calendar"></i> {{ Request::get('dates_view') ?: __('app.date_start_picker') }}</span>
										<i class="fa fa-caret-down"></i>
									</button>
								</div>
								<input type="hidden" id="dates_view" name="dates_view" value="{{ Request::get('dates_view') }}">
								<input type="hidden" id="dates" name="dates" value="{{ Request::get('dates') }}">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>@lang('app.type')</label>
								{!! Form::select('system', $systems, Request::get('system'), ['id' => 'system', 'class' => 'form-control']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>@lang('app.role')</label>
								{!! Form::select('role', ['' => '---'] + $roles, Request::get('role'), ['id' => 'role', 'class' => 'form-control']) !!}
							</div>
						</div>
						@if(auth()->user()->hasRole(['admin', 'agent', 'distributor']))
						<div class="col-md-3">
							<div class="form-group">
								<label>@lang('app.credit_in') @lang('app.from')</label>
								<input type="text" class="form-control" name="credit_in_from" value="{{ Request::get('credit_in_from') }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>@lang('app.credit_in') @lang('app.to')</label>
								<input type="text" class="form-control" name="credit_in_to" value="{{ Request::get('credit_in_to') }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>@lang('app.credit_out') @lang('app.from')</label>
								<input type="text" class="form-control" name="credit_out_from" value="{{ Request::get('credit_out_from') }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>@lang('app.credit_out') @lang('app.to')</label>
								<input type="text" class="form-control" name="credit_out_to" value="{{ Request::get('credit_out_to') }}">
							</div>
						</div>
						@endif
						<div class="col-md-3">
							<div class="form-group">
								<label>@lang('app.money_in') @lang('app.from')</label>
								<input type="text" class="form-control" name="money_in_from" value="{{ Request::get('money_in_from') }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>@lang('app.money_in') @lang('app.to')</label>
								<input type="text" class="form-control" name="money_in_to" value="{{ Request::get('money_in_to') }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>@lang('app.money_out') @lang('app.from')</label>
								<input type="text" class="form-control" name="money_out_from" value="{{ Request::get('money_out_from') }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>@lang('app.money_out') @lang('app.to')</label>
								<input type="text" class="form-control" name="money_out_to" value="{{ Request::get('money_out_to') }}">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								@php
									$filter = ['' => '---'];
                                    $shifts = \VanguardLTE\OpenShift::orderBy('start_date', 'DESC')->get();
                                    if( count($shifts) ){
                                        foreach($shifts AS $shift){
                                            $filter[$shift->id] = $shift->id . ' - ' . $shift->start_date;
                                        }
                                    }
								@endphp
								<label>@lang('app.shifts')</label>
								{!! Form::select('shifts', $filter, Request::get('shifts'), ['id' => 'shifts', 'class' => 'form-control']) !!}
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">
						@lang('app.filter')
					</button>
				</div>
			</div>
		</form>

		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">@lang('app.statistics')</h3>
			</div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
					<thead>
					<tr>
						@if(auth()->user()->hasRole(['admin']))
							<th>@lang('app.admin')</th>
						@endif
						@if(auth()->user()->hasRole(['admin', 'agent']))
							<th>@lang('app.agent')</th>
						@endif
						@if(auth()->user()->hasRole(['admin', 'agent', 'distributor']))
							<th>@lang('app.distributor')</th>
						@endif
						@if(auth()->user()->hasRole(['admin', 'agent', 'distributor']))
							<th>@lang('app.shop')</th>
						@endif
						<th>@lang('app.cashier')</th>
						<th>@lang('app.type')</th>
						<th>@lang('app.user')</th>
						@if(auth()->user()->hasRole(['admin', 'agent']))
							<th>@lang('app.agent') @lang('app.in')</th>
							<th>@lang('app.agent') @lang('app.out')</th>
						@endif
						@if(auth()->user()->hasRole(['admin', 'agent', 'distributor']))
							<th>@lang('app.distributor') @lang('app.in')</th>
							<th>@lang('app.distributor') @lang('app.out')</th>
						@endif
						@if(auth()->user()->hasRole(['admin']))
							<th>@lang('app.type') @lang('app.in')</th>
							<th>@lang('app.type') @lang('app.out')</th>
						@endif
						@if(auth()->user()->hasRole(['admin', 'agent', 'distributor']))
							<th>@lang('app.credit') @lang('app.in')</th>
							<th>@lang('app.credit') @lang('app.out')</th>
						@endif
						<th>@lang('app.money') @lang('app.in')</th>
						<th>@lang('app.money') @lang('app.out')</th>
						<th>@lang('app.date')</th>
					</tr>
					</thead>
					<tbody>
					@if (count($transactions))
						@foreach ($transactions as $transaction)
							@include('backend.stat.partials.transaction_stat')
						@endforeach
					@else
						<tr><td colspan="18">@lang('app.no_data')</td></tr>
					@endif
					</tbody>
					<thead>
					<tr>
						@if(auth()->user()->hasRole(['admin']))
							<th>@lang('app.admin')</th>
						@endif
						@if(auth()->user()->hasRole(['admin', 'agent']))
							<th>@lang('app.agent')</th>
						@endif
						@if(auth()->user()->hasRole(['admin', 'agent', 'distributor']))
							<th>@lang('app.distributor')</th>
						@endif
						@if(auth()->user()->hasRole(['admin', 'agent', 'distributor']))
							<th>@lang('app.shop')</th>
						@endif
						<th>@lang('app.cashier')</th>
						<th>@lang('app.type')</th>
						<th>@lang('app.user')</th>
						@if(auth()->user()->hasRole(['admin', 'agent']))
							<th>@lang('app.agent') @lang('app.in')</th>
							<th>@lang('app.agent') @lang('app.out')</th>
						@endif
						@if(auth()->user()->hasRole(['admin', 'agent', 'distributor']))
							<th>@lang('app.distributor') @lang('app.in')</th>
							<th>@lang('app.distributor') @lang('app.out')</th>
						@endif
						@if(auth()->user()->hasRole(['admin']))
							<th>@lang('app.type') @lang('app.in')</th>
							<th>@lang('app.type') @lang('app.out')</th>
						@endif
						@if(auth()->user()->hasRole(['admin', 'agent', 'distributor']))
							<th>@lang('app.credit') @lang('app.in')</th>
							<th>@lang('app.credit') @lang('app.out')</th>
						@endif
						<th>@lang('app.money') @lang('app.in')</th>
						<th>@lang('app.money') @lang('app.out')</th>
						<th>@lang('app.date')</th>
					</tr>
					</thead>
                            </table>
                        </div>


						@php
							$urlParams = '?';
                            foreach(request()->all() AS $key=>$value){
                                if($key != 'page'){
                                    $urlParams .= '&' . $key . '=' . $value;
                                }
                            }
						@endphp

						{!! \VanguardLTE\Lib\Pagination::paging($count, $perPage, $page, route('backend.transactions').$urlParams, '&page', 9) !!}

                    </div>
		</div>
	</section>

@stop

@section('scripts')
	<script>
		$(function() {
			$('#stat-table').dataTable();

			$('.btn-box-tool').click(function(event){
				if( $('.shift_stat_show').hasClass('collapsed-box') ){
					$.cookie('shift_stat_show', '1');
				} else {
					$.removeCookie('shift_stat_show');
				}
			});

			if( $.cookie('shift_stat_show') ){
				$('.shift_stat_show').removeClass('collapsed-box');
				$('.shift_stat_show .btn-box-tool i').removeClass('fa-plus').addClass('fa-minus');
			}
		});
	</script>
@stop
