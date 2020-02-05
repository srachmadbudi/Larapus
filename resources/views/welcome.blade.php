@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Halo') }}</div>

                <div class="card-body">
                    Selamat datang di Larapus
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-default">
                <div class="card-header">Halo</div>
                <div class="card-body">
                    Selamat datang di Larapus
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection