@extends('layout/main')

@section('title' , 'About Us')


@section('container')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-3">Contact Us</h1>

            <form method="post" action="/books">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan nama anda" name="nama"
                        required>
                </div>
                <br>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Masukkan email anda" name="email"
                        required>
                </div>
                <br>
                <div class="form-group">
                    <label for="pesan">Pesan</label>
                    <textarea type="text" class="form-control" id="pesan" placeholder="Masukkan pesan" name="pesan"
                        required></textarea>
                </div>

                <br>
                <button type="submit" class="btn btn-success" disabled>Kirim Pesan</button>
            </form>

        </div>
    </div>
</div>
@endsection