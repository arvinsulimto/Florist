@extends('layouts.app')

@section('title', 'Transaction History')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Transaction History</div>

                @if($transactionhistory->count()==0)
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">No transactions available</div>
                    </div>
                @else
                    <div class="card-body">
                        @foreach ($transactionhistory->pluck('transactionid')->unique() as $transactionId)
                            <div class="card margin-ver">
                                <div class="card-header">
                                    <div class="btn-toolbar">
                                        <div class="col-md-2">
                                            <div>Transaction ID</div>
                                        </div>
                                        <div class="col-md-5">
                                            <div>: {{$transactionhistory->where('transactionid',$transactionId )->first()->transactionid}}</div>
                                        </div>
                                    </div>
                                    <div class="btn-toolbar">
                                        <div class="col-md-2">
                                            <div>Transaction Date</div>
                                        </div>
                                        <div class="col-md-5">
                                            <div>: {{$transactionhistory->where('transactionid',$transactionId )->first()->transactiondate}}</div>
                                        </div>
                                    </div>
                                    <div class="btn-toolbar">
                                        <div class="col-md-2">
                                            <div>Member Name</div>
                                        </div>
                                        <div class="col-md-5">
                                            <div>: {{$transactionhistory->where('transactionid',$transactionId )->first()->name}}</div>
                                        </div>
                                    </div>
                                    <div class="btn-toolbar">
                                        <div class="col-md-2">
                                            <div>Courier Name</div>
                                        </div>
                                        <div class="col-md-5">
                                            <div>: {{$transactionhistory->where('transactionid',$transactionId )->first()->couriername}}</div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Picture</th>
                                            <th scope="col">Flower Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactionhistory->where('transactionid',$transactionId ) as $history)
                                            <tr>
                                                <td>
                                                    <img src="storage/{{ $history->image }}" alt="{{ $history->flowername }}" width="100px" height="100px">
                                                </td>
                                                <td>{{$history->flowername}}</td>
                                                <td>{{$history->jumlah}}</td>
                                                <td>Rp {{$history->harga}}</td>
                                                <td>Rp {{$history->jumlah * $history->harga}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>    
                                </table>
                                <div class="card-header">
                                    <div class="btn-toolbar">
                                        <div class="col-md-10">
                                            <div class="float-right">Total Price</div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>: Rp {{$transactionhistory->where('transactionid',$transactionId )->first()->totalprice}}</div>
                                        </div>
                                    </div>
                                    <div class="btn-toolbar">
                                        <div class="col-md-10">
                                            <div class="float-right">Courier Price</div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>: Rp {{$transactionhistory->where('transactionid',$transactionId )->first()->courierprice}}</div>
                                        </div>
                                    </div>
                                    <div class="btn-toolbar">
                                        <div class="col-md-10">
                                            <div class="float-right">Grand Total</div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>: Rp {{$transactionhistory->where('transactionid',$transactionId )->first()->totalprice + $transactionhistory->where('transactionid',$transactionId )->first()->courierprice}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
