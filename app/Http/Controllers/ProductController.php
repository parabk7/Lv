<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Cart;
use App\Product;
use App\Order;
use App\Comment;
use Session;
use Auth;
use Stripe\Charge;
use Stripe\Stripe;
use DB;
use Input;

class ProductController extends Controller
{
    public function getIndex()
    {
        $products = Product::all(); 
        return view('shop.index',['products' => $products]);
    }

    public function getAddToCart(Request $request,$id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart',$cart);

        //dd($request->session()->get('cart'));   //check the data value flow
        return redirect()->route('product.index');
    }


    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

         if(count($cart->items) > 0)
        {
             Session::put('cart',$cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingCart');
    }


    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0)
        {
             Session::put('cart',$cart);
        } else {
            Session::forget('cart');
        }

       
        return redirect()->route('product.shoppingCart');
    }



    public function getCart()
    {
        if(!Session::has('cart'))
        {
            return view('shop.shopping-cart');
        }
        $oldCart= Session::get('cart');
        $cart= new Cart($oldCart);
        return view('shop.shopping-cart',['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }


    public function getCheckout()
    {
        if(!Session::has('cart'))
        {
           
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
       
        return view('shop.checkout',['total' => $total]);
    }


    public function postCheckout(Request $request)
    {
         if(!Session::has('cart'))
        {
            
            return view('shop.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);


       \Stripe\Stripe::setApiKey("sk_test_O9DZ3QZcH8KLvNGrKp9pUFD0");
        try {
             $charge = \Stripe\Charge::retrieve(array(
                    "id" =>  "ch_1A31oeBkWcaYNftTfJhtIJGw",
                   //"amount" => $cart->totalPrice * 100,
                  // "currency" => "inr",
                    "source" => $request->input('stripeToken'),
                 // "description" => "Test Charge",
                  "expand" => array("customer")
                ));

/*$charge = \Stripe\Charge::retrieve(array(
                    "id" =>  "ch_1A31oeBkWcaYNftTfJhtIJGw",
                  //  "amount" => $cart->totalPrice * 100,
                 //   "currency" => "inr",
                    "source" => $request->input('stripeToken'),
                  //  "description" => "Test Charge"
                ));*/
             
             $order = new Order();
             $order->cart =unserialize($cart); 
             $order->address = $request->input('address');
             $order->name = $request->input('name');
             $order->payment_id = $charge->id;

             Auth::user()->orders()->save($order);

        }catch(\Exception $e){
           
            return redirect()->route('checkout')->with('error' , $e->getMessage());
                        

        }

        Session::forget('cart');
        
        return redirect()->route('product.index')->with('success','Successfully Purchased Product');
               

    }


    public function autocomplete(Request $request)
    {
        $term = $request->term; //jquery
        $data = Product::where('title','LIKE', strtolower("$term%"))->take(5)->get();
        $result = array();
     
        foreach ($data as $key => $value) 
        {
            $result[] = ['id'=>$value->id,'value'=>$value->title]; 
        }
        return response()->json($result);
    }

    public function viewD($p_id)
    {
        $p = DB::table('products')->where('id','=',$p_id)->get();

        return view('shop.view',compact('p'));
    }

    public function postComents(Request $req,$id)
    {
        $comm = $req->input('com');
        

        $data = array('comment'=>$comm);

        DB::table('comments')->insert($data);

        return view('shop.view');
    }
}
