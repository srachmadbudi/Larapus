@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li class="active"><a class="nav-link" href="{{ url('/home') }}">Dashboard</a></li>
          <li class="active nav-link">Penulis</li>
        </ul>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Penulis</h2>
            </div>
          
            <div class="card-body">
                {{-- Diisi dengan DataTable --}}
                {!! $html->table(['class'=>'table-striped']) !!}
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection 

{{-- @section('scripts')
  {!! $html->scripts() !!}
@endsection --}}
