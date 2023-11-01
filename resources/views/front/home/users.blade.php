@extends('layouts.myapp')
@section('content')

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <form action="{{ route('get.users', ["filter" => "filter"]) }}">
                <div class="row mb-3">
                    <div class="col-md-4">
                        Dan
                        <input type="date" name="from" class="form-control" value="@php if(!empty($_GET['from'])){ echo $_GET['from']; } @endphp">
                    </div>
                    <div class="col-md-4">
                        Gacha
                        <input type="date" name="to" class="form-control" value="@php if(!empty($_GET['to'])){ echo $_GET['to']; } @endphp">
                    </div>
                    <div class="col-md-4">
                        <br>
                        <input type="submit" class="btn btn-primary w-100" value="Qidirish">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Foydanaluvchilar</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th class="width80"><strong>#</strong></th>
                                            <th><strong>Ism Familiya</strong></th>
                                            <th><strong>Telefon raqam</strong></th>
                                            <th><strong>Rol</strong></th>
                                            <th>Jarayon</th>
                                            <th>Ro'yxatdan o'tgan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td><strong>{{ $item->id }}</strong></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->phone_number }}</td>
                                                <td>
                                                    @if ($item->role == "admin") <span class="badge light badge-info">Admin</span>
                                                    @elseif ($item->role == "seller") <span class="badge light badge-warning">Sotuvchi</span>
                                                    @elseif ($item->role == "manager") <span class="badge light badge-light">Boshqaruvchi</span>
                                                    @elseif ($item->role == "controller") <span class="badge light badge-danger">Nazoratchi</span>
                                                    @elseif ($item->role == "client") <span class="badge light badge-success">Mijoz</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ date('d.m.Y', strtotime($item->created_at)) }}
                                                    {{--
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Tahrirlash</a>
                                                            <a class="dropdown-item" href="#">O'chirish</a>
                                                        </div>
                                                    </div>
                                                    --}}
                                                </td>
                                                <td>
                                                    @if (auth()->user()->role == "admin")
                                                        <form action="{{ route('user.delete') }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="delete_id" value="{{ $item->id }}">
                                                            <button type="submit" class="btn btn-danger light sharp">
                                                                O'chirish
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $users->links() }}
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
