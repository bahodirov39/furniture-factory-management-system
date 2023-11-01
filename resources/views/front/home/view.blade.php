@extends('layouts.myapp')
@section('content')

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card mt-3">
                        <div class="card-header"> Buyurtma <strong>ID - {{ $order->id }}</strong> <span class="float-right">
                            <form action="{{ route('change.status', ['status_id'=>$order->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" @if (auth()->user()->role == "client" || auth()->user()->role == "seller") disabled @endif
                                class="form-control" id="inlineFormCustomSelect">
                                    @foreach ($status as $item2)
                                        @if (auth()->user()->role == "controller")
                                            @if ($item2->id != 1)
                                                <option value="{{ $item2->id }}" @if($order->status_id == $item2->id) selected @endif>{{ $item2->status }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $item2->id }}" @if($order->status_id == $item2->id) selected @endif>{{ $item2->status }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </form>
                        </span> </div>
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <h6>Buyurtmachi:</h6>
                                    <div> <strong>Nomi: </strong> {{ $order->user_name }} </div>
                                    <div>ID: {{ $order->user_id }}</div>
                                    <div>Telefon raqam: <a href="tel:{{ $order->phone_number }}"></a> {{ $order->phone_number }}</div>
                                    <div>Ro'yxatdan o'tgan: {{ date('d.m.Y', strtotime($order->created_at)) }}</div>
                                    <div>Buyurtmalar soni: {{ $orderPerUser }}</div>

                                    <div> <img src="https://apirone.com/static/promo/bitcoin_logo_vector.svg" class="img-fluid mb-3 height30" alt=""><br>
                                        <span><strong>Buyurtmaga izoh:</strong><br>
                                        <small class="text-muted">
                                            @if (empty($order->description))
                                            Izoh mavjud emas.
                                            @else
                                            {{ $order->description }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <h6>Bajaruvchi:</h6>
                                    <div> <strong>Mebel zavod</strong> </div>

                                    <div> <br>
                                        <span><strong>Buyurtmaga ilova:</strong><br>
                                        <small class="text-muted">
                                            @if (empty($order->file))
                                            Ilova mavjud emas.
                                            @else
                                            <a href="{{ asset('images/'.$order->file) }}" target="_blank"> <u> Ilovani ko'rish </u> </a>
                                            @endif
                                        </small>
                                    </div>

                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
                                    <table class="table table-clear">
                                        <tbody>
                                            <tr>
                                                <td class="left"><strong>Umumiy to'lov</strong></td>
                                                <td class="right">{{ $order->all_money }} so'm</td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>To'lov qilindi</strong></td>
                                                <td class="right">{{ $order->given_money }} so'm</td>
                                            </tr>
                                            @php
                                                $remainder = $order->all_money - $order->given_money;
                                            @endphp
                                            <tr>
                                                <td class="left"><strong>To'lov qilish kerak</strong></td>
                                                @if ($order->all_money == $order->given_money)
                                                    <td class="right text-success">100% to'langan</td>
                                                @else
                                                    <td class="right text-danger">{{ $remainder }} so'm</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Buyurtma holati</strong></td>
                                                <td class="right">
                                                    @foreach ($status as $item2)
                                                        <option value="{{ $item2->id }}" @if($order->status_id == $item2->id) selected @endif>
                                                            {{ $item2->status }}
                                                            @if($order->status_id == $item2->id)
                                                                <i class="fa fa-arrow-down"></i>
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Jarayonlar tarixi</h4>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <video controls autoplay>
                                            <source src="{{ asset('videos/first.mp4') }}" type="video/mp4">
                                            <source src="{{ asset('videos/first.mp4') }}" type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>
                                        {{--
                                            <img src="{{ asset('assets/images/big/img6.jpg') }}" class="img-fluid">
                                        --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="main-timeline">
                                            @foreach ($status as $item)
                                                <div class="timeline">
                                                    <a href="#" class="timeline-content">
                                                        <div class="timeline-icon"
                                                        @if ($item->id == $order->status_id)
                                                        style="background-color: #009B99!important;"
                                                        @endif>
                                                        <i class="fa fa-cog"></i></div>
                                                        <h3 class="title"
                                                        @if ($item->id == $order->status_id)
                                                            style="color: #009B99!important"
                                                        @endif
                                                            >{{ $item->status }}
                                                            @if ($item->id == $order->status_id)
                                                                <i class="fa fa-check-square"></i>
                                                            @endif
                                                        </h3>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

@endsection

@section('styles')
        <style>
            .main-timeline{ font-family: 'Poppins', sans-serif; }
            .main-timeline:after{
                content: '';
                display: block;
                clear: both;
            }
            .main-timeline:before{
                content: '';
                background-color: #000;
                height: 100%;
                width: 4px;
                transform: translateX(-50%);
                position: absolute;
                left: 50%;
                top: 0;
            }
            .main-timeline .timeline{
                width: 50%;
                padding: 50px 0;
                margin: 0 2px 0 0;
                float: left;
            }
            .main-timeline .timeline-content{
                color: #777;
                padding: 0 130px 0 0;
                display: block;
                position: relative;
            }
            .main-timeline .timeline-content:hover{ text-decoration: none; }
            .main-timeline .timeline-content:before{
                content: '';
                background: #fff;
                width: 20px;
                height: 20px;
                border: 3px solid #000;
                border-radius: 50%;
                transform: translateY(-50%);
                position: absolute;
                right: -10px;
                top: 50%;
            }
            .main-timeline .timeline-icon{
                color: #fff;
                background-color: #5CC33A;
                font-size: 35px;
                font-weight: 600;
                text-align: center;
                line-height: 80px;
                height: 100px;
                width: 100px;
                border-radius: 50%;
                border: 10px solid #fff;
                box-shadow: 0 0 10px rgba(0,0,0,0.25);
                transform: translateY(-50%);
                position: absolute;
                top: 50%;
                right: 11px;
                z-index: 1;
            }
            .main-timeline .title{
                color: #5CC33A;;
                font-size: 22px;
                font-weight: 600;
                text-transform: capitalize;
                letter-spacing: 0.5px;
                margin: 0 0 8px;
                text-align: center;
            }
            .main-timeline .description{
                font-size: 14px;
                letter-spacing: 1px;
                line-height: 22px;
                margin: 0;
            }

            @media screen and (max-width:767px){
                .main-timeline:before{
                    transform: translateX(0);
                    left: 23px;
                }
                .main-timeline .timeline,
                .main-timeline .timeline:nth-child(even){
                    width: 100%;
                    margin: 0 0 20px;
                }
                .main-timeline .timeline-content,
                .main-timeline .timeline:nth-child(even) .timeline-content{
                    padding: 0 0 0 150px;
                }
                .main-timeline .timeline-content:before,
                .main-timeline .timeline:nth-child(even) .timeline-content:before{
                    left: 0;
                }
                .main-timeline .timeline-icon,
                .main-timeline .timeline:nth-child(even) .timeline-icon{
                    left: 20px;
                    right: auto;
                }
            }
            @media screen and (max-width:479px){
                .main-timeline .timeline-content,
                .main-timeline .timeline:nth-child(even) .timeline-content{
                    padding: 120px 0 0 25px;
                }
                .main-timeline .timeline-content:before,
                .main-timeline .timeline:nth-child(even) .timeline-content:before{
                    transform: translateY(0);
                    top: 43px;
                }
                .main-timeline .timeline-icon,
                .main-timeline .timeline:nth-child(even) .timeline-icon{
                    transform: translateY(0);
                    top: 0;
                }
            }

        </style>
@endsection
