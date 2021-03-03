@extends('layout/main')

@section('title' , 'Tambah Buku')


@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
            <h1 class="mt-3">Tambah Buku</h1>

            <form method="post" action="/books">
                @csrf
                <div class="form-group">
                    <label for="judul">Judul Buku</label>ƒ
                    <input type="text" class="form-control" id="judul" placeholder="Masukkan judul buku" name="judul"
                        required>
                </div>
                <br>
                <div class="form-group">
                    <label for="penulis">Penulis Buku</label>
                    <input type="text" class="form-control" id="penulis" placeholder="Masukkan penulis buku"
                        name="penulis" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="penerbit">Penerbit Buku</label>
                    <input type="text" class="form-control" id="penerbit" placeholder="Masukkan penerbit buku"
                        name="penerbit" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="tahun">Tahun Rilis Buku</label>
                    <input type="tahun" class="form-control" id="tahun" placeholder="Masukkan tahun rilis buku"
                        name="tahun" required>
                </div>
                <br>
                <button type="submit" class="btn btn-success">Tambah Buku</button>
            </form>


        </div>
    </div>
</div>
@endsection