@php
    $fmt = numfmt_create('id_ID', NumberFormatter::CURRENCY);
@endphp
@extends('template')

@section('title', 'SITAARA | Keranjang Saya')

@section('content')
    <div class="container p-4">
        <div class="my-4 d-flex gap-4 align-items-center">
            <p class="fw-bold">Total: {{ numfmt_format_currency($fmt, $total   , 'IDR') }}</p>
            <a href="{{ route('product.checkout') }}" class="btn btn-primary">Checkout semua</a>
        </div>
        @forelse ($cart as $item)
            <div class="card col-md-3 mx-md-3 mb-3 py-2">
                <div class="img-placeholder w-75 m-auto my-3" data-placeholder="{{ $item->product_name }}">
                    <img src="/image/{{ $item->product_image ? $item->product_image : '' }}" class="card-img-top"
                        alt="{{ $item->product_name }}">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ urldecode($item->product_name) }}</h5>
                    <h6 class="card-subtitle text-muted">{{ numfmt_format_currency($fmt, $item->product_price, 'IDR') }}</h6>
                    <p class="card-text">
                    <ul>
                        <li>Quantity: {{ $item->qty }}</li>
                        <li>Subtotal: {{ numfmt_format_currency($fmt, $item->subtotal, 'IDR') }}</li>
                    </ul>
                    </p>
                    <form action="{{ route('product.delete-cart', $item->product_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-primary">Checkout</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center text-secondary">
                <p>Belum ada item di keranjang</p>
            </div>
        @endforelse
    </div>
@endsection
