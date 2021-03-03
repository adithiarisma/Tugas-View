@extends('layout/main')

@section('title' , 'Edit Buku')


@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
            <h1 class="mt-3">Edit Buku</h1>

            <form method="post" action="/books/{{$book->id}}">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="judul">Judul Buku</label>
                    <input type="text" class="form-control" id="judul" placeholder="Masukkan judul buku" name="judul"
                        value="{{$book->judul}}" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="penulis">Penulis Buku</label>
                    <input type="text" class="form-control" id="penulis" placeholder="Masukkan penulis buku"
                        name="penulis" value="{{$book->penulis}}" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="penerbit">Penerbit Buku</label>
                    <input type="text" class="form-control" id="penerbit" placeholder="Masukkan penerbit buku"
                        name="penerbit" value="{{$book->penerbit}}" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="tahun">Tahun Rilis Buku</label>
                    <input type="tahun" class="form-control" id="tahun" placeholder="Masukkan tahun rilis buku"
                        name="tahun" value="{{$book->tahun}}" required>
                </div>
                <br>
                <button type="submit" class="brn btn-success">Edit Buku</button>
            </form>


        </div>
    </div>
</div>
@endsection