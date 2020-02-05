@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/authors') }}">Penulis</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Penulis</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Penulis</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => route('authors.store'), 'method' => 'post', 'class'=>'form-horizontal']) !!} 
                        @include('authors._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
