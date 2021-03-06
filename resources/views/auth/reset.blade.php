@extends('layouts.master')

@section('page_title', 'Restablecer contraseña')

@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('#reset-button').on('click', function () {
            var $btn = $(this).button('loading');
        });
    });
</script>
@endsection

@section('content')
{!! Breadcrumbs::render('home') !!}

<h2>Restablecer contraseña</h2>
<p>Introduce los datos solicitados, recuerda anotar tu contraseña en algún lugar seguro.</p>

<hr>

<div class="row">
    <div class="col-md-12">
        <div class="well">
            {!! Form::open(['url' => '/password/reset']) !!}
                {!! Form::hidden('token', $token) !!}

                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    {!! Form::label('email', 'Correo', ['class' => 'control-label']) !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('email'))
                    <span class="help-block">* {{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->has('password')) has-error @endif">
                    {!! Form::label('password', 'Contraseña', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    @if ($errors->has('password'))
                    <span class="help-block">* {{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->has('password')) has-error @endif">
                    {!! Form::label('password', 'Confirmar Contraseña', ['class' => 'control-label']) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    @if ($errors->has('password'))
                    <span class="help-block">* {{ $errors->first('password') }}</span>
                    @endif
                </div>

                <br>
                {!! Form::button('Restablecer', [
                    'class'             => 'btn btn-lg btn-primary btn-block',
                    'type'              => 'submit',
                    'data-loading-text' => '<i class="fa fa-cog fa-spin"></i> Enviando...',
                    'id'                => 'reset-button'
                ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
