@extends('layouts.myapp')
@section('content')

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <form action="{{ route('index', ['list_status'=>'search']) }}" method="GET">
                <div class="form-head d-flex mb-3 mb-md-4 align-items-start">
                    <div class="input-group search-area ml-auto d-inline-flex">
                        <input type="text" class="form-control" name="search" placeholder="Qidirish...">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text"><i class="flaticon-381-search-2"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-xl-3 col-xxl-6 col-sm-6">
                    <a href="{{ route('index') }}">
                        <div class="card gradient-bx text-white bg-secondary rounded">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <p class="mb-1">Barchasi</p>
                                        <div class="d-flex flex-wrap">
                                            <h2 class="fs-40 font-w600 text-white mb-0 mr-3">{{ $all }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-xxl-6 col-sm-6">
                    <a href="{{ route('index', ['list_status'=>"new"]) }}">
                        <div class="card gradient-bx text-white bg-success rounded">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <p class="mb-1">Yangi</p>
                                        <div class="d-flex flex-wrap">
                                            <h2 class="fs-40 font-w600 text-white mb-0 mr-3">{{ $new }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-xxl-6 col-sm-6">
                    <a href="{{ route('index', ['list_status'=>"in_process"]) }}">
                        <div class="card gradient-bx text-white bg-info rounded">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <p class="mb-1">Jarayonda</p>
                                        <div class="d-flex flex-wrap">
                                            <h2 class="fs-40 font-w600 text-white mb-0 mr-3">{{ $in_process }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-xxl-6 col-sm-6">
                    <a href="{{ route('index', ['list_status'=>"finished"]) }}">
                        <div class="card gradient-bx text-white bg-danger rounded">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <p class="mb-1">Tugatilganlar</p>
                                        <div class="d-flex flex-wrap">
                                            <h2 class="fs-40 font-w600 text-white mb-0 mr-3">{{ $finished }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{--
                <div class="col-xl-3 col-xxl-4 col-lg-4">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h3 class="fs-20 mb-0 text-black">Revenue</h3>
                            <div class="dropdown d-inline-block">
                                <div class="btn-link text-primary dropdown-toggle mb-0 fs-14 text-primary" data-toggle="dropdown">
                                    <span class="font-w500">2020</span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-left">
                                    <a class="dropdown-item" href="javascript:void(0);">2019</a>
                                    <a class="dropdown-item" href="javascript:void(0);">2018</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <span class="text-info fs-26 font-w600 mr-3">$41,512k</span>
                                <span class="text-secondary fs-18 font-w400">$25,612k</span>
                            </div>
                            <div id="line-chart"></div>
                        </div>
                    </div>
                </div>
                --}}
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">So'nggi harakatlar</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th class="width80"><strong>#</strong></th>
                                            <th><strong>Ism Familiya</strong></th>
                                            <th><strong>Telefon raqam</strong></th>
                                            <th><strong>Eshiklar soni</strong></th>
                                            <th><strong>Narxi</strong></th>
                                            <th><strong>To'langan</strong></th>
                                            <th>@if (auth()->user()->role == "admin") Jarayon @endif</th>
                                            <th>Holat</th>
                                            <th><strong>Kiritildi</strong></th>
                                            <th><strong>Tugashi kerak</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $item)

                                            @php
                                                $diff = strtotime($item->created_at) - strtotime($item->finish_at);
                                                $time = abs(round($diff / 86400));
                                            @endphp

                                            <tr>
                                                <td><strong>{{ $item->id }}</strong></td>
                                                <td><a href="{{ route('order.view', ['id'=>$item->id]) }}">{{ $item->user_name }}</a></td>
                                                <td>{{ $item->phone_number }}</td>
                                                <td>{{ $item->door_number }}</td>
                                                <td><span class="badge light badge-success">{{ $item->all_money }} so'm</span></td>
                                                @if ($item->all_money === $item->given_money)
                                                    <td><span class="badge light badge-danger">100% to'langan</span></td>
                                                @else
                                                    <td><span class="badge light badge-info">{{ $item->given_money }} so'm</span></td>
                                                @endif
                                                <td>
                                                    @if (auth()->user()->role == "admin")
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('order.edit', ['id'=>$item->id]) }}">Tahrirlash</a>
                                                                <a class="dropdown-item" href="javascript:;" onclick="document.getElementById('deleteOrder').submit();">O'chirish</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <form action="{{ route('order.delete') }}" id="deleteOrder" method="POST" style="display: none;">
                                                    {{csrf_field()}}
                                                    {{ method_field('DELETE') }}
                                                    <input type="hidden" name="delete_id" value="{{ $item->id }}" name="id">
                                               </form>
                                                <td>
                                                    <form action="{{ route('change.status', ['status_id'=>$item->id]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" onchange="this.form.submit()" class="form-control" id="inlineFormCustomSelect" @if (auth()->user()->role == "client" || auth()->user()->role == "seller") disabled @endif>
                                                            @foreach ($status as $item2)
                                                                @if (auth()->user()->role == "controller")
                                                                    @if ($item2->id != 1)
                                                                        <option value="{{ $item2->id }}" @if($item->status_id == $item2->id) selected @endif>{{ $item2->status }}</option>
                                                                    @endif
                                                                @else
                                                                    <option value="{{ $item2->id }}" @if($item->status_id == $item2->id) selected @endif>{{ $item2->status }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>{{ date('d.m.Y', strtotime($item->created_at)) }}</td>
                                                <td>{{ date('d.m.Y', strtotime($item->finish_at)) }} ({{ $time }})</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
