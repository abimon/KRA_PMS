@extends('layouts.dashboard')
@section('dashboard')


<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="mb-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Expected PAYE</p>
                        <h6 class="mb-0">Ksh. {{App\Models\Payment::sum('amount')}}</h6>
                    </div>
                </div>
            </div>
            <div class="mb-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Today Paid PAYE</p>
                        <h6 class="mb-0">Ksh.
                            {{App\Models\Payment::where('payment_status_description', 'Completed')->sum('amount')}}
                        </h6>
                    </div>
                </div>
            </div>
            <div class="mb-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Unpaid PAYE</p>
                        <h6 class="mb-0">Ksh.
                            {{App\Models\Payment::where('payment_status_description', null)->sum('amount')}}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Calender</h6>
                </div>
                <div id="calender"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">To Do List</h6>
                    <a href="">Show All</a>
                </div>
                <div class="d-flex mb-2">
                    <input class="form-control bg-dark border-0" type="text" placeholder="Enter task">
                    <button type="button" class="btn btn-primary ms-2">Add</button>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                    <input class="form-check-input m-0" type="checkbox">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>Authentication</span>
                            <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                    <input class="form-check-input m-0" type="checkbox">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>Salary record</span>
                            <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                    <input class="form-check-input m-0" type="checkbox">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>Payment Intergration</span>
                            <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Payments</h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col"><input class="form-check-input" type="checkbox"></th>
                        <th scope="col">Date</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $key => $item)
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>{{date_format($item->updated_at, 'jS F, Y')}}</td>
                            <td>{{$item->merchant_reference}}</td>
                            <td>{{$item->user->fname}} {{$item->user->lname}}</td>
                            <td>{{$item->amount}}</td>
                            <td>
                                @if($item->payment_status_description == null)
                                    Incomplete
                                @else
                                    {{$item->payment_status_description}}
                                @endif
                            </td>
                            <td><a class="btn btn-sm btn-primary" href="">Print</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-secondary rounded p-4">
        <table class="table text-start align-middle table-bordered table-hover mb-0 table-responsive">
            <thead>
                <tr class="text-white">
                    <th scope="col"></th>
                    <th scope="col">Date</th>
                    <th>Client Name</th>
                    <th scope="col">Basic Salary</th>
                    <th scope="col">Allowances</th>
                    <th scope="col">SHIF</th>
                    <th scope="col">NSSF</th>
                    <th scope="col">PAYE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $key => $item)
                    <tr>
                        <td><input class="form-check-input" type="checkbox"></td>
                        <td>{{date_format($item->updated_at, 'jS F, Y')}}</td>
                        <td>{{$item->user->fname}} {{$item->user->lname}}</td>
                        <td>{{$item->basic_salary}}</td>
                        <th>{{$item->Allowances}}</th>
                        <td>{{$item->insurance}}</td>
                        <td>{{$item->pension}}</td>
                        <td>{{$payee[$key]}}</td>
                        <td>
                            <a href="{{route('payee.show', $item->id)}}">
                                <button class="btn btn-primary">Print</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection