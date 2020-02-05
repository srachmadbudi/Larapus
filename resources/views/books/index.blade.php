@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Buku</li>
                </ul>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Buku</h3>
                    </div>
                    <div class="card-body">
                        <p> <a class="btn btn-primary" href="{{ url('/admin/books/create') }}">Tambah</a></p>
                        {!! $html->table(['id'=>'book_table','class'=>'table-striped'], true) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
  {!! $html->scripts() !!}
@endsection
