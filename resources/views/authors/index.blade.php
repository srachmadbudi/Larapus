@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            {{-- <li class="active"><a class="nav-link" href="{{ url('/home') }}">Dashboard</a></li>
            <li class="active nav-link">Penulis</li> --}}
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Penulis</li>
          </ol>
        </nav>

        <div class="card">
          <div class="card-header">
              <h3 class="card-title">Penulis</h3>
          </div>
         
          <div class="card-body">
            <p> <a class="btn btn-primary" href="{{ route('authors.create') }}">Tambah</a> </p>

            {{-- Diisi dengan DataTable --}}
            {!! $html->table(['id'=>'author_table','class'=>'table table-borderless table-striped'], true) !!}

            {{-- <div class='table-responsive'>  --}}

              {{-- <div class="float-right">
                <form action="/authors/cari" method="GET">
                  <input class="col-md-9 control-label" type="text" name="cari" placeholder="Cari Penulis...." value="{{ old('cari') }}">
                  <input class="btn btn-secondary" type="submit" value="CARI">
                </form>
                <br/>
              </div> --}}

            {{-- <table id="author_table" class="table table-borderless table-striped">
              <thead class="thead">
                <tr>
                  <th scope="col">Nama</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($authors as $auth)
                  <tr>
                    <td>{{ $auth->name}}</td>
                    <td></td>
                  </tr>
                    
                @endforeach
              </tbody>
            </table> --}}

            {{-- <br/>
            Halaman : {{ $authors->currentPage() }} <br/>
            Jumlah Data : {{ $authors->total() }} <br/>
            Data Per Halaman : {{ $authors->perPage() }} <br/>
            {{ $authors->links() }} --}}

            {{-- </div> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
  
@endsection

@section('scripts')

    {!! $html->scripts() !!}
    {{-- <script>
      $(document).ready(function(){
          $('#author_table').dataTable({

          });
      });
    </script> --}}
@endsection
{{-- @push('scripts')
<script>
  $(document).ready(function()){
    $('#author_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: "{{ route('authors.index') }}",
      },
      columns: [
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false
        }
      ]
    });
  });
</script>
@endpush --}}