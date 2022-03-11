@extends('dashboard.layouts.master')

@section('content')

<div class="container pt-5">

    <div>
        <span class="dashboard_heading">Monitoreo de Pacientes en Cuarentena</span>
        <p class="text1">Verifica que los pacientes aislados  estén cumpliendo con su cuarentena por COVID-19</p>
    </div>
    <div class="mt-5">
        <span class="dashboard_heading1">Notificaciones</span>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card notification_card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="notification_li list-group-item">
                                <i class="fa-solid fa-exclamation-triangle "></i> 
                                <b style="font-size: 20px;">Juan Carlos García Muñoz</b>
                                <span style="font-size: 20px; font-weight: 100;">de la Región de la Araucanía ha dejado su lugar de residencia el 21/06/2022</span>
                                <span style="float:right;">
                                    <i class="fa-solid fa-lock" style="margin-right: 10px;"></i> 
                                    <i class="fa-solid fa-times"></i> 
                                </span>
                            </li>
                            <li class="notification_li list-group-item">
                                <i class="fa-solid fa-exclamation-triangle "></i> 
                                <b style="font-size: 20px;">Juan Carlos García Muñoz</b>
                                <span style="font-size: 20px; font-weight: 100;">de la Región de la Araucanía ha dejado su lugar de residencia el 21/06/2022</span>
                                <span style="float:right;">
                                    <i class="fa-solid fa-lock" style="margin-right: 10px;"></i> 
                                    <i class="fa-solid fa-times"></i> 
                                </span>
                            </li>
                            <li class="notification_li list-group-item">
                                <i class="fa-solid fa-exclamation-triangle "></i> 
                                <b style="font-size: 20px;">Juan Carlos García Muñoz</b>
                                <span style="font-size: 20px; font-weight: 100;">de la Región de la Araucanía ha dejado su lugar de residencia el 21/06/2022</span>
                                <span style="float:right;">
                                    <i class="fa-solid fa-lock" style="margin-right: 10px;"></i> 
                                    <i class="fa-solid fa-times"></i> 
                                </span>
                            </li>
                            <li class="notification_li list-group-item">
                                <i class="fa-solid fa-exclamation-triangle "></i> 
                                <b style="font-size: 20px;">Juan Carlos García Muñoz</b>
                                <span style="font-size: 20px; font-weight: 100;">de la Región de la Araucanía ha dejado su lugar de residencia el 21/06/2022</span>
                                <span style="float:right;">
                                    <i class="fa-solid fa-lock" style="margin-right: 10px;"></i> 
                                    <i class="fa-solid fa-times"></i> 
                                </span>
                            </li>
                            <li class="notification_li list-group-item">
                                <i class="fa-solid fa-exclamation-triangle "></i> 
                                <b style="font-size: 20px;">Juan Carlos García Muñoz</b>
                                <span style="font-size: 20px; font-weight: 100;">de la Región de la Araucanía ha dejado su lugar de residencia el 21/06/2022</span>
                                <span style="float:right;">
                                    <i class="fa-solid fa-lock" style="margin-right: 10px;"></i> 
                                    <i class="fa-solid fa-times"></i> 
                                </span>
                            </li>
                            <li class="notification_li list-group-item">
                                <i class="fa-solid fa-exclamation-triangle "></i> 
                                <b style="font-size: 20px;">Juan Carlos García Muñoz</b>
                                <span style="font-size: 20px; font-weight: 100;">de la Región de la Araucanía ha dejado su lugar de residencia el 21/06/2022</span>
                                <span style="float:right;">
                                    <i class="fa-solid fa-lock" style="margin-right: 10px;"></i> 
                                    <i class="fa-solid fa-times"></i> 
                                </span>
                            </li>
                            <li class="notification_li list-group-item">
                                <i class="fa-solid fa-exclamation-triangle "></i> 
                                <b style="font-size: 20px;">Juan Carlos García Muñoz</b>
                                <span style="font-size: 20px; font-weight: 100;">de la Región de la Araucanía ha dejado su lugar de residencia el 21/06/2022</span>
                                <span style="float:right;">
                                    <i class="fa-solid fa-lock" style="margin-right: 10px;"></i> 
                                    <i class="fa-solid fa-times"></i> 
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <div class="row">
            <div class="col-12 col-sm-7 col-md-8 col-lg-8 col-xl-8">
                <span class="dashboard_heading1">Lista de Pacientes en Cuarentena</span>
            </div>

            <div class="col-10 col-sm-4 col-md-3 col-lg-3 col-xl-3">
                <div class="input-group mb-3">
                    <input class="input_css form-control">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">
                            <!-- <i class="fa-solid fa-eye-slash"></i> -->
                            <span class="fa-solid fa-search"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-2 col-sm-1 col-md-1 col-lg-1 col-xl-1 setting">
                <i class="fa-solid fa-sliders setting_icon"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="table">
                    <thead>
                        <tr class="table_tr">
                            <th scope="col">Nombre</th>
                            <th scope="col">Residencia</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table_b_tr">
                            <td>María Isabel Berríos</td>
                            <td>Los maitenes 2265, Villarrica, región de la Araucanía</td>
                            <td><span class="red_dot"></span> No cumple</td>
                            <td>
                                <i class="fa-solid fa-unlock"></i>
                            </td>
                        </tr>
                        <tr class="table_b_tr" style="background:#EEF7F9;">
                            <td>Pablo Fuentes Romero</td>
                            <td>Santa Marta 157 dpto. 1402 Santiago, región Metro...</td>
                            <td><span class="green_dot"></span> Cumple</td>
                            <td>
                                <i class="fa-solid fa-lock"></i>
                            </td>
                        </tr>
                        <tr class="table_b_tr">
                            <td>Angélica Moya Galdames</td>
                            <td>Rosa Elvira 2541 Villa Esperanza, Graneros, región de...</td>
                            <td><span class="red_dot"></span> No cumple</td>
                            <td>
                                <i class="fa-solid fa-unlock"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection