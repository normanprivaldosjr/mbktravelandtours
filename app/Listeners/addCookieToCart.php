<?php

namespace App\Listeners;

use App\Events\UserLogin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

use App\CartItem;

class addCookieToCart
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
     * @param  UserLogin  $event
     * @return void
     */
    public function handle(UserLogin $event)
    {
        
        if (!empty($_COOKIE['cart_items'])) {
            $cart_items = unserialize($_COOKIE['cart_items']);
            for($i = 0; $i < count($cart_items); $i++) {
                $cart_item = new CartItem(array(
                    'user_id' => Auth::user()->id,
                    'tour_package_id' => $cart_items[$i]['tour_package_id'],
                    'package_type_id' => $cart_items[$i]['package_type_id'],
                    'no_of_pax' => $cart_items[$i]['no_of_pax'],
                    'chosen_travel_date' => date('Y-m-d', strtotime($cart_items[$i]['chosen_travel_date'])),
                ));

                $cart_item->save();
            }
            setcookie('cart_items', '', time() - (86400 * 30), "/");
            session('continue', 'You may now continue your transaction.');
        }
        
    }
}
