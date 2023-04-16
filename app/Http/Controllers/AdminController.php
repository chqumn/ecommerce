<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function view_category() {
        $admin_user = Auth::user();
        $data = Category::all();
        return view('admin.category', compact('data', 'admin_user'));
    }

    public function add_category(Request $request) {
        $data = new Category();
        $data->category_name = $request->category;
        $data->save();
        return redirect()->back()->with('message', 'Category added successfully');
    }

    public function delete_category($id) {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category deleted successfully');
    }

    public function new_product() {
        $admin_user = Auth::user();
        $category = Category::all();
        return view('admin.add_product', compact('category', 'admin_user'));
    }

    public function add_product(Request $request) {
        $data = new Product();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->discount = $request->discount;
        $data->category = $request->category;
        $data->quantity = $request->quantity;

        $image = $request->image;
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move('product', $image_name);
        $data->image = $image_name;

        $data->save();
        return redirect()->back()->with('message', 'Product added successfully');
    }

    public function view_product() {
        $admin_user = Auth::user();
        $data = Product::all();
        return view('admin.view_product', compact('data', 'admin_user'));
    }

    public function delete_product($id) {
        $data = Product::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Product deleted successfully');
    }

    public function update_product($id) {
        $admin_user = Auth::user();
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.update_product', compact('product', 'category', 'admin_user'));
    }

    public function update_product_confirm(Request $request, $id) {
        $data = Product::find($id);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->discount = $request->discount;
        $data->quantity = $request->quantity;
        $data->category = $request->category;

        $image = $request->image;
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('product', $image_name);
            $data->image = $image_name;
        }

        $data->save();
        return redirect()->back()->with('message', 'Product updated successfully');
    }

    public function order() {
        $admin_user = Auth::user();
        $order = Order::all();
        return view('admin.order', compact('order', 'admin_user'));
    }

    public function delivery($id) {
        $order = Order::find($id);
        $order->status = 'Delivering';
        $order->save();
        return redirect()->back()->with('message', 'Order being delivered');
    }

    public function complete_order($id) {
        $order = Order::find($id);
        $order->status = 'Completed';
        $order->save();
        return redirect()->back()->with('message', 'Order completed');
    }

    public function delete_order($id) {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back()->with('message', 'Order deleted');
    }

    public function search_order(Request $request) {
        $admin_user = Auth::user();
        $searchText = $request->search;
        $order = Order::where('user_name', 'LIKE', '%' . $searchText .'%')
                    ->orWhere('email', 'LIKE', '%' . $searchText .'%')
                    ->orWhere('phone', 'LIKE', '%' . $searchText .'%')
                    ->orWhere('address', 'LIKE', '%' . $searchText .'%')
                    ->orWhere('product_name', 'LIKE', '%' . $searchText .'%')->get();
        return view('admin.order', compact('order', 'admin_user'));
    }

    public function search_product(Request $request) {
        $admin_user = Auth::user();
        $searchText = $request->search;
        $data = Product::where('name', 'LIKE', '%' . $searchText .'%')
                    ->orWhere('description', 'LIKE', '%' . $searchText .'%')
                    ->orWhere('category', 'LIKE', '%' . $searchText .'%')->get();
        return view('admin.view_product', compact('data', 'admin_user'));
    }

    public function test() {
        $admin_user = Auth::user();
        $order = Order::where('price', DB::raw('(SELECT MAX(price) FROM orders)'))->get();
        // $result = DB::table('orders')
        //     ->select('user_name', 'product_name', 'quantity', 'price')
        //     ->where('price', DB::raw('(SELECT MAX(price) FROM orders)'))
        //     ->get();
        return view('admin.test', compact('admin_user', 'order'));
    }
}