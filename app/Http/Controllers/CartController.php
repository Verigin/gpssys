<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
        } else {
            $userId = -1;
        }

        if (request()->ajax()) {
            // $items = [];
            // \Cart::session($userId)->getContent()->each(function ($item) use (&$items) {
            //     $items[] = $item;
            // });
            return response(array(
                'success' => true,
                'data' => \Cart::session($userId)->getContent(),
                'message' => 'cart get items success',
            ), 200, []);
        } else {
            $data = Auth::user();
            return view('shop.cart', ['data' => $data, 'count' => count(\Cart::session($userId)->getContent())]);
            //return \Cart::session($userId)->getContent();
        }

    }
    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
        } else {
            $userId = -1;
        }
        \Cart::session($userId)->update($id, array(
            'quantity' => $request->qty, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
        ));
    }

    public function add()
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
        } else {
            $userId = -1;
        }
        // get this from session or wherever it came from

        $id = request('id');
        $Product = Product::find($id);
        $name = $Product->title;
        $price = $Product->price;
        $qty = request('qty');
        $customAttributes = [

        ];
        \Cart::session($userId)->add($id, $name, $price, $qty, $customAttributes);
    }

    public function delete($id)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
        } else {
            $userId = -1;
        }
        \Cart::session($userId)->remove($id);
        return response(array(
            'success' => true,
            'data' => $id,
            'message' => "cart item {$id} removed.",
        ), 200, []);
    }
    public function details()
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
        } else {
            $userId = -1;
        }

        return response(array(
            'success' => true,
            'data' => array(
                'total_quantity' => \Cart::session($userId)->getTotalQuantity(),
                'sub_total' => \Cart::session($userId)->getSubTotal(),
                'total' => \Cart::session($userId)->getTotal(),
            ),
            'message' => "Get cart details success.",
        ), 200, []);
    }

    public function order(Request $request)
    {

        // $order = $user->orders()->create([
        //     'total' => \Cart::session($user->id)->getTotal(),
        // ]);
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        if (Auth::check()) {
            $userId = Auth::user()->id;
        } else {
            $userId = -1;
        }

        $order = Order::create([
            'user_id' => $userId,
            'total' => \Cart::session($userId)->getTotal(),
            'email' => $request->email,
        ]);

        $items = \Cart::session($userId)->getContent();
        //dd($items);
        foreach ($items as $item) {
            $order->orderItems()->attach($item->id, [
                'qty' => $item->quantity,
                'total' => $item->quantity * $item->price,
            ]);
        }
        \Cart::session($userId)->clear();
        return redirect()->route('cart')->with('success', 'Order created successfuly');

    }
}
