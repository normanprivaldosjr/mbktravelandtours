<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubscribeFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Subscriber;

class SubscribersController extends Controller
{
    public function subscribe(SubscribeFormRequest $request)
    {
    	$subscribe = new Subscriber(array(
        	'email' => $request->get('email_address'),
            'uniqid' => uniqid(),
        ));

        $subscribe->save();

        return redirect('/')->with('status', 'Thank you for subscribing!');
    }

    public function subscribe_registered()
    {
    	if (Auth::check()) {
    		$subscribe = new Subscriber(array(
	        	'email' => Auth::user()->email,
	            'uniqid' => uniqid(),
	        ));

	        $subscribe->save();

	        return redirect('/users/profile')->with('status', 'Thank you for subscribing!');
    	}
    	else {
    		return redirect('/');
    	}
    	
    }


    public function unsubscribe_registered($uniqid)
    {
    	$subscriber = Subscriber::where('uniqid', $uniqid)->firstOrFail();
        $subscriber->delete();
        return redirect('/users/profile')->with('status', 'You unsubscribed for the newsletter.');
    }

    public function unsubscribe($uniqid)
    {
    	$subscriber = Subscriber::where('uniqid', $uniqid)->firstOrFail();
        $subscriber->delete();
        return redirect('/')->with('status', 'You unsubscribed for the newsletter.');
    }
}
