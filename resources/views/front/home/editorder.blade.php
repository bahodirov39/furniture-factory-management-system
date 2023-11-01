@extends('layouts.myapp')
@section('content')

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="form-head d-flex mb-3 mb-md-4 align-items-start">
                {{--
                <div class="input-group search-area ml-auto d-inline-flex">
                    <input type="text" class="form-control" placeholder="Search here">
                    <div class="input-group-append">
                        <button type="button" class="input-group-text"><i class="flaticon-381-search-2"></i></button>
                    </div>
                </div>
                <a href="javascript:void(0);" class="settings-icon  ml-3"><i class="flaticon-381-settings-2 mr-0"></i></a>
                 --}}
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Buyurtmani tahrirlash</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('order.update', ['id'=>$order->id]) }}" method="POST" enctype="multipart/form-data" id="step-form-horizontal" class="step-form-horizontal">
                                @csrf
                                @method('PUT')
                                <div>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Mijoz</label>
                                                    <br>
                                                    <select name="client_id" class="form-control" id="inlineFormCustomSelect">
                                                            <option selected disabled>Tanlang...</option>
                                                        @foreach ($users as $item)
                                                            <option value="{{ $item->id }}" @if($item->id == $order->user_id) selected @endif>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Eshik soni</label>
                                                    <input type="number" name="doorNumber" value="{{ $order->door_number }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Eshik turi</label>
                                                    <input type="text" name="doorType" value="{{ $order->door_type }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Umumiy summa</label>
                                                    <input type="text" name="allMoney" value="{{ $order->all_money }}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label text-success">To'lovlar orasidagi farq</label>
                                                    <input type="text" name="allMoney" value="{{ $order->all_money - $order->given_money }} so'm" class="form-control" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Berilgan summa</label>
                                                    <input type="text" name="givenMoney" value="{{ $order->given_money }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Yakunlash muddati</label>
                                                    <input type="date" name="finishAt" value="{{ date('Y-m-d', strtotime($order->finish_at)) }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="image" class="custom-file-input">
                                                            <label class="custom-file-label">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Qo'shimcha ma'lumotlar</label>
                                                    <input type="text" name="description" value="{{ $order->description }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Tahrirlash</button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </form>
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
