@extends('backend.layouts.app')

@section('page-title', trans('app.pyour_withdraw'))
@section('page-heading', trans('app.pyour_withdraw'))

@section('content')

<section class="content-header">
    @include('backend.partials.messages')
</section>

<section class="content">
    <div class="tableList">
        <table class="table bg-white text-center">
            <thead>
                <tr>
                    <th scope="col">UserName</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Wallet</th>
                    <!-- <th scope="col">Shop</th> -->
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Confirmed At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($withdraws as $withdraw)
                <tr class="fw-bold">
                    <td>{{ $withdraw->user->username }}</td>
                    <td>{{ $withdraw->amount }} {{ $withdraw->currency }}</td>
                    <td>{{ $withdraw->wallet }}</td>
                    <!-- <td>{{ $withdraw->shop->name }}</td> -->
                    <td>
                        @if(!$withdraw->status)
                        <a href="#" class="btn btn-xs btn-primary">Pending</a>
                        @elseif($withdraw->status==1)
                        <a href="#" class="btn btn-xs btn-success">Approved</a>
                        @elseif($withdraw->status==2)
                        <a href="#" class="btn btn-xs btn-danger">Rejected</a>
                        @endif
                    </td>
                    <td>{{ $withdraw->created_at }}</td>
                    <td>{{ $withdraw->confirmed_at }}</td>
                    <td>
                        @if(!$withdraw->status)
                        <a href="{{ route('backend.withdraw.confirm', ['withdraw'=>$withdraw->id, 'status'=>1]) }}"
                           class="btn btn-success btn-xs"
                           data-method="PUT"
                           data-confirm-title="Please Confirm"
                           data-confirm-text="Are you sure approve?"
                           data-confirm-delete="Approve">
                            Approve
                        </a>
                        <a href="{{ route('backend.withdraw.confirm', ['withdraw'=>$withdraw->id, 'status'=>2]) }}"
                           class="btn btn-danger btn-xs"
                           data-method="PUT"
                           data-confirm-title="Please Confirm"
                           data-confirm-text="Are you sure reject?"
                           data-confirm-delete="Reject">
                            Reject
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
                @if(count($withdraws) == 0)
                <tr>
                    <td colspan="10">
                        <div class="noData">
                            No diplay data.
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</section>
@stop

@section('scripts')
<script>

</script>
@stop