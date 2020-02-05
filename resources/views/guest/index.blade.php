@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Buku</h2>
                </div>

                <div class="card-body">
                    {!! $html->table(['id'=>'book_table','class'=>'table-striped']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    {!! $html->scripts() !!}
@endsection