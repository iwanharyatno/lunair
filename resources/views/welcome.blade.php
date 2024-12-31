@extends('template')

@section('title', 'ELYSEIA Official Website')
@section('header')

@endsection

@section('content')
    <div class="container py-5">
        <!-- Section: Apa itu Sitaara -->
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h2 class="text-danger fw-bold">Apa itu ELYSEIA?</h2>
                <p class="fs-5">ELYSEIA adalah E-Commerce yang mneyediakan berbagai produk hijab dan handbag yang murah dan berkualitas .</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="/img/home/eleysia.jpg" alt="Logo SITAARA" class="img-fluid rounded-circle shadow">
            </div>
        </div>

        <!-- Section: Produk Klepon -->
        <div class="row align-items-center mb-5 bg-light py-4 px-3 rounded-4">
            <div class="col-md-6 order-md-2">
                <h2 class="text-danger fw-bold">Hijab</h2>
                <p class="fs-5">Hijab bukan hanya kewajiban, tetapi juga sebuah seni. Dengan padu padan yang tepat, hijab bisa menjadi fashion statement yang unik dan menarik. Produk hijab kami hadir dengan desain terbaru dan bahan berkualitas, sehingga Anda bisa tampil stylish dan tetap syari.</p>
                <a href="/catalogue/#hijab" class="btn btn-outline-danger mt-3">Lihat Katalog</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="/img/home/jilbab.jpg" alt="Klepon" class="img-fluid rounded shadow" style= "height:500px; width:500px;">
            </div>
        </div>

        <!-- Section: Cara Order -->
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h2 class="text-danger fw-bold">Order lewat mana saja</h2>
                <p class="fs-5">Anda dapat menghubungi kami melalui DM Instagram, WhatsApp, Email, atau langsung melalui website ini untuk memesan produk ELYSEIA.</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="/img/home/order-options.png" alt="Cara Order" class="img-fluid rounded-circle shadow">
            </div>
        </div>

        <!-- Section: Handbag -->
        <div class="row align-items-center mb-5 bg-light py-4 px-3 rounded-4">
            <div class="col-md-6 order-md-2">
                <h2 class="text-danger fw-bold">Handbag</h2>
                <p class="fs-5">Elegan dan fungsional, handbag kami adalah teman setia Anda dalam setiap kesempatan. Didesain dengan gaya terkini dan menggunakan bahan berkualitas tinggi, handbag ini tidak hanya mempercantik penampilan Anda, tetapi juga mampu menampung semua barang bawaan Anda dengan nyaman. Sempurna untuk wanita modern yang aktif."</p>
                <a href="/catalogue/#handbag" class="btn btn-outline-danger mt-3">Lihat Katalog</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="/img/home/handbag.jpg" alt="Klepon" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="text-center py-5" style="background-color: #ffe4e6;">
        <h2 class="text-danger fw-bold">Pilih Outfit andalanmu di ELYSEIA</h2>
        <a href="/catalogue" class="btn btn-danger btn-lg mt-3">Mulai Belanja</a>
    </div>
@endsection
