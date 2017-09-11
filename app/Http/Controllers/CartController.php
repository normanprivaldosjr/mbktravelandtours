<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CartItemFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\CartItem;

class CartController extends Controller
{
	public function index()
	{
		if (Auth::check()) {
			$cart_items = CartItem::select(
                'cart_items.*', 
                'name', 'slug', 'package_image', 'no_of_days', 'no_of_nights', 
                'tour_packages.package_description', 'tour_packages.selling_day_start', 'tour_packages.selling_day_end', 'tour_packages.travel_day_start', 'tour_packages.travel_day_end', 'tour_packages.price_starts', 'tour_packages.meta_description', 'tour_packages.meta_keywords', 'tour_packages.destination', 
                'package_types.package_id', 'package_types.type_name', 'package_types.pax_per_room', 'package_types.price', 'package_types.help_info'
                )
                    ->join('tour_packages', 'cart_items.tour_package_id', '=', 'tour_packages.id')
					->join('package_types', 'cart_items.package_type_id', '=', 'package_types.id')
	                ->whereRaw(DB::raw('cart_items.user_id = '.Auth::user()->id))
	                ->orderBy('cart_items.created_at')
	                ->paginate(9);
                    //return $cart_items;
	        $homepage = DB::table('homepage')->first();
			return view('cart', compact('homepage', 'cart_items'));
		}
		else 
    	{//session or cookie
            //setcookie('cart_items', '', time() - (86400 * 30), "/");
            $tour_packages = DB::table('tour_packages')->get();
            $package_types = DB::table('package_types')->get();
            $homepage = DB::table('homepage')->first();
            return view('cart', compact('homepage', 'tour_packages', 'package_types'));
    		//print_r(unserialize($_COOKIE['cart_items']));
	    }
	}

    public function add_to_cart(CartItemFormRequest $request)
    {
    	if (Auth::check()) {
    		$cart_item = new CartItem(array(
	    		'user_id' => Auth::user()->id,
	    		'tour_package_id' => $request->get('tour_package'),
	    		'package_type_id' => $request->get('package_type'),
	    		'no_of_pax' => $request->get('no_of_pax'),
                'chosen_travel_date' => date('Y-m-d', strtotime($request->get('chosen_travel_date'))),
	        ));

	        $cart_item->save();
	        return redirect('/shopping-cart')->with('status', $request->get('package_name').' has been successfully added to the cart.');
    	}
    	else 
    	{//COOKIE
            if (empty($_COOKIE['cart_items'])) {
                $arr = [];
                $arr[] = [
                    'tour_package_id' => $request->get('tour_package'),
                    'package_type_id' => $request->get('package_type'),
                    'no_of_pax' => $request->get('no_of_pax'),
                    'chosen_travel_date' => date('Y-m-d', strtotime($request->get('chosen_travel_date')))
                    ];
                setcookie('cart_items', serialize($arr), time() + (86400 * 30), "/");
            }
            else {
                $arr = unserialize($_COOKIE['cart_items']);
                $arr[] = ['tour_package_id' => $request->get('tour_package'),
                    'package_type_id' => $request->get('package_type'),
                    'no_of_pax' => $request->get('no_of_pax'),
                    'chosen_travel_date' => date('Y-m-d', strtotime($request->get('chosen_travel_date')))];
                setcookie('cart_items', serialize($arr), time() + (86400 * 30), "/");
            }
            
            return redirect('/shopping-cart')->with('status', $request->get('package_name').' has been successfully added to the cart.');
	    }
    }

    public function remove_from_cart($id)
    {
        if (Auth::check()) {
            $cart_item = CartItem::whereId($id)->firstOrFail();
            $cart_item->delete();
        }
    	else {
            $arr = unserialize($_COOKIE['cart_items']);
            $new_arr = [];
            for ($i = 0; $i < count($arr); $i++) {
                if ($i == $id) {
                    continue;
                }
                else {
                    $new_arr[] = $arr[$i];
                }
            }
            setcookie('cart_items', serialize($new_arr), time() + (86400 * 30), "/");
        }
        return redirect('/shopping-cart')->with('status', 'The item has been removed from the cart.');
    }

    public function proceed_to_checkout()
    {
    	if (Auth::check()) {
            //if logged in
            if (!empty(Auth::user()->birthday) && !empty(Auth::user()->city) && !empty(Auth::user()->province) && !empty(Auth::user()->phone_number)) {
                //if the profile info is not null
                return redirect('/checkout')->with('status', 'Please select your payment method and review your order before submitting.');
            }
            else {
                return redirect('/users/settings?for=checkout')->with('error', 'Please complete your profile details before proceeding to checkout.');
            }
        }
        else {
            //if not logged in
            //proceed to login page
            return redirect('/users/login?for=checkout')->with('error', 'Please register or login before proceeding to checkout. Please note that if your account\'s cart is not empty, the items you have added will be appended to your cart and will not be overwritten.');
        }
    }
    	
}
