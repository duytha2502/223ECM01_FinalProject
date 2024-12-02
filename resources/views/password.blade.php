@extends('layouts.front')

@section('content')
<style>
    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }

    .profile-button {
        background: rgb(99, 39, 120);
        box-shadow: none;
        border: none
    }

    .profile-button:hover {
        background: #682773
    }

    .profile-button:focus {
        background: #682773;
        box-shadow: none
    }

    .profile-button:active {
        background: #682773;
        box-shadow: none
    }

    .back:hover {
        color: #682773;
        cursor: pointer
    }

    .labels {
        font-size: 11px
    }

    .add-experience:hover {
        background: #BA68C8;
        color: #fff;
        cursor: pointer;
        border: solid 1px #BA68C8
    }
</style>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-5 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="{{ `/`.$user->avatar }}"><span
                    class="font-weight-bold mt-2">{{ $user->name }}</span><span class="text-black-50">{{ $user->email
                    }}</span><span>
                </span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <form action="{{ route('contact.password.update') }}" method="POST">
                @csrf
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="text-right">Password</h3>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Old Password</label><input required name="old_password"
                                type="password" class="form-control" placeholder="Your old password" value=""></div>
                        <div class="col-md-12"><label class="labels">New Password</label><input required name="new_password"
                                type="password" class="form-control" placeholder="Your new password" value=""></div>
                        <div class="col-md-12"><label class="labels">Confirm New Password</label><input
                            required name="confirm_password" type="password" class="form-control"
                                placeholder="Confirm your new password" value=""></div>
                    </div>
                    <div class="mt-4 text-center"><button class="btn btn-primary profile-button" type="submit">Save
                            Password</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

@endsection
