@extends('layouts.dashboard')
@section('dashboard')
<div class="container">
    <div class="div" id="form" style="display:none">
        <div class="text-end mb-2">
            <button class="btn btn-primary" onclick="hideForm()">Cancel</button>
        </div>
        <form action="" method="post" class="row bg-white p-4">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="ms-2 card p-3 border-dark bg-transparent shadow h-75" style="border-style:dashed;">
                        <img id="outCard" src="{{$user->avatar}}" style="height: 100%; object-fit:contain;" />
                        <input type="file" accept="image/*" name="avatar" id="cover" style="display: none;"
                            class="form-control" onchange="loadcoverFile(event)">
                        <div class="pt-2" id="desc">
                            @if ($user->avatar == null)
                                <div class="text-center" style="font-size: xxx-large; font-weight:bolder;">
                                    <i class="bi bi-upload"></i>
                                </div>
                            @endif
                            <div class="text-center">
                                <label class="text-white" for="cover" class="btn btn-success text-white"
                                    title="Upload new profile image">Change</label>
                            </div>
                            <div class="text-center prim">*File supported .png .jpg .webp</div>
                        </div>
                        <script>
                            var loadcoverFile = function (event) {
                                var image = document.getElementById('outCard');
                                image.src = URL.createObjectURL(event.target.files[0]);
                                document.getElementById('cover').value == image.src;

                            };
                        </script>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="fname" name="fname" value="{{$user->fname}}"
                            placeholder="First Name">
                        <label class="text-white" for="fname">First Name</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="mname" name="mname" value="{{$user->mname}}"
                            placeholder="Middle Name">
                        <label class="text-white" for="mname">Middle Name</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="lname" name="lname" value="{{$user->lname}}"
                            placeholder="Last Name">
                        <label class="text-white" for="lname">Last Name</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}"
                            placeholder="Email">
                        <label class="text-white" for="email">Email</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="contact" name="contact" value="{{$user->contact}}"
                            placeholder="Contact Number">
                        <label class="text-white" for="contact">Contact Number</label>
                    </div>
                </div>
            </div>

            <div class="form-floating col-md-6 mb-2">
                <input type="text" class="form-control" id="id_number" name="id_number" value="{{$user->id_number}}"
                    placeholder="National ID Number">
                <label class="text-white" for="id_number">National ID Number</label>
            </div>
            <div class="form-floating col-md-6 mb-2">
                <input type="text" class="form-control" id="kra_pin" name="kra_pin" value="{{$user->kra_pin}}"
                    placeholder="KRA PIN">
                <label class="text-white" for="kra_pin">KRA PIN</label>
            </div>
            <div class="form-floating col-md-6 mb-2">
                <input type="text" class="form-control" id="employer" name="employer" value="{{$user->employer}}"
                    placeholder="Employer">
                <label class="text-white" for="employer">Employer</label>
            </div>
            <div class="form-floating col-md-6 mb-2">
                <input type="text" class="form-control" id="employer_kra" name="employer_kra"
                    value="{{$user->employer_kra}}" placeholder="Employer KRA">
                <label class="text-white" for="employer_kra">Employer KRA</label>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
    <div class="card p-2" id="data">

        <div class="row">
            <div class="col-md-4 mb-1">
                <img src="{{$user->avatar}}" alt="" style="width:100%; object-fit:cover;">
            </div>
            <div class="col-md-8 mb-1">

                <div class="row">
                    <button class="btn btn-info w-75" onclick="showForm()">Edit</button>
                    <div class="mb-2 col-md-6">
                        <div class="fw-bold">Full Name: </div>
                        <div>{{$user->fname . ' ' . $user->mname . ' ' . $user->lname}}</div>
                    </div>
                    <div class="mb-2 col-md-6">
                        <div>Email: </div>
                        <div>{{$user->email}}</div>
                    </div>
                    <div class="mb-2 col-md-6">
                        <div>Contact: </div>
                        <div>{{ $user->contact }}</div>
                    </div>
                    <div class="mb-2 col-md-6">
                        <div>National ID: </div>
                        <div>{{$user->id_number}}</div>
                    </div>
                    <div class="mb-2 col-md-6">
                        <div>Position: </div>
                        <div>{{ $user->role }}</div>
                    </div>
                    <div class="col-md-6 mb-1">
                        <div class="">KRA PIN</div>
                        <div>{{$user->kra_pin}}</div>
                    </div>
                    <div class="col-md-6 mb-1">
                        <div class="">Employer</div>
                        <div>{{$user->employer}}</div>
                    </div>
                    <div class="col-md-6 mb-1">
                        <div class="">Employer PIN</div>
                        <div>{{$user->employer_kra}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showForm() {
        document.getElementById('form').style.display = '';
        document.getElementById('data').style.display = 'none';
    }
    function hideForm() {
        document.getElementById('form').style.display = 'none';
        document.getElementById('data').style.display = '';
    }
</script>
@endsection