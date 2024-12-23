@extends('template')

@section('title', 'SITAARA Official Website')
@section('header')
    <header class="text-center py-5" style="background-color: #ffe4e6;">
        <h1 class="display-3 fw-bold text-danger">LUNAIR</h1>
        <p class="fs-4 text-muted">Your Best Part For Fahsion</p>
        <a href="/catalogue" class="btn btn-danger btn-lg mt-3">Lihat Produk Kami</a>
    </header>
@endsection

@section('content')
    <div class="container py-5">
        <!-- Section: Apa itu Sitaara -->
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h2 class="text-danger fw-bold">Apa itu SITAARA?</h2>
                <p class="fs-5">SITAARA adalah usaha yang memproduksi jajanan tradisional dengan kualitas terbaik untuk melestarikan budaya kuliner Indonesia.</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="/img/home/sitaara-logo.png" alt="Logo SITAARA" class="img-fluid rounded-circle shadow">
            </div>
        </div>

        <!-- Section: Produk Klepon -->
        <div class="row align-items-center mb-5 bg-light py-4 px-3 rounded-4">
            <div class="col-md-6 order-md-2">
                <h2 class="text-danger fw-bold">Klepon</h2>
                <p class="fs-5">Klepon adalah makanan tradisional berbentuk bulatan hijau kecil, dengan taburan kelapa parut dan isian gula jawa cair yang manis. Produk ini menjadi maskot utama kami.</p>
                <a href="/catalogue" class="btn btn-outline-danger mt-3">Lihat Katalog</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="/img/home/klepon.png" alt="Klepon" class="img-fluid rounded shadow">
            </div>
        </div>

        <!-- Section: Cara Order -->
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h2 class="text-danger fw-bold">Order lewat mana saja</h2>
                <p class="fs-5">Anda dapat menghubungi kami melalui DM Instagram, WhatsApp, Email, atau langsung melalui website ini untuk memesan produk SITAARA.</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="/img/home/order-options.png" alt="Cara Order" class="img-fluid rounded-circle shadow">
            </div>
        </div>

        <!-- Section: Maskot Kle-O -->
        <div class="row align-items-center bg-light py-4 px-3 rounded-4">
            <div class="col-md-6 order-md-2">
                <h2 class="text-danger fw-bold">KLE-O</h2>
                <p class="fs-5">Kenalkan Kle-o, maskot dari produk kami! Kle-o adalah perwujudan dari makanan tradisional klepon yang lucu dan menggemaskan.</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="/img/home/sitaara-kle-o.png" alt="Maskot Kle-O" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="text-center py-5" style="background-color: #ffe4e6;">
        <h2 class="text-danger fw-bold">Nikmati kelezatan tradisional bersama SITAARA!</h2>
        <a href="/catalogue" class="btn btn-danger btn-lg mt-3">Mulai Belanja</a>
    </div>
@endsection
