<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\CartItem;


class addCookieToCartR
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $user_id = User::where('id', $event->user->id)->firstOrFail();
        if (!empty($_COOKIE['cart_items'])) {
            $cart_items = unserialize($_COOKIE['cart_items']);
            for($i = 0; $i < count($cart_items); $i++) {
                $cart_item = new CartItem(array(
                    'user_id' => $user_id->id,
                    'tour_package_id' => $cart_items[$i]['tour_package_id'],
                    'package_type_id' => $cart_items[$i]['package_type_id'],
                    'no_of_pax' => $cart_items[$i]['no_of_pax'],
                    'chosen_travel_date' => date('Y-m-d', strtotime($cart_items[$i]['chosen_travel_date'])),
                ));
                //print_r($cart_item);
                $cart_item->save();
            }
            setcookie('cart_items', '', time() - (86400 * 30), "/");
            if (!empty($_COOKIE['for'])) {
                if ($_COOKIE['for'] == 'checkout') {
                    setcookie('for', '', time() - (86400 * 1), "/");
                    session(['continue_new' => 'Please complete your profile details in order to continue your transaction.']);
                }
                else {
                    setcookie('for', '', time() - (86400 * 1), "/");
                    //session(['error' => 'RUN: if -> else']);
                }
            }
            else {
                // session(['error' => 'RUN: else...what???']);
            }
            
        }
        
            
    }
}
