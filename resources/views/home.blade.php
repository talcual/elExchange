@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inicio') }}</div>

                <div class="card-body">

                    <p>
                        Bienvenido al el portal "elExchange" donde podras conocer el estado cambiario de las divisias que te interesan.
                    </p>

                    <div class="row">
                        <!-- <div class="col-6 my-1">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Convertidor</h5>
                                    <p class="card-text">Deseas conocer el cambio de tu moneda.</p>
                                    <a href="#" class="btn btn-primary">Ir al Convertidor</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 my-1">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Historial</h5>
                                    <p class="card-text">Historial de conversiones.</p>
                                    <a href="#" class="btn btn-primary">Ir al historial</a>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-6 my-1">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Monitor</h5>
                                    <p class="card-text">Setup del Monitor de divisas.</p>
                                    <a href="/monitor" class="btn btn-primary">Ir al Monitor</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
