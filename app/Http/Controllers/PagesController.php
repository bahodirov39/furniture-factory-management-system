<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Order;
use App\Models\Process;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(Request $request, $list_status = null, $search = null)
    {
        $new = Order::where('status_id', 1)->count();
        $in_process = Order::where([['status_id', '!=', 1],['status_id', '!=', 8]])->count();
        $finished = Order::where('status_id', 8)->count();
        $all = Order::count();

        $status = Process::orderBy('id', 'ASC')->get();

        if ($list_status == "search") {
            $order = Order::select(
                DB::raw("orders.*"),
                DB::raw("users.name as user_name"),
                DB::raw("users.phone_number as phone_number")
            )->where('users.name', 'like', '%' . $request->search . '%')
            ->orWhere('users.phone_number', 'like', '%' . $request->search . '%')
            ->orWhere('orders.all_money', 'like', '%' . $request->search . '%')
            ->orWhere('orders.given_money', 'like', '%' . $request->search . '%')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->get();

            $compact = compact('new', 'in_process', 'finished', 'order', 'all', 'status');
            return view('front.home.index', $compact);
        }

        $who_is = auth()->user()->role;
        if ($who_is == 'manager') {
            $condition = "=";
        }elseif ($who_is == 'controller') {
            $condition = "<>";
        }

        if (auth()->user()->role == "manager" || auth()->user()->role == "controller") {
            if (isset($list_status) && $list_status == "new") {
                $order = Order::select(
                    DB::raw("orders.*"),
                    DB::raw("users.name as user_name"),
                    DB::raw("users.phone_number as phone_number")
                )
                ->where('orders.status_id', 1)
                ->where("orders.status_id", $condition, 1)
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->orderBy('orders.id', 'DESC')
                ->paginate(120);
            }elseif (isset($list_status) && $list_status == "in_process") {
                $order = Order::select(
                    DB::raw("orders.*"),
                    DB::raw("users.name as user_name"),
                    DB::raw("users.phone_number as phone_number")
                )
                ->where([['orders.status_id', '!=', 1],['orders.status_id', '!=', 8]])
                ->where("orders.status_id", $condition, 1)
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->orderBy('orders.id', 'DESC')
                ->paginate(120);
            }elseif (isset($list_status) && $list_status == "finished") {
                $order = Order::select(
                    DB::raw("orders.*"),
                    DB::raw("users.name as user_name"),
                    DB::raw("users.phone_number as phone_number")
                )
                ->where('orders.status_id', 8)
                ->where("orders.status_id", $condition, 1)
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->orderBy('orders.id', 'DESC')
                ->paginate(120);
            }else{
                $order = Order::select(
                    DB::raw("orders.*"),
                    DB::raw("users.name as user_name"),
                    DB::raw("users.phone_number as phone_number")
                )
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->orderBy('orders.id', 'DESC')
                ->paginate(120);
            }
        }else{
            if (isset($list_status) && $list_status == "new") {
                $order = Order::select(
                    DB::raw("orders.*"),
                    DB::raw("users.name as user_name"),
                    DB::raw("users.phone_number as phone_number")
                )
                ->where('orders.status_id', 1)
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->orderBy('orders.id', 'DESC')
                ->paginate(120);
            }elseif (isset($list_status) && $list_status == "in_process") {
                $order = Order::select(
                    DB::raw("orders.*"),
                    DB::raw("users.name as user_name"),
                    DB::raw("users.phone_number as phone_number")
                )
                ->where([['orders.status_id', '!=', 1],['orders.status_id', '!=', 8]])
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->orderBy('orders.id', 'DESC')
                ->paginate(120);
            }elseif (isset($list_status) && $list_status == "finished") {
                $order = Order::select(
                    DB::raw("orders.*"),
                    DB::raw("users.name as user_name"),
                    DB::raw("users.phone_number as phone_number")
                )
                ->where('orders.status_id', 8)
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->orderBy('orders.id', 'DESC')
                ->paginate(120);
            }else{
                $order = Order::select(
                    DB::raw("orders.*"),
                    DB::raw("users.name as user_name"),
                    DB::raw("users.phone_number as phone_number")
                )
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->orderBy('orders.id', 'DESC')
                ->paginate(120);
            }
        }



        /*
        if (auth()->user()->role == "manager") {
            $order = Order::select(
                DB::raw("orders.*"),
                DB::raw("users.name as user_name"),
                DB::raw("users.phone_number as phone_number")
            )
            ->where('orders.status_id', 1)
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->orderBy('orders.id', 'DESC')
            ->paginate(120);
        }

        if (auth()->user()->role == "controller") {
            $order = Order::select(
                DB::raw("orders.*"),
                DB::raw("users.name as user_name"),
                DB::raw("users.phone_number as phone_number")
            )
            ->where('orders.status_id', '<>', 1)
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->orderBy('orders.id', 'DESC')
            ->paginate(120);
        }*/

        $compact = compact('new', 'in_process', 'finished', 'order', 'all', 'status');
        return view('front.home.index', $compact);

    }

    public function order()
    {
        $users = User::where('role', 'client')->orderBy('id', 'DESC')->get();
        $sellers = User::where('role', 'seller')->orderBy('id', 'DESC')->get();
        $compact = compact('users', 'sellers');
        return view('front.home.adduser', $compact);
    }

    public function viewOrder($id)
    {
        $users = User::where('role', 'client')->orderBy('id', 'DESC')->get();
        $status = Process::orderBy('id', 'ASC')->get();

        $order = Order::select(
            DB::raw("orders.*"),
            DB::raw("users.id as user_id"),
            DB::raw("users.name as user_name"),
            DB::raw("users.phone_number as phone_number"),
            DB::raw("users.created_at as user_created_at")
        )
        ->where('orders.id', $id)
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->first();

        $first_timeline = Process::orderBy('id', 'ASC')->limit(1)->first();

        $orderPerUser = Order::where('user_id', $order->user_id)->count();

        return view('front.home.view', compact('order', 'users', 'status', 'first_timeline', 'orderPerUser'));
    }

    public function redirect()
    {
        return redirect()->route('login');
    }

    public function getArchives(Request $request, $list_status = null, $search = null)
    {
        $status = Process::orderBy('id', 'ASC')->get();

        if ($list_status == "search") {
            $order = Archive::select(
                DB::raw("archives.*"),
                DB::raw("users.name as user_name"),
                DB::raw("users.phone_number as phone_number")
            )->where('users.name', 'like', '%' . $request->search . '%')
            ->orWhere('users.phone_number', 'like', '%' . $request->search . '%')
            ->orWhere('archives.all_money', 'like', '%' . $request->search . '%')
            ->orWhere('archives.given_money', 'like', '%' . $request->search . '%')
            ->join('users', 'users.id', '=', 'archives.user_id')
            ->get();

            $compact = compact('order', 'status');
            return view('front.home.archives', $compact);
        }

        $order = Archive::select(
            DB::raw("archives.*"),
            DB::raw("users.name as user_name"),
            DB::raw("users.phone_number as phone_number")
        )
        ->join('users', 'users.id', '=', 'archives.user_id')
        ->orderBy('archives.id', 'DESC')
        ->paginate(120);

        $compact = compact('order', 'status');
        return view('front.home.archives', $compact);
    }
}
