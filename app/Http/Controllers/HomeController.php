<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllToppings;
use App\Models\AllCondiments;
use App\Models\Condiments;
use App\Models\Toppings;
use App\Models\Base;
use App\Models\Orders;
use App\Models\Images;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function images(Request $request) {
    $images = Images::take(5)->get('name');
    return response()->json($images);
  }

  // return view for user with their orders
  public function home() {
    $user_id = Auth::id();
    // $orders = Orders::where('users_id', $user_id)->where('done', false)->with('condiments', 'toppings')->get();
    $orders = Orders::where('users_id', $user_id)->where('done', true)->with('bases.images', 'condiments', 'toppings')->orderBy('updated_at')->paginate(6);
    // dd(public_path('css/app.css'));
    return view('home', ['orders' => $orders]);
  }

  // return view to add new order
  public function newOrder(Request $request) {
    $toppings = AllToppings::all();
    $condiments = AllCondiments::all();
    $bases = Base::with('images')->get();
    return view('new', ['toppings' => $toppings, 'condiments' => $condiments, 'bases' => $bases]);
  }

  // store the order by the user
  public function addNewOrder(Request $request) {
    $order = new Orders;
    $order->users_id = Auth::id();
    if (empty($request->input('base'))){
      return redirect()->back()->withErrors(['Please Select an Entree']);
    }
    $base = Base::firstWhere('base', $request->input('base'));
    $order->order = $base->base;
    $order->bases_id = $base->id;
    $order->save();
    if (!empty($request->input('condiments'))){
      $condiments = $request->input('condiments');
      foreach ($condiments as $condiment) {
        $new_condiment = new Condiments;
        $new_condiment->orders_id = $order->id;
        $new_condiment->condiment = $condiment;
        $new_condiment->save();
      }
    }
    if (!empty($request->input('toppings'))){
      $toppings = $request->input('toppings');
      foreach ($toppings as $topping) {
        $new_topping = new Toppings;
        $new_topping->orders_id = $order->id;
        $new_topping->topping = $topping;
        $new_topping->save();
      }
    }
    return redirect()->route('home');
  }

  // remove the order with id and condiment and toppings with order_id of id
  public function remove($id) {
    $order = Orders::where('id', $id)->first();
    $condiments = Condiments::where('orders_id', $id)->get();
    $toppings = Toppings::where('orders_id', $id)->get();
    foreach ($condiments as $condiment) {
      $condiment->delete();
    }
    foreach ($toppings as $topping) {
      $topping->delete();
    }
    $order->delete();
    return redirect()->route('home');
  }

  // return view for admin
  public function all() {
    $orders = Orders::where('done', false)->with('bases.images', 'condiments', 'toppings', 'users')->orderBy('created_at')->paginate(6);
    // dd($orders);
    return view('all', ['orders' => $orders]);
  }

  public function orderDone($id) {
    $order = Orders::where('id', $id)->first();
    $order->done = true;
    $order->save();
    // dd($order);
    return redirect()->route('all');
  }

  public function pendingOrders(array $headers = []) {
    // dd('here');
    $user_id = Auth::id();
    $orders = Orders::where('users_id', $user_id)->where('done', false)->with('bases.images', 'condiments', 'toppings')->orderBy('created_at')->paginate(6);
    // dd($orders);
    return view('pending_orders', ['orders' => $orders]);
    // return response("hello");
  }

  public function adminPage() {
    // dd(url('storage/app/public'));
    $toppings = AllToppings::all();
    $condiments = AllCondiments::all();
    $bases = Base::with('images')->get();
    // dd($bases);
    return view('admin', ['toppings' => $toppings, 'condiments' => $condiments, 'bases' => $bases]);
  }

  public function editBasesPage() {
    $bases = Base::with('images')->get();
    return view('edit_bases', ['bases' => $bases]);
  }

  public function editCondimentsPage() {
    $condiments = AllCondiments::all();
    return view('edit_condiments', ['condiments' => $condiments]);
  }

  public function editToppingsPage() {
    $toppings = AllToppings::all();
    return view('edit_toppings', ['toppings' => $toppings]);
  }

  public function removeBase($id) {
    $base = Base::find($id);
    $image = Images::where('bases_id', $base->id)->first();
    $image_path = public_path().'/storage/images/'.$image->name;
    unlink($image_path);
    $image->delete();
    $base->delete();
    // dd($image->name);
    return redirect()->route('editBasesPage');
  }

  public function editSelectedBase($id) {
    $base = Base::where('id', $id)->with('images')->first();
    return view('edit_base', ['base' => $base]);
  }

  public function newBase(Request $request) {
    $imageName = time().'-'.$request->file('baseImage')->getClientOriginalName();
    $request->file('baseImage')->storeAs('public/images', $imageName);
    $base = new Base;
    $base->base = $request->input('base');
    $base->price = $request->input('price');
    $base->save();
    $image = new Images;
    $image->bases_id = $base->id;
    // dd($imageName);
    $image->name = $imageName;
    $image->description = $request->input('base');
    $image->save();
    return redirect()->route('editBasesPage');
  }

  public function newCondiment(Request $request) {
    $condiment = new AllCondiments;
    $condiment->condiment = $request->input('condiment');
    $condiment->save();
    return redirect()->route('editCondimentsPage');
  }

  public function removeCondiment($id) {
    $condiment = AllCondiments::where('id', $id)->first();
    $condiment->delete();
    return redirect()->route('editCondimentsPage');
  }

  public function newTopping(Request $request) {
    $topping = new AllToppings;
    $topping->topping = $request->input('topping');
    $topping->save();
    return redirect()->route('editToppingsPage');
  }

  public function removeTopping($id) {
    $topping = AllToppings::where('id', $id)->first();
    $topping->delete();
    return redirect()->route('editToppingsPage');
  }

}
