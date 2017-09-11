<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TourPackage;
use App\Post;
use App\CartItem;
use App\Purchase;
use App\PurchasedItem;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutFormRequest;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            //if logged in
            if (!empty(Auth::user()->birthday) && !empty(Auth::user()->city) && !empty(Auth::user()->province) && !empty(Auth::user()->phone_number)) {
                $cart_items = CartItem::join('tour_packages', 'cart_items.tour_package_id', '=', 'tour_packages.id')
                    ->join('package_types', 'cart_items.package_type_id', '=', 'package_types.id')
                    ->whereRaw(DB::raw('cart_items.user_id = '.Auth::user()->id))
                    ->orderBy('cart_items.created_at')
                    ->paginate(9);
                $homepage = DB::table('homepage')->first();
                $bank_info = DB::table('bank_info')->first();
                if (count($cart_items) == 0) {
                    return redirect('/tour-packages')->with('status', 'Please select your payment method and review your order before submitting.');
                }
                else {
                    return view('checkout', compact('homepage', 'cart_items', 'bank_info'));
                }
            }
            else {
                return redirect('/users/settings?for=checkout')->with('error', 'Please complete your profile details before proceeding to checkout.');
            }
        }
        else {
            //if not logged in
            //proceed to login page
            return redirect('/users/login?for=checkout')->with('error', 'Please complete your profile details before proceeding to checkout.');
        }
        
    }

    public function checkout(CheckoutFormRequest $request)
    {
    	if (Auth::check()) {
            //if logged in
            if (!empty(Auth::user()->birthday) && !empty(Auth::user()->city) && !empty(Auth::user()->province) && !empty(Auth::user()->phone_number)) {
            	$subtotal = 0;
                $cart_items = CartItem::join('tour_packages', 'cart_items.tour_package_id', '=', 'tour_packages.id')
                    ->join('package_types', 'cart_items.package_type_id', '=', 'package_types.id')
                    ->whereRaw(DB::raw('cart_items.user_id = '.Auth::user()->id))
                    ->orderBy('cart_items.created_at')
                    ->get();
                $bank_info = DB::table('bank_info')->first();
                $homepage = DB::table('homepage')->first();

                if (count($cart_items) == 0) {
                    return redirect('/tour-packages')->with('error', 'There is no item in your cart.');
                }
                else {
                	foreach ($cart_items as $cart_item) {
	                	$pax = $cart_item->no_of_pax;
	                    $limit = $cart_item->pax_per_room;
	                    $division;
	                    $total;
	                    if (($pax % $limit) == 0) {
	                        $division = $pax / $limit;
	                    }
	                    else {
	                        $division = ceil($pax / $limit);
	                    }
	                    $total = $cart_item->price * $division;
	                    //echo number_format($total, 2, '.', ',');
	                    $subtotal += $total;
	                }
	                $taxable = ($subtotal*$homepage->tax)/100;
                	//THERE IS NO IMPLEMENTATION OF MISCELLANEOUS FEE YET 
                	$miscellaneous_fee = 0;
                	$uniqid = uniqid();
                	$purchase = new Purchase(array(
                		'user_id' => Auth::user()->id,
			        	'bank_name' => $request->get('bank_name'),
			        	'subtotal' => $subtotal,
			        	'tax' => $taxable,
			        	'total' => $subtotal+$miscellaneous_fee+$taxable,
			        	'uniqid' => $uniqid,
			        ));
			        $purchase->save();

			        $purchase_row = Purchase::where('uniqid', $uniqid)->firstOrFail();
			        $p_id = $purchase_row->id;
			        foreach ($cart_items as $cart_item) {
			        	$pax = $cart_item->no_of_pax;
                        $limit = $cart_item->pax_per_room;
                        $division;
                        $total;
                        if (($pax % $limit) == 0) {
                            $division = $pax / $limit;
                        }
                        else {
                            $division = ceil($pax / $limit);
                        }
                        $total = $cart_item->price * $division;
			        	$purchased_item = new PurchasedItem(array(
			        		'purchase_id' => $p_id,
			        		'package_name' => $cart_item->name,
			        		'package_type' => $cart_item->type_name,
			        		'customer_pax' => $cart_item->no_of_pax,
			        		'price' => $total,
			        		'travel_period' => $cart_item->no_of_days.'D'.$cart_item->no_of_nights.'N',
			        		'chosen_travel_date' => date('Y-m-d', strtotime($cart_item->chosen_travel_date)),
			        	));
			        	$purchased_item->save();
			        }

			        CartItem::where('user_id', Auth::user()->id)->delete();
                    return redirect('/users/profile')->with('status', 'The last process is the payment, after you paid, please upload the receipt for proof of payment. Thank you very much!');
                }
            }
            else {
                return redirect('/users/settings?for=checkout')->with('error', 'Please complete your profile details before proceeding to checkout.');
            }
        }
        else {
            //if not logged in
            //proceed to login page
            return redirect('/users/login?for=checkout')->with('error', 'Please complete your profile details before proceeding to checkout.');
        }
    }
}
