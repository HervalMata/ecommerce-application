@extends('site.app')
@section('title', 'Compras')
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Compras</h2>
        </div>
    </section>
    <section class="section-content bg padding-y border-top">
        <div class="container">
            <div class="row">
            </div>
            <div class="row">
                <main class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Ordem Nº</th>
                                <th scope="col">Nome</th>
                                <th scope="col">SobreNomeº</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <th scope="row">{{ $order->$order_number }}</th>
                                    <td>{{ $order->$first_name }}</td>
                                    <td>{{ $order->$last_name }}</td>
                                    <td>{{ config('settings.currency_symbol') }}{{ $order->$grand_total, 2 }}</td>
                                    <td>{{ $order->$item_count }}</td>
                                    <td><span class="badge badge-success">{{ $order->$status }}</span></td>
                                </tr>
                            @empty
                                    <div class="col-sm-12">
                                        <p class="alert alert-warning">Nemhuma compra disponivel.></p>
                                    </div>
                            @endforelse
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </section>
@stop
