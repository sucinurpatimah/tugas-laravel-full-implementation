@extends('layouts.navbar')
@section('title', 'Halaman Utama')
@section('content')
    <section class="container-content" style="display: grid; margin: 20px auto 50px auto; grid-template-columns: 2fr 1fr;">
        <div class="deskripsi" style="padding: 100px 30px;">
            <h3 style="text-align: left; font-size: 20px;">
                Discover. Connect.Thrive.
            </h3>
            <h1 id="red-velvet" style="text-align: left; font-size: 35px; font-weight: bold;">
                Transform Your Shopping Experience.
            </h1>
            <p style="text-align: justify; font-size: 13px;">Welcome to Amandemy Shopping, where your desires meet their
                perfect match.
                Immerse yourself in a world of endless possibilities, curated just for you. Whether you're hunting for
                unique finds,
                everyday essentials, or extraordinary gifts, we've got you covered.</p>
            <button type="button" class="btn bg-info" style="display: block; text-align: left; font-weight: bold;"
                onclick="location.href='{{ route('products.index') }}'">
                Buy Now!
            </button>

        </div>
        <div class="gambar" style="text-align: center; align-self: center;">
            <img src="https://i.pinimg.com/originals/a1/bf/e9/a1bfe97b8083558db9c0f58da914d11e.jpg" alt="Gambar E-Commerce"
                style="width: 450px;">
        </div>
    </section>
@endsection
