@extends('backend.layouts.app')

@section('page-title', $role->name .' '. trans('app.tree'))
@section('page-heading', $role->name .' '. trans('app.tree'))

@section('content')

    <section class="content-header">
        @include('backend.partials.messages')
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $role->name }} @lang('app.tree')</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            @if( auth()->user()->role_id > 4 )
                                <th>@lang('app.agent')</th>
                                <th>@lang('app.distributor')</th>
                                <th>@lang('app.shop')</th>
                            @endif
                            {{-- @if( auth()->user()->role_id > 3 )
                            <th>@lang('app.manager')</th>
                            @endif --}}
                            <th>@lang('app.cashier')</th>
                            <th>@lang('app.user')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($users))
                            @foreach ($users as $user)
                                <tr>
                                @if($user->hasRole('agent'))
                                    <td rowspan="{{ $user->getRowspan() }}">
                                        <a href="{{ route('backend.user.edit', $user->id) }}">
                                            {{ $user->username ?: trans('app.n_a') }}
                                        </a>
                                    </td>
                                    @if( $distributors = $user->getInnerUsers() )
                                        @foreach($distributors AS $member)
                                            @include('backend.user.partials.distributor')
                                        @endforeach
                                    @else
                                        <td colspan="5"></td></tr><tr></tr><tr>
                                    @endif
                                @elseif($user->role_id == auth()->user()->role_id-1)
                                    @include('backend.user.partials.distributor', ['member' => $user])
                                @endif
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="5">@lang('app.no_data')</td></tr>
                        @endif
                        </tbody>
                        <thead>
                        <tr>
                            @if( auth()->user()->role_id > 4 )
                                <th>@lang('app.agent')</th>
                                <th>@lang('app.distributor')</th>
                                <th>@lang('app.shop')</th>
                            @endif
                            {{-- @if( auth()->user()->role_id > 3 )
                            <th>@lang('app.manager')</th>
                            @endif --}}
                            <th>@lang('app.cashier')</th>
                            <th>@lang('app.user')</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>


@stop

@section('scripts')
    <script>


    </script>
@stop