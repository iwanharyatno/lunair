@php
    $fmt = numfmt_create('id_ID', NumberFormatter::CURRENCY);
@endphp
@extends('template')

@section('title', 'SITAARA | Checkout Pesanan')

@section('content')
    <div class="container my-4">
        <h1 class="fs-5 mb-2 text-center">Checkout Pesanan</h1>
        <form action="{{ route('product.order') }}" method="POST" class="card">
            @csrf
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                        @foreach ($cart as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ urldecode($item->product_name) }}</td>
                                <td>{{ numfmt_format_currency($fmt, $item->product_price, 'IDR') }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ numfmt_format_currency($fmt, $item->subtotal, 'IDR') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="fw-bold text-center">Total</td>
                            <td class="fw-bold">{{ numfmt_format_currency($fmt, $total, 'IDR') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <button class="btn btn-primary mt-4">Pesan</button>
        </form>
    </div>
@endsection
