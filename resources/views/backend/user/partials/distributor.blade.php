@if( $member->hasRole('distributor') && $member->shops() && count($member->shops()) )
<td rowspan="{{ $member->getRowspan() }}">
    <a href="{{ route('backend.user.edit', $member->id) }}">
        {{ $member->username ?: trans('app.n_a') }}
    </a>
</td>
    @if($shops = $member->rel_shops)
        @foreach($shops AS $shop)
            @if($shop = $shop->shop)
                <td rowspan="{{ $shop->getRowspan() }}">
                    <a href="{{ route('backend.shop.edit', $shop->id) }}">{{ $shop->name }}</a>
                </td>

                @if( $cashiers = $shop->getUsersByRole('cashier') )
                    @if(count($cashiers))
                        @foreach($cashiers AS $cashier)
                            <td>
                                <a href="{{ route('backend.user.edit', $cashier->id) }}">
                                    {{ $cashier->username ?: trans('app.n_a') }}
                                </a>
                            </td>

                            <td>
                                <a href="{{  route('backend.profile.setshop', ['shop_id' => $shop->id, 'to' => route('backend.user.list', ['role' => 1])])  }}">
                                    >> @lang('app.users')
                                </a>
                            </td></tr><tr>
                        @endforeach
                    @else
                        <td colspan="2"></td></tr><tr>
                    @endif
                @endif
            @else
                <td colspan="3"></td></tr><tr>
            @endif
        @endforeach
    @endif
@elseif($member->hasRole('cashier'))
    <td>
        <a href="{{ route('backend.user.edit', $member->id) }}">
            {{ $member->username ?: trans('app.n_a') }}
        </a>
    </td>

    <td>
        <a href="{{  route('backend.profile.setshop', ['shop_id' => $member->shop_id, 'to' => route('backend.user.list', ['role' => 1])])  }}">
            >> @lang('app.users')
        </a>

    </td></tr><tr>
@endif