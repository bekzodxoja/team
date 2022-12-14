<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Food;
use App\Models\Foodchef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            return redirect('redirects');
        }
        else
        $data = Food::all();
        $chef = Foodchef::all();
        return view("home", compact("data", "chef"));
    }


    public function redirects()
    {
        $data = Food::all();        
        $chef = Foodchef::all();

        $usertype = Auth::user()->usertype;

        if($usertype == 1)
        {
            return view('admin.adminhome');
        }

        else
        {
           $user_id=Auth::id();
           $count = cart::where('user_id', $user_id)->count();


            return view('home', compact('data', 'chef', 'count'));
        }
    }

    public function addcart(Request $request, $id)
    {
        if(Auth::id())
        {
           $user_id=Auth::id();

           $foodid=$id;

           $quantity=$request->quantity;

           $cart = new Cart;


           $cart->user_id=$user_id;

           $cart->food_id=$foodid;

           $cart->quantity=$quantity;

           $cart->save();

            return redirect()->back();
        }
        else
        {
            return redirect('/login');
        }
    }

    public function showcart(Request $request,$id)
    {
        $count=cart::where('user_id',$id)->count();
        if(Auth::id()==$id)
        {
        $dcart=cart::select('*')->where('user_id','=', $id)->get();
        $data=cart::where('user_id',$id)->join('food', 'carts.food_id', '=', 'food_id')->get();
        return view('showcart',compact('count', 'data', 'dcart'));
    }
    else{
        return redirect()->back();
    }
    }
    public function remove($id)
    {
        $data=cart::find($id);
        $data->delete();
        return redirect()->back();
    }

public function orderconfirm(Request $request)
{

    foreach($request->foodname as $key => $foodname)
    {
        $data = new Order;
        $data->foodname=$foodname;
        $data->price=$request->price[$key];
        $data->quantity=$request->quantity[$key];
        $data->name=$request->name;
        $data->phone=$request->phone;
        $data->address=$request->address;
        $data->save();
    }
    return redirect()->back();
}

}
