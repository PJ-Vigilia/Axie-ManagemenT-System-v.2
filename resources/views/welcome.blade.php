@extends('layouts.guest')
@section('content')
    <div class="container-fluid">
        <div class="row vh-100 justify-content-center d-flex align-items-center">
            <div class="col-md-3 bg-white rounded shadow px-4 py-3 login position-relative">
                <div class="container-fluid h-100 position-relative">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3 text-center header mb-5">
                            <h2>AIMS</h2>
                            <p>Axie Infinity Management System</p>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required autocomplete="password" autofocus>
                        </div>
                        <div>
                            @error('email')
                                <p class="text-danger">The provided credentials do not match in our records.</p>
                            @enderror
                        </div>
                        <div class="position-absolute bottom-0 start-0 end-0 px-4 mb-3">
                            <button type="submit" class="btn btn-sm w-100 btn-login">Login</button>
                            <p class="py-2 text-center">Don't have account? <a href="{{ route('register') }}" class="link-register">Register</a></p>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection