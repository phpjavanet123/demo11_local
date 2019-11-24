@extends('layouts.app')

@section('content')
<div class="uper">
  @include('transactions._search')
      <div class="card-header">Transactions
          <div class="export-to-files">
              <a href="{{$exportFileUrl->xmlUrl}}"><img title="Export to XML" src="/images/xml.png" /></a>
              <a href="{{$exportFileUrl->csvUrl}}"><img title="Export to CSV" src="/images/csv.png" /></a>
          </div>
      </div>
  <table class="table table-striped thead-dark">
    <thead>
        <tr>
          <td>Transaction ID</td>
          <td>Status</td>
		  <td>Amount</td>
		  <td>Source Wallet</td>
          <td>Destination Wallet</td>
          <td>Executed Date</td>
        </tr>
    </thead>
    <tbody>
		@foreach($transactions as $transaction)
        <tr>
            <td>{{$transaction->id}}</td>
            <td>{{$transaction->status}}</td>
            <td>${{$transaction->default_currency_amount}}</td>
            <td>{{$transaction->from_wallet_currency_amount}} in wallet currency</td>
            <td>{{$transaction->to_wallet_currency_amount}} in wallet currency</td>
            <td>{{$transaction->executed_at}}</td>
        </tr>
        @endforeach
        <tr style="font-weight: bold">
            <td colspan="2" style="text-align: right;">Total:</td>
            <td>{{$transactionsDefaultSum}}</td>
            <td>{{$transactionsSum}}</td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
  </table>
<div>
@endsection
