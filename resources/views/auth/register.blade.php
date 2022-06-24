@extends('layouts.guest')

@section('content')
<div class="container-fluid">
    <div class="row vh-100 justify-content-center d-flex align-items-center">
        <div class="col-md-4 bg-white rounded shadow px-4 py-3 register">
            <h2 class="text-center">Account Registration</h2>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="mb-3 form-group">
                    <label for="" class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required autocomplete="name" autofocus>
                    @error('full_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 form-group">
                    <label for="" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}" required autocomplete="password" autofocus>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4 form-group">
                    <label for="" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" required autocomplete="password confirmation" autofocus>
                    @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Register</button>
                    <p class="pt-2">Already registered? <a href="{{ url('/') }}" class="link-login">Login</a> </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
