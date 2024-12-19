@extends('layouts.dashboard',['title'=>'Salary Records'])
@section('dashboard')
<!-- Button trigger modal -->
<div class="text-center mb-2 mt-2">
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
                <h1 class="modal-title fs-5 text-dark" id="payee">Register PAYE</h1>
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
                <h1 class="modal-title fs-5 text-dark" id="payee">Get PAYE Records</h1>
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
        <th colspan="2" class="text-center">Action</th>
    </thead>
    <tbody>
        @foreach ($items as $key => $item)
            <tr>
                <td>{{$key + 1}}</td>
                @if(Auth()->user()->isAdmin)
                <td>{{$item->user->fname.' '.$item->user->lname}}</td>
                @endif
                <td>{{$item->basic_salary}}</td>
                <td>{{$item->allowances}}</td>
                <td>{{$item->insurance}}</td>
                <td>{{$item->pension}}</td>
                <td>{{number_format($payee[$key],2)}}</td>
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
                <!-- <td>
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
                </td> -->
                @if($item->status==false)
                <td>
                <form action="{{route('payment.store',['amount'=>$payee[$key],'item'=>$item->id])}}" method="post">
                @csrf
                <button type="submit" class="btn btn-warning text-dark">Pay Tax</button>
                </form> 
                </td>
                @else
                <td></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@endsection