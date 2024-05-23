@extends('layouts.navbar')
@section('title', 'Halaman Login')

@section('content')
    <div class="row row-gap-4 justify-content-center mb-4">
        <div class="col-5">
            <!-- Error message -->
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card bg-white w-100 rounded-2" style="border: 1px solid black;">
                <h2 class="text-center fw-bold my-3">Halaman Login User</h2>
                <div class="card-body">
                    <form action="{{ route('login.authenticate') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <p> Belum Punya Akun? <a href="{{ route('register') }}"
                                style="color: black; font-weight: bold;">Daftar Sekarang</a></p>

                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" class="btn btn-lg btn-success">Submit</button>
                        </div>

                        <p class="text-center">atau</p>

                        <div class="text-center">
                            <a href="#" class="btn btn-lg bg-info" style="color: white;">
                                <img src="http://pluspng.com/img-png/google-logo-png-open-2000.png" alt="Google Logo"
                                    class="me-2" style="width: 30px; height: 30px;"> Login Google
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
