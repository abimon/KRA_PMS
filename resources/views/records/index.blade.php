@extends('layouts.app')
@section('content')
<!-- Button trigger modal -->
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
                                class="form-control @error('basic_salary') is-invalid @enderror" name="basic_salary"
                                value="{{ old('basic_salary') }}" required autocomplete="basic_salary" autofocus>

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
                                class="form-control @error('allowances') is-invalid @enderror" name="allowances"
                                value="{{ old('allowances') }}" required autocomplete="allowances" autofocus>

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
                                class="form-control @error('insurance') is-invalid @enderror" name="insurance"
                                value="{{ old('insurance') }}" required autocomplete="insurance" autofocus>

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
            <form action="{{route('payee.edit',3)}}" method="post">
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
<table class="table table-responsive">
    <thead>
        <th>#</th>
        <th>Basic Salary</th>
        <th>Allowances</th>
        <th>SHIF</th>
        <th>NSSF</th>
        <th>Payee</th>
        <th>Status</th>
        <th colspan="4" class="text-center">Action</th>
    </thead>
    <tbody>
        @foreach ($items as $key => $item)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->basic_salary}}</td>
                <td>{{$item->allowances}}</td>
                <td>{{$item->insurance}}</td>
                <td>{{$item->pension}}</td>
                <td>{{$payee[$key]}}</td>
                <td>
                    @if ($item->status==true)
                    <span class='text-success'>Payment Successful</span>
                    @else
                    <div class="text-danger">
                    Pending Payment
                    </div>
                    @endif
                </td>
                <td>
                    <form action="{{route('payee.show', $item->id)}}" method="post">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-primary">View</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('payee.edit', $item->id)}}" method="post">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('payee.destroy', $item->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                @if($item->status==false)
                <td>
                    <button class="btn btn-warning text-dark" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay{{$item->id}}">Pay Tax</button>
                    <div class="modal fade" id="pay{{$item->id}}" tabindex="-1" aria-labelledby="pay{{$item->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="payee">Make Payment</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{route('payment.store')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="account" value="{{$item->id}}">
                                        <input type="hidden" name="amount" value="5">
                                        <input type="hidden" name="id" value="{{$item->user->id}}">
                                        <div class="row mb-3">
                                            <label for="contact" class="col-md-6 col-form-label text-md-end text-dark">{{ __('Mpesa Phone Number') }}</label>

                                            <div class="col-md-6">
                                                <input id="contact" type="text"
                                                    class="form-control @error('contact') is-invalid @enderror"
                                                    name="contact" value="{{ old('contact') }}" required
                                                    autocomplete="contact" autofocus value="{{$item->user->contact}}">
                                                @error('contact')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Make Payment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
                @else
                <td></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@endsection