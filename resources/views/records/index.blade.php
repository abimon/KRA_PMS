@extends('layouts.app')
@section('content')
<!-- Button trigger modal -->
<div class="text-center mb-2">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#payee">
        Register Payee
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="payee" tabindex="-1" aria-labelledby="payee" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="payee">Register Payee</h1>
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
<table class="table table-responsive">
    <thead>
        <th>#</th>
        <th>Basic Salary</th>
        <th>Allowances</th>
        <th>SHIF</th>
        <th>NSSF</th>
        <th>Payee</th>
        <th>Status</th>
        <th colspan="3" class="text-center">Action</th>
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
                <td>{{$item->status}}</td>
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
            </tr>
        @endforeach
    </tbody>
</table>
@endsection