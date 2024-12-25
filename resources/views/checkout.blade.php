@php
    $fmt = numfmt_create('id_ID', NumberFormatter::CURRENCY);
@endphp
@extends('template')

@section('title', 'SITAARA | Checkout Pesanan')

@section('content')
    <div class="container my-4">
        <h1 class="fs-5 mb-4 text-center">Checkout Pesanan</h1>
        <form action="{{ route('product.order') }}" method="POST" class="card w-75 mx-auto">
            @csrf
            <div class="card-body">
                <div class="form-group mb-2">
                    <label for="full_name" class="form-label">Nama Lengkap <span class="text-danger" title="Wajib diisi">*</span></label>
                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                    @error('full_name')
                        <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="phone" class="form-label">No Whatsapp/Telepon <span class="text-danger" title="Wajib diisi">*</span></label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="address" class="form-label">Alamat <span class="text-danger" title="Wajib diisi">*</span></label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>{{ old('address') }}</textarea>
                    @error('address')
                        <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
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
