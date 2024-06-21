@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-dark fw-bolder">TAMBAH BARANG</h1>
        <form action="POST" href="">
            <div class="row">
                <div class="col-md-4">
                    <label for="item_code" class="col-md-4 col-form-label text-md-end">
                        {{ __('KODE BARANG') }}
                    </label>
                    
                </div>

            </div>
        </form>
    </div>
@endsection
