@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-bar-chart"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <section class="invoice">
                    <div class="row mb-4">
                        <div class="col-6">
                            <h2 class="page-header"><i class="fa fa-globe"></i> {{ $order->order_number }}</h2>
                        </div>
                        <div class="col-6">
                            <h5 class="text-right">Data: {{ $order->created_at->toFormmattedDateString() }}</h5>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-4">Feita Por
                            <address><strong>{{ $order->user->fullName }}</strong><br>Email: {{ $order->user->email }}
                            </address>
                        </div>
                        <div class="col-4">Entregue Para
                            <address>
                                <strong>{{ $order->user->first_name }} {{ $order->last_name }}</strong><br>{{ $order->address }}
                                <br></address>
                        </div>
                        <div class="col-4">
                            <b>Ordem ID:</b> {{ $order->order_number }}<br>
                            <b>Total:</b> {{ config('settings.currency_symbol') }}{{ round($order->grand_total, 2) }}
                            <br>
                            <b>Método de Pagamento:</b> {{ $order->payment_method }}<br>
                            <b>Status do Pagamento:</b> {{ $order->payment_status == 1 ? 'Completada' : 'Incompleta' }}
                            <br>
                            <b>Status da Ordem:</b> {{ $order->status }}<br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th> Quantidade</th>
                                    <th> Produto</th>
                                    <th> SKU</th>
                                    <th> Quantidades de Itens</th>
                                    <th> SubTotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->product->sku }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ config('settings.currency_symbol') }}{{ round($item->price, 2) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
