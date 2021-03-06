<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $duplicates = Cart::search(function($cartItem, $rowId) use ($request){
          return $cartItem->id === $request->id;
        });
      if($duplicates->isNotEmpty()) {
        return redirect()->route('cart.index');
      }

      if(Cart::count() > 0) {
        return redirect()->route('cart.index')->withErrors(['msg' => 'Giới hạn đăng ký: mỗi lần chỉ được đăng ký một khóa học.']);
      }

      Cart::add($request->id, $request->name, 1, $request->fee, ['hp_id' => $request->hp_id, 'description' => $request->description, 'start_day' => $request->start_day])
        ->associate('App\Classroom');

      return redirect()->route('cart.index')->with('success_message','Đã thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('success_message', 'Xóa thành công');
    }
}
