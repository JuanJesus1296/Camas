@extends('layouts.plantilla_login')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
@endpush

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <h2 class="titulosanna text-center">Seleccione una pantalla</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top: -50px; margin-left: 15px;">

            <div class="panel" style="width: 180%">
                <div class="panel-body">




                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @php $c = 0 @endphp
                          @foreach($equipos as $equipo)
                            @if($c < 1)
                            <div class="carousel-item active">
                          <img src="{{ asset('images/televisor_espera.png') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                            <a type="button" class="btn btn-success" href="{{ route('pantalla.view', ['id' => $equipo->id]) }}" style="font-size: 200%">{{$equipo->name}}</a>
                            </div>
                          </div>
                          @php $c++ @endphp
                          @else
                          <div class="carousel-item">
                            <img src="{{ asset('images/televisor_espera.png') }}" class="d-block w-100" alt="...">
                              <div class="carousel-caption d-none d-md-block">
                                <a type="button" class="btn btn-success" href="{{ route('pantalla.view', ['id' => $equipo->id]) }}" style="font-size: 200%">{{$equipo->name}}</a>
                              </div>
                            </div>
                          @endif
                        @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>





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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
@endpush
