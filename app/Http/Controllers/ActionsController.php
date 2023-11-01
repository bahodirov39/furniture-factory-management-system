<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActionsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function addUserAndOrder(Request $request)
    {

        if($request->image){
            /*
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $img = $filename;
            */

            $newImageName = time() . '-' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);

            /*$file = $request->image;
            $name = Str::random(10);
            $url = Storage::putFileAs('images', $file, $name . '.' . $file->extension());
            $newImageName = env('APP_URL') . $url;*/
        }else{
            $newImageName = '';
        }

        if (!empty($request->firstName) && !empty($request->lastName)) {
            // $user_id = User::where('user_id', $request->user_id)->first();

            $email = "test-" . uniqid() . "-email@gmail.com";

            $user = User::create([
                'name' => $request->firstName . " " . $request->lastName,
                'role' => ($request->role) ? $request->role : 'client',
                'phone_number' => $request->phone_number,
                'email' => $email,
                'password' => Hash::make($request->password)
            ]);

            if (!empty($request->allMoney) && !empty($request->doorNumber)) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'seller_id' => ($request->seller_id) ? $request->seller_id : 0,
                    'status_id' => 1,
                    'door_number' => ($request->doorNumber) ? $request->doorNumber : null,
                    'door_type' => ($request->doorType) ? $request->doorType : null,
                    'all_money' => ($request->allMoney) ? $request->allMoney : null,
                    'given_money' => ($request->givenMoney) ? $request->givenMoney : null,
                    'finish_at' => ($request->finishAt) ? $request->finishAt : null,
                    'file' => $newImageName,
                    'description' => ($request->description) ? $request->description : '',
                ]);
            }
        }else{
            if (!empty($request->allMoney) && !empty($request->doorNumber) && !empty($request->client_id)) {
                Order::create([
                    'user_id' => $request->client_id,
                    'seller_id' => ($request->seller_id) ? $request->seller_id : 0,
                    'status_id' => 1,
                    'door_number' => ($request->doorNumber) ? $request->doorNumber : null,
                    'door_type' => ($request->doorType) ? $request->doorType : null,
                    'all_money' => ($request->allMoney) ? $request->allMoney : null,
                    'given_money' => ($request->givenMoney) ? $request->givenMoney : null,
                    'finish_at' => ($request->finishAt) ? $request->finishAt : '',
                    'file' => $newImageName,
                    'description' => ($request->description) ? $request->description : '',
                ]);
            }
        }

        return redirect()->route('index');
    }

    public function getUsers(Request $request, $filter = null)
    {
        if (isset($request)) {
            $from = $request->from . " " . "00:00:00";
            $to = $request->to . " " . "00:00:00";
        }
        
        if (!empty($filter)) {
            $users = User::whereBetween('created_at', [$from, $to])
            ->orderBy('id', 'DESC')
            ->paginate(30);
        }else{
            $users = User::orderBy('id', 'DESC')->paginate(30);
        }

        return view('front.home.users', compact('users'));
    }

    public function changeStatus(Request $request, $status_id)
    {
        Order::where('id', $status_id)->update([
            'status_id' => $request->status
        ]);

        return redirect()->back();
    }

    public function orderEdit($id)
    {
        $users = User::where('role', 'client')->orderBy('id', 'DESC')->get();
        $order = Order::where('id', $id)->first();
        return view('front.home.editorder', compact('order', 'users'));
    }

    public function orderUpdate(Request $request, $id)
    {
        if($request->image){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $img = $filename;
        }else{
            $img = '';
        }

        Order::where('id', $id)->update([
            'user_id' => $request->client_id,
            'door_number' => ($request->doorNumber) ? $request->doorNumber : null,
            'door_type' => ($request->doorType) ? $request->doorType : null,
            'all_money' => ($request->allMoney) ? $request->allMoney : null,
            'given_money' => ($request->givenMoney) ? $request->givenMoney : null,
            'finish_at' => ($request->finishAt) ? $request->finishAt : null,
            'file' => $img,
            'description' => ($request->description) ? $request->description : '',
        ]);

        return redirect()->back();
    }

    public function orderDelete(Request $request)
    {
        $order = Order::where('id', $request->delete_id)->first();

        Archive::create([
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'status_id' => $order->status_id,
            'door_number' => ($order->door_number) ? $order->door_number : null,
            'door_type' => ($order->door_type) ? $order->door_type : null,
            'all_money' => ($order->all_money) ? $order->all_money : null,
            'given_money' => ($order->given_money) ? $order->given_money : null,
            'finish_at' => ($order->finish_at) ? $order->finish_at : '',
            'file' => ($order->img) ? $order->img : '',
            'description' => ($order->description) ? $order->description : '',
        ]);

        Order::where('id', $request->delete_id)->delete();

        return redirect()->back();
    }

    public function userDelete(Request $request)
    {
        User::where('id', $request->delete_id)->delete();
        return redirect()->back();
    }
}
