@extends('layouts.plantilla_login')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top: 100px">
            <div class="panel">
                <div class="panel-body">
                    <h3 class="text-center titulo">Sistema <br> Gestor de Camas</h3>
                    <p class="info">
                        Ingresa tus credenciales para poder acceder al sistema.
                    </p>

                    @if (session('deny'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('deny') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                                <input placeholder="Usuario" id="email" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus aria-describedby="basic-addon1">
                            </div>
                            @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon2"><i class="fa fa-key"></i></span>
                                    <input placeholder="Clave" id="password" type="password" class="form-control" name="password" required aria-describedby="basic-addon2">
                                </div>
                                @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>



                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">
                                Ingresar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(function(){
            const form = $('form');
            const loading = $('.loading');

            form.on('submit', function(){
                loading.removeClass('hidden');
            });
        });
    </script>
@endpush
