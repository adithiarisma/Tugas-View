@extends('layout/main')

@section('title' , 'Detail Buku')


@section('container')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-3">Detail Buku</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$book->judul}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$book->penulis}}</h6>
                    <p class="card-subtitle mb-2 text-muted">{{$book->penerbit}}</p>
                    <p class="card-subtitle mb-2 text-muted">{{$book->tahun}}</p>
                    <a href="{{$book->id}}/edit" class="btn btn-primary">Edit</a>
                    <form action="{{$book->id}}" method=post class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="/books" class="btn btn-success">Kembali</a>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection