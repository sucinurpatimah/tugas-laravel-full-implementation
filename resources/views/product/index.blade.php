@extends('layouts.navbar')
@section('title', 'Halaman Produk')

@section('content')
    <div class="mx-lg-2 mt-lg-4 mb-lg-3">
        <div class="rounded bg-info pt-3 pb-3">
            <h1 class="text-center fw-bold">PRODUCTS</h1>
            <div class="mt-3 bg-dark mx-auto rounded" style="height: 3px;width: 75px"></div>
            <div class="grid mx-3 mt-4">
                <div class="row row-gap-4">
                    @foreach ($products as $item)
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="card bg-white w-100 h-100 d-flex flex-column">
                                <img class="rounded" src="{{ asset($item->image) }}"
                                    style="max-height: 350px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between my-2">
                                        <p class="card-title fw-bold my-auto" style="font-size: 24px">
                                            {{ $item->name }}
                                        </p>
                                        @if ($item->condition == 'Baru')
                                            <p class="my-auto rounded py-1 bg-success px-2 fw-semibold"
                                                style="font-size: 16px">{{ $item->condition }}
                                            </p>
                                        @else
                                            <p class="my-auto rounded py-1 bg-warning px-2 fw-semibold"
                                                style="font-size: 16px">{{ $item->condition }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between my-2">
                                        <p class="my-auto rounded py-1 bg-success px-2 text-white fw-semibold"
                                            style="font-size: 16px">{{ $item->stock }}
                                        </p>
                                        <p class="my-auto rounded py-1 bg-info px-2 fw-semibold" style="font-size: 16px">Rp.
                                            {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                        <p class="my-auto rounded py-1 bg-secondary text-white px-2 fw-semibold"
                                            style="font-size: 16px">{{ $item->weight }} gr
                                        </p>
                                    </div>
                                    <p class="flex-grow-1"
                                        style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        {{ $item->description }}
                                    </p>
                                    <a href="{{ route('login') }}" class="btn btn-primary my-auto">Pesan Sekarang</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
