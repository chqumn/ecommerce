<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class HomeController extends Controller
{
    public function index() {
        $product = Product::paginate(6);
        return view('home.userpage', compact('product'));
    }

    public function redirect()
    {
        $usertype=Auth()->user()->usertype;
        if ($usertype == 'admin') {
            $admin_user = Auth::user();
            $total_product = Product::all()->count();
            $total_user = User::where('usertype', 'user')->get()->count();
            $order = Order::all();
            $total_revenue = 0;
            foreach($order as $order) {
                if ($order->status == 'Completed') {
                    $total_revenue += $order->price * $order->quantity;
                }
            }
            $delivering = order::where('status', 'Delivering')->get()->count();
            $pending = order::where('status', 'Pending')->get()->count();
            $completed = order::where('status', 'Completed')->get()->count();
            $cancelled = order::where('status', 'Cancelled')->get()->count();
            $total_order = Order::all()->count();
            return view('admin.dashboard', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'delivering', 'pending', 'completed', 'cancelled', 'admin_user'));
        } else {
            $product = Product::paginate(6);
            return view('home.userpage', compact('product'));
        }
    }

    public function product_details($id) {
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id) {
        if (Auth::id()) {
            $user = Auth::user();
            $product = Product::find($id);
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;
            if ($product->discount) {
                $cart->unit_price = $product->discount;
            } else {
                $cart->unit_price = $product->price;
            }
            $cart->product_name = $product->name;
            $cart->image = $product->image;
            $cart->save();
            return redirect()->back()->with('message', 'Product added to cart successfully!');
        } else {
            return redirect('login');
        }
    }

    public function view_cart() {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', $id)->get();
            return view('home.view_cart', compact('cart'));
        } else {
            return redirect('login');
        }                                                                                   
    }

    public function remove_cart($id) {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('message', 'Product removed from cart successfully!');
    }

    public function checkout() {
        $user = Auth::user();
        $data = Cart::where('user_id', $user->id)->get();
        foreach ($data as $data) {
            $order = new Order;

            $order->user_id = $user->id;
            $order->user_name = $user->name;
            $order->email = $user->email;
            $order->phone = $user->phone;
            $order->address = $user->address;

            $order->product_id = $data->product_id;
            $order->product_name = $data->product_name;
            $order->image = $data->image;
            $order->quantity = $data->quantity;
            $order->price = $data->unit_price;

            $order->status = 'Pending';
            $order->save();
            $data->delete();
        }
        return redirect()->back()->with('message', 'Order placed successfully!');
    }

    public function view_order() {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $order = Order::where('user_id', $id)->get();
            return view('home.order', compact('order'));
        } else {
            return redirect('login');
        }
    }

    public function cancel_order($id) {
        $order = Order::find($id);
        $order->status = 'Cancelled';
        $order->save();
        return redirect()->back()->with('message', 'Order cancelled successfully!');
    }

    public function product_page() {
        $product = Product::paginate(6);
        return view('home.product_page', compact('product'));
    }

    public function product_search(Request $request) {
        $search = $request->search;
        $product = Product::where('name', 'like', '%'.$search.'%')
                        ->orWhere('description', 'like', '%'.$search.'%')
                        ->orWhere('category', 'like', '%'.$search.'%')->paginate(6);
        return view('home.product_page', compact('product'));
    }

    public function user_profile() {
        if (Auth::id()) {
            return redirect('user/profile/');
        } else {
            return redirect('login');
        }
    }
}