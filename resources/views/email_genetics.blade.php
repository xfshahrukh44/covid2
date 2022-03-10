@extends('layouts.app')

@section('content')

<div class="container pt-5">

<div class="row">
        <div class="col-12 col-sm-12 col-md-2 col-lg-3 col-xl-3"></div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6">
            <div class="">
                <div class="card-body text-center">
                    <div>
                        <img src="{{asset('dashboard/Group78.png')}}" class="w-25 card-img-top" alt="...">
                    </div>
                    <div class="mt-4">
                        <span class="heading_1">Te damos la bienvenida al Sistema</span>
                    </div>
                    <div class="mb-3">
                        <span class="heading_1">Automático de trazabilidad</span>
                    </div>
                </div>
                <ul class="list-group list-group-flush" style="padding-left: 30px;">
                    <li class="list-group-item border-bottom-0">
                        <p class="text-center" style="font-size: 14px;">
                            Estimada <b>Renata</b>, a raíz del resultado <b>POSITIVO</b>  de tu PCR realizado en 
                            el Aeropuerto de Santiago a tu llegada a Chile, te informamos que debes 
                            descargar la aplicación del <b>Sistema Automático de Trazabilidad (SAT)</b>
                            para dar seguimiento al cumplimiento de tu cuarentena. Allí deberás 
                            declarar la residencia en donde te aislarás, e informar diariamente tu
                            permanencia en ella.
                        </p>
                    </li>
                    <li class="list-group-item border-bottom-0 text-center">
                        <img src="{{asset('dashboard/Image7.png')}}" class="w-25 card-img-top" alt="...">
                    </li>
                    <li class="list-group-item border-bottom-0 text-center">
                        <div class="card mb-3" style="background: #F8F8F8;border: 0;padding: 13px 0 0 0;">
                            <div class="row g-0">
                                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mt-4">
                                    <img src="{{asset('dashboard/Image6.png')}}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 mt-1">
                                    <div class="card-body">
                                        <p class="text-start">Recuerda que el no cumplimiento de tu cuarentena puede resultar en la inhabilitación indefinida de tu pase de movilidad y en sanciones por parte de las autoridades.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-3 col-sm-3 col-md-2 col-lg-3 col-xl-3"></div>
    </div>

</div>

@endsection