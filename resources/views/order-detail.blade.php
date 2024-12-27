@php
    $fmt = numfmt_create('id_ID', NumberFormatter::CURRENCY);
@endphp
@extends('template')

@section('title', 'Elyseia| Detail Pesanan ' . $order->full_name)

@section('content')
    <div class="container my-4">
        <h1 class="fs-5 mb-4 text-center">Rincian Pesanan</h1>
        <form action="{{ route('product.order') }}" method="POST" class="card w-75 mx-auto">
            @csrf
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInputGroup1" value="{{ $order->id }}"
                            disabled placeholder="Username">
                        <label for="floatingInputGroup1">Order Id</label>
                    </div>
                    <span class="input-group-text">
                        <button type="button" class="btn" onclick="copyOrderId({{ $order->id }})">Copy Link</button>
                    </span>
                </div>
                <div class="form-group mb-2">
                    <label for="full_name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" readonly
                        value="{{ $order->full_name }}">
                </div>
                <div class="form-group mb-2">
                    <label for="phone" class="form-label">No Whatsapp/Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" readonly
                        value="{{ $order->phone }}">
                </div>
                <div class="form-group mb-4">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea class="form-control" id="address" name="address" readonly>{{ $order->address }}</textarea>
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
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($order->details as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ urldecode($item->product_name) }}</td>
                                <td>{{ numfmt_format_currency($fmt, $item->product_price, 'IDR') }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ numfmt_format_currency($fmt, $item->subtotal, 'IDR') }}</td>
                            </tr>
                            @php
                                $total += $item->subtotal;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="4" class="fw-bold text-center">Total</td>
                            <td class="fw-bold">{{ numfmt_format_currency($fmt, $total, 'IDR') }}</td>
                        </tr>
                    </table>
                </div>
                @if ($order->status == 'Pending')
                    <button type="button" id="payButton" class="btn btn-primary mt-4">Bayar sekarang</button>
                @endif
                @if ($order->status == 'Lunas')
                    <div class="alert alert-success alert-dismissible">
                        Pembayaran <span class="font-bold">berhasil</span>!
                    </div>
                @endif
            </div>
        </form>
    </div>
    <form id="successForm" action="{{ route('product.payment-success', ['id' => $order->id]) }}" method="post"
        style="display: none">
        @csrf
    </form>
@endsection

@push('scripts')
    <script>
        function copyOrderId(id) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText('{{ url()->current() }}').then(() => alert('Tautan pesanan disalin!'))
            }
        }
    </script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('payButton').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $order->snap_token }}', {
                onSuccess: function() {
                    document.getElementById('successForm').submit();
                }
            });
        };
    </script>
@endpush
