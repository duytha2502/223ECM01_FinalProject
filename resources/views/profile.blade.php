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
                <img class="rounded-circle mt-5"
                    width="150px"
                    src="{{ $user->avatar }}"><span
                    class="font-weight-bold mt-2">{{ $user->name }}</span><span class="text-black-50">{{ $user->email }}</span><span>
                </span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <form action="{{ route('contact.update') }}" method="POST">
            @csrf
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="text-right">Profile</h3>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Name</label><input name="name" type="text" class="form-control"
                            placeholder="" value="{{ $user->name }}"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Email</label><input name="email" type="text"
                            class="form-control" placeholder="" value="{{ $user->email }}"></div>
                </div>

                <div class="mt-4"><button class="btn btn-primary" type="button">
                <a style="color: white" href="{{ route('contact.password') }}">Change Password</a></button></div>
                </div>

                <div class="mt-3 text-center"><button class="btn btn-primary profile-button" type="submit">Save
                        Profile</button></div>
            </div>
            </form>
        </div>
    </div>

</div>
</div>

@endsection
