{{-- <a href="{{ $edit_url }}">Ubah</a> --}}

{{-- {!! Form::model($model, ['url' => $form_url, 'method' => 'delete', 'class' => 'form-inline']) !!} --}}
{!! Form::model($model, ['url' => $form_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message] ) !!}
    <a class="btn btn-outline-secondary btn-sm" href="{{ $edit_url }}">Ubah</a>
    {!! Form::submit('Hapus', ['class'=>'btn btn-danger btn-sm']) !!}
{!! Form::close()!!}