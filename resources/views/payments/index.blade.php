@extends('layouts.dashboard',['title'=>'Payment Records'])
@section('dashboard')
<table class="table table-responsive">
    <thead>
        <th>#</th>
        <th>Name</th>
        <th>Transaction ID</th>
        <th>Reference</th>
        <th>Code</th>
        <th>Amount</th>
        <th>Status</th>
    </thead>
    <tbody>
        @foreach ($items as $key => $item)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->user->fname.' '.$item->user->lname}}</td>
                <td>{{$item->TransactionId}}</td>
                <td>{{$item->merchant_reference}}</td>
                <td>{{$item->confirmation_code}}</td>
                <td>{{$item->amount}}</td>
                <td>
                    @if ($item->payment_status_description!='Completed')
                    <span class='text-warning'>Pending</span>
                    @else
                    <span class="text-success">Completed</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection