@extends('template')

@section('title', 'SITAARA | Katalog Produk')

@php
    $fmt = numfmt_create('id_ID', NumberFormatter::CURRENCY);
@endphp
@section('content')
<div class="container-fluid py-5" style="background-color: #ffe4e1;">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-4">
            <h2 class="fw-bold text-secondary">Temukan Gaya Terbaikmu</h2>
            <p class="text-muted">Eksplorasi koleksi fashion wanita terbaru dari Sitaara</p>
        </div>
    </div>

    <!-- Bagian Hijab -->
    <div class="row justify-content-center mb-5" id="hijab">
        <div class="col-12 text-center mb-4">
            <h3 class="fw-bold text-primary">Koleksi Hijab</h3>
        </div>
        <div class="row justify-content-evenly">
            @foreach ($products as $product)
                <div class="card col-md-4 col-lg-3 m-3 p-0 shadow-sm" style="border-radius: 15px; overflow: hidden; background-color: #fff0f5;">
                    <div class="position-relative">
                        <img src="/image/{{ $product->image ? $product->image->path : 'default.jpg' }}" class="card-img-top" 
                             alt="{{ $product->name }}" style="object-fit: cover; height: 250px;">
                        <span class="badge bg-danger position-absolute top-0 end-0 m-3">Baru</span>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title text-truncate" style="max-width: 200px; color: #d63384;">{{ urldecode($product->name) }}</h5>
                        <p class="card-subtitle text-muted mb-2">Stok: {{ $product->stock }}</p>
                        <p class="card-text text-danger fw-bold">{{ numfmt_format_currency($fmt, $product->price, 'IDR') }}</p>
                        <p class="card-text text-muted small text-truncate" style="max-width: 200px;">{{ urldecode($product->description) }}</p>
                        <a href="#addToCartCollapse-{{ $product->id }}" data-bs-toggle="collapse" role="button" 
                           aria-expanded="false" class="btn btn-danger btn-sm">Pesan</a>
                        <div class="collapse mt-3" id="addToCartCollapse-{{ $product->id }}">
                            <div class="card card-body" style="background-color: #ffe4e1;">
                                <form action="{{ route('product.store-cart', $product->id) }}" method="POST">
                                    @csrf
                                    <label for="qty-{{ $product->id }}" class="form-label small">Jumlah</label>
                                    <input class="form-control form-control-sm text-center" type="number" name="qty" 
                                           id="qty-{{ $product->id }}" min="1" required>
                                    <button class="btn btn-danger btn-sm mt-2 w-100">Tambah Ke Keranjang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($products->isEmpty())
                <div class="col-12">
                    <div class="text-muted text-center py-5">
                        <p class="display-6">Belum ada produk hijab</p>
                        <p class="text-secondary">Kami sedang menambahkan koleksi baru. Kembali lagi nanti!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Bagian Handbag -->
    <div class="row justify-content-center" id="handbag">
        <div class="col-12 text-center mb-4">
            <h3 class="fw-bold text-primary">Koleksi Handbag</h3>
        </div>
        <div class="row justify-content-evenly">
            @foreach ($products as $product)
                <div class="card col-md-4 col-lg-3 m-3 p-0 shadow-sm" style="border-radius: 15px; overflow: hidden; background-color: #fff0f5;">
                    <div class="position-relative">
                        <img src="/image/{{ $product->image ? $product->image->path : 'default.jpg' }}" class="card-img-top" 
                             alt="{{ $product->name }}" style="object-fit: cover; height: 250px;">
                        <span class="badge bg-danger position-absolute top-0 end-0 m-3">Baru</span>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title text-truncate" style="max-width: 200px; color: #d63384;">{{ urldecode($product->name) }}</h5>
                        <p class="card-subtitle text-muted mb-2">Stok: {{ $product->stock }}</p>
                        <p class="card-text text-danger fw-bold">{{ numfmt_format_currency($fmt, $product->price, 'IDR') }}</p>
                        <p class="card-text text-muted small text-truncate" style="max-width: 200px;">{{ urldecode($product->description) }}</p>
                        <a href="#addToCartCollapse-{{ $product->id }}" data-bs-toggle="collapse" role="button" 
                           aria-expanded="false" class="btn btn-danger btn-sm">Pesan</a>
                        <div class="collapse mt-3" id="addToCartCollapse-{{ $product->id }}">
                            <div class="card card-body" style="background-color: #ffe4e1;">
                                <form action="{{ route('product.store-cart', $product->id) }}" method="POST">
                                    @csrf
                                    <label for="qty-{{ $product->id }}" class="form-label small">Jumlah</label>
                                    <input class="form-control form-control-sm text-center" type="number" name="qty" 
                                           id="qty-{{ $product->id }}" min="1" required>
                                    <button class="btn btn-danger btn-sm mt-2 w-100">Tambah Ke Keranjang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($products->isEmpty())
                <div class="col-12">
                    <div class="text-muted text-center py-5">
                        <p class="display-6">Belum ada produk handbag</p>
                        <p class="text-secondary">Kami sedang menambahkan koleksi baru. Kembali lagi nanti!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
