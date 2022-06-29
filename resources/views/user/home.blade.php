@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/user/home.css') }}">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 image-container">
                <div class="row h-100 justify-content-end d-flex py-3 align-items-center content-container">
                    <div class="col-md-5 content rounded px-3 py-2">
                        <div class="fs-5 text-center mb-2">
                            Axie Infinity Management System
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Account</th>
                                    <th scope="col">Axies</th>
                                    <th scope="col">SLP</th>
                                    <th scope="col">Transaction</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_home_tbody">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/user/home.js') }}" defer></script>
@endsection
