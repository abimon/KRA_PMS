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
        <div class="d-flex align-items-between justify-content-between mb-4">
            <h6 class="mb-0">Salary Reports</h6>
            <div class="text-center mb-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay">
                    Register PAYE
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#record">
                    Get PAYE Records
                </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="pay" tabindex="-1" aria-labelledby="pay" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="payee">Register PAYE</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('payee.store')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">
                                <div class="row mb-3">
                                    <label for="basic_salary"
                                        class="col-md-4 col-form-label text-md-end text-dark">{{ __('Basic Salary') }}</label>

                                    <div class="col-md-8">
                                        <input id="basic_salary" type="number"
                                            class="form-control @error('basic_salary') is-invalid @enderror"
                                            name="basic_salary" value="{{ old('basic_salary') }}" required
                                            autocomplete="basic_salary" autofocus>

                                        @error('basic_salary')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="allowances"
                                        class="col-md-4 col-form-label text-md-end text-dark">{{ __('Allowances') }}</label>

                                    <div class="col-md-8">
                                        <input id="allowances" type="number"
                                            class="form-control @error('allowances') is-invalid @enderror"
                                            name="allowances" value="{{ old('allowances') }}" required
                                            autocomplete="allowances" autofocus>

                                        @error('allowances')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="insurance"
                                        class="col-md-4 col-form-label text-md-end text-dark">{{ __('S.H.I.F') }}</label>

                                    <div class="col-md-8">
                                        <input id="insurance" type="number"
                                            class="form-control @error('insurance') is-invalid @enderror"
                                            name="insurance" value="{{ old('insurance') }}" required
                                            autocomplete="insurance" autofocus>

                                        @error('insurance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="pension"
                                        class="col-md-4 col-form-label text-md-end text-dark">{{ __('Pension') }}</label>

                                    <div class="col-md-8">
                                        <input id="pension" type="number"
                                            class="form-control @error('pension') is-invalid @enderror" name="pension"
                                            value="{{ old('pension') }}" required autocomplete="pension" autofocus>

                                        @error('pension')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="record" tabindex="-1" aria-labelledby="payee" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="payee">Get PAYE Records</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('payee.edit', 3)}}" method="post">
                            @csrf
                            @method('GET')
                            <div class="modal-body">
                                <div class="row">
                                    <label for="from" class="col-md-4">From</label>
                                    <input type="date" name="from" id="" class="form-control">
                                </div>
                                <div class="row">
                                    <label for="to" class="col-md-4">To</label>
                                    <input type="date" name="to" id="" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                        <th>{{$item->allowances}}</th>
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