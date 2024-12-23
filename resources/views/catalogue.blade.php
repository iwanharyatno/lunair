@extends('template')

@section('title', 'SITAARA | Katalog Produk')
@section('header')
    <h1 class="text-primary display-2">Katalog Produk</h1>
    <p>Sitaara</p>
@endsection

@php
    $fmt = numfmt_create('id_ID', NumberFormatter::CURRENCY);
@endphp

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-evenly p-4">
            @foreach ($products as $product)
                <div class="card col-md-3 m-3">
                    <div class="img-placeholder w-75 m-auto my-3" data-placeholder="{{ $product->name }}">
                        <img src="/image/{{ $product->image ? $product->image->path : '' }}" class="card-img-top"
                            alt="{{ $product->name }}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ urldecode($product->name) }}</h5>
                        <h6 class="card-subtitle text-muted mb-2">Stok: {{ $product->stock }} |
                            {{ numfmt_format_currency($fmt, $product->price, 'IDR') }}</h6>
                        <p class="card-text">{{ urldecode($product->description) }}</p>
                        <a href="#addToCartCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" class="btn btn-primary">Pesan</a>
                        <div class="collapse mt-4" id="addToCartCollapse">
                            <div class="card card-body">
                                <form action="{{ route('product.store-cart', $product->id) }}" method="POST">
                                    @csrf
                                    <label for="qty" class="form-label">Qty</label>
                                    <input class="form-control" type="number" name="qty" id="qty" required>
                                    <button class="btn btn-primary mt-2">Tambah Ke Keranjang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($products->isEmpty())
                <div class="col-12">
                    <div class="text-muted text-center">Belum ada data</div>
                </div>
            @endif
        </div>
    </div>
@endsection
