@extends('layout/main')

@section('title' , 'Daftar Buku')


@section('container')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-3">Daftar Buku</h1>
            <p class="lead">Berikut merupakan daftar buku yang tersedia pada perpustakaan <br> Universitas Brawijaya
                Malang : </p>

            <a href="/books/create" class="btn btn-success my-3">Tambah Buku</a>

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif


            <ul class="list-group mt-3">
                @foreach ($book as $bk)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{$bk->judul}}
                    <figcaption class="blockquote-footer mt-1">
                        {{$bk->penulis}} <cite title="Source Title">{{$bk->penerbit}}</cite>
                        <a href="/books/{{$bk->id}}" class="badge bg-info text-dark">Detail</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection