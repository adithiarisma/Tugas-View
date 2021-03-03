@extends('layout/main')

<link rel="stylesheet" type="text/css" href="{!! asset('assets/css/master.css') !!}">

@section('title' , 'Perpustakaan UB')

@section('container')
<br>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-4"> DAFTAR BUKU PERPUSTAKAAN <br> <span class="font-weight-bold">Bacalah buku
                            untuk membangun negeri</span></h1>
                    <hr class="my-4">
                    <p class="lead">Website ini menyediakan daftar buku yang terdapat pada perpustakaan</p>
                    <a class="btn btn-primary btn-lg font-weight-bold" href="/books" role="button">Kunjungi</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection