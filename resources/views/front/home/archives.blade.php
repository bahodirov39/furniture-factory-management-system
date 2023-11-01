@extends('layouts.myapp')
@section('content')

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <form action="{{ route('get.archives', ['list_status'=>'search']) }}" method="GET">
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
                                                <td><strong>{{ $item->order_id }}</strong></td>
                                                <td><a href="javascript:;">{{ $item->user_name }}</a></td>
                                                <td>{{ $item->phone_number }}</td>
                                                <td>
                                                    @if (empty($item->door_number))
                                                        Kiritilmagan
                                                    @else
                                                        {{ $item->door_number }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (empty($item->all_money))
                                                        Kiritilmagan
                                                    @else
                                                        <span class="badge light badge-success">{{ $item->all_money }} so'm</span>
                                                    @endif
                                                </td>
                                                @if ($item->all_money === $item->given_money)
                                                    @if (empty($item->given_money))
                                                        <td>Kiritilmagan</td>
                                                    @else
                                                        <td><span class="badge light badge-danger">100% to'langan</span></td>
                                                    @endif
                                                @else
                                                    <td><span class="badge light badge-info">{{ $item->given_money }} so'm</span></td>
                                                @endif
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
@endsection
