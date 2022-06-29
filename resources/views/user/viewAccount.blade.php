@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/user/axie.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/viewAccount.css') }}">
    @include('modal.axie')
    @include('modal.slp')
    @include('modal.transaction')
    @include('modal.account')
    <div class="container-fluid">
        <input type="hidden" id="account_id" value="{{ $account_id }}">
        <div class="container account-info mb-3 py-3 px-3 position-relative" id="account">
            <!--toast-->
            <div class="position-absolute top-0 end-0 px-4 py-3" id="toast_account">
                <div class="bg-white rounded shadow" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                                
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>      
            </div>
            <!--/toast--> 
        </div>
        <div class="container bg-white mb-3 p-3 position-relative entity">
            <!--toast-->
            <div class="position-absolute top-0 end-0 px-4 py-3" id="toast_axie">
                <div class="bg-white rounded shadow" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                                
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>      
            </div>
            <!--/toast--> 
            <div class="mb-3">
                <h2>Axie</h2>
                <button class="btn btn-sm px-3 btn-add" data-bs-toggle="modal" data-bs-target="#addAxieModal">Add</button>
            </div>
            <div class="w-100">
                <div class="row g-3" id="own_axie">
                        
                </div>
            </div>
        </div>
        <div class="container bg-white mb-3 p-3 position-relative entity">
            <!--toast-->
            <div class="position-absolute top-0 end-0 px-4 py-3" id="toast_slp">
                <div class="bg-white rounded shadow" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                                
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>      
            </div>
            <!--/toast--> 
            <div class="mb-3">
                <h2>SLP</h2>
                <button class="btn btn-sm px-3 btn-add" data-bs-toggle="modal" data-bs-target="#addSLPModal">Add</button>
            </div>
            <div class="row">
                <div class="col-md pt-4">
                    <div class="row mb-3">
                        <div class="col-3 d-flex align-items-center"><label for="">Total SLP</label></div>
                        <div class="col-3"><input type="text" class="rounded input-total px-2 py-1" id="total_slp" value="" readonly></div>
                    </div>
                    <div class="row">
                        <div class="col-3 d-flex align-items-center"><label for="">Available SLP</label></div>
                        <div class="col-3"><input type="text" id="available_slp" class="rounded input-total px-2 py-1" value="200" readonly></div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Date added</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbl-slp-tbody">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="container bg-white mb-3 entity py-3 px-4 rounded position-relative">
            <!--toast-->
            <div class="position-absolute top-0 end-0 px-4 py-3" id="toast_transaction">
                <div class="bg-white rounded shadow" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                                
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>      
            </div>
            <!--/toast--> 
            <div class="mb-3">
                <h2>Transaction</h2>
                <button class="btn btn-sm px-3 btn-add" data-bs-toggle="modal" data-bs-target="#addTransactionModal">Add</button>
            </div>
            <div class="row">
                <div class="col-md pt-4">
                    <div class="row mb-3">
                        <div class="col-3 d-flex align-items-center"><label for="">Total Sold SLP</label></div>
                        <div class="col-3"><input type="text" class="rounded input-total px-2 py-1" id="total_slp_transaction" value="" readonly></div>
                    </div>
                    <div class="row">
                        <div class="col-3 d-flex align-items-center"><label for="">Total Price</label></div>
                        <div class="col-3"><input type="text" class="rounded input-total px-2 py-1" id="total_price_transaction" value="" readonly></div>
                    </div>
                </div>
                <div class="col-md">
                <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Transaction date</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbl-transaction-tbody">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/user/viewAccount.js') }}" defer></script>
@endsection
