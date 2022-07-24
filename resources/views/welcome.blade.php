@extends('template')

@section('title', 'SITAARA Official Website')
@section('header')
    <h1 class="text-primary display-2">SITAARA</h1>
    <p>Your go-to traditional snack</p>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-evenly align-items-center p-5">
            <article class="col-md-4 mb-sm-3">
	            <h2 class="mb-3">Apa itu Sitaara?</h2>
	            <p>Sitaara adalah sebuah usaha yang memproduksi jajanan tradisional.</p>
	        </article>
            <figure class="col-md-4 img-placeholder">
                <img src="/img/home/sitaara-logo.png" class="img-responsive img-thumbnail">
            </figure>
        </div>
        <div class="row justify-content-evenly align-items-center flex-row-reverse p-5" style="background-color: #cffacf">
	        <article class="col-md-4 mb-sm-3">
	            <h2 class="mb-3">Klepon</h2>
	            <p>Klepon adalah makanan tradisional berbentuk bulatan hijau kecil dengan ditaburi parutan kelapa dan isian Gula Jawa cair di dalamnya. Produk ini juga merupakan produk yang menjadi maskot kami.</p>
	            <a class="btn btn-primary my-3" href="/catalogue">Lihat Katalog Produk</a>
	        </article>
            <figure class="col-md-4 img-placeholder">
                <img src="/img/home/sitaara-logo.png" class="img-responsive img-thumbnail">
            </figure>
        </div>
        <div class="row justify-content-evenly align-items-center p-5">
	        <article class="col-md-4 mb-sm-3">
	            <h2 class="mb-3">Order lewat mana saja</h2>
	            <p>Ada beberapa cara untuk menghubungi kami, diantaranya adalah lewat Direct Message (DM) Instagram, Chat Whatsapp, Email atau bahkan langsung di website ini untuk memesan produk kami.</p>
	        </article>
            <figure class="col-md-4 img-placeholder">
                <img src="/img/home/sitaara-logo.png" class="img-responsive img-thumbnail">
            </figure>
        </div>
        <div class="row justify-content-evenly align-items-center flex-row-reverse p-5">
	        <article class="col-md-4 mb-sm-3">
	            <h2 class="mb-3">KLE-O</h2>
	            <p>Temui juga Kle-o. Kle-o adalah maskot produk kami yang merupakan perwujudan dari makanan tradisional klepon.</p>
	        </article>
            <figure class="col-md-4 img-placeholder">
                <img src="/img/home/sitaara-kle-o.png" class="img-responsive img-thumbnail">
            </figure>
        </div>
    </div>
@endsection
