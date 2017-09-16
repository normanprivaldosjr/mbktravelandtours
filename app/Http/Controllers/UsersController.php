<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserEditFormRequest;
use App\Http\Requests\UploadDepositReceiptFormRequest;
use App\TourPackage;
use App\User;
use App\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class UsersController extends Controller
{
    public function profile()
    {
        $tour_packages = TourPackage::limit(3)->get();
        $homepage = DB::table('homepage')->first();
        $purchases = DB::table('purchases')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('users.profile', compact('tour_packages', 'homepage', 'purchases'));
    }

    public function update_profile()
    {
        return view('users.edit');
    }

    public function settings()
    {
        $tour_packages = TourPackage::limit(3)->get();
        $homepage = DB::table('homepage')->first();
        return view('users.settings', compact('tour_packages', 'homepage'));
    }

    public function update(UserEditFormRequest $request)
    {
        $id = Auth::user()->id;
        $user = User::whereId($id)->firstOrFail();
        $user->first_name = $request->get('first_name');
        $user->middle_initial = $request->get('middle_initial');
        $user->last_name = $request->get('last_name');
        $user->phone_number = $request->get('phone_number');
        $user->city = $request->get('city');
        $user->province = $request->get('province');
        $user->birthday = date('Y-m-d', strtotime($request->get('birthday')));
        //$user->profile_picture = $request->get('profile_picture');

        $profile_picture = $request->get('profile_picture');

        if(!empty($profile_picture)){
            if(!empty(Auth::user()->profile_picture))
               unlink(public_path().parse_url(Auth::user()->profile_picture, PHP_URL_PATH));

            list($type, $profile_picture) = explode(';', $profile_picture);
            list(, $profile_picture) = explode(',', $profile_picture);

            $profile_picture = base64_decode($profile_picture);
            $newProfilePicture = time().uniqid(rand()).".png";
            $path = public_path() . "/uploads/" . $newProfilePicture;

            if(file_put_contents($path, $profile_picture))
                $user->profile_picture = url('/')."/uploads/".$newProfilePicture;
        }

        $user->save();

        if (!empty($request->get('for'))) {
    		if ($request->get('for') == 'checkout') {
    			return redirect(action('CheckoutController@index'))->with('status', 'Please select your payment method and review your order before submitting.');
    		}
    		else {
    			return redirect(action('UsersController@profile'))->with('status', 'Your profile has been updated!');
    		}
    	}
    	else {
    		return redirect(action('UsersController@profile'))->with('status', 'Your profile has been updated!');
    	}
	}

    public function view_purchase($uniqid) {
        //check if it is the right user
        //check if it is the admin

        $homepage = DB::table('homepage')->first();
        $purchase = DB::table('purchases')->where('uniqid', $uniqid)->first();
        $purchased_items = DB::table('purchased_items')->where('purchase_id', $purchase->id)->get();
        $bank_info = DB::table('bank_info')->first();
        if (Auth::user()->id == $purchase->user_id || Auth::user()->hasRole('manager')) {
            return view('users.view_purchase', compact('purchased_items', 'homepage', 'purchase', 'bank_info'));
        }
        else {
            return redirect(action('UsersController@profile'));
        }
    }

    public function update_purchase_info(UploadDepositReceiptFormRequest $request) {
        $id = $request->get('purchase_id');
        $purchase = Purchase::where('id', $id)->firstOrFail();
        if (!empty($request->proof_of_purchase)) {
            //echo "not empty<br>";
            $filename = $request->proof_of_purchase->store('assets/images', 'uploads');
            $purchase->proof_of_purchase = url('/')."/".$filename;
        
            //$s = $request->profile_picture->store('assets/images', 'public');
            //return $s;
        }
        $purchase->purchase_status = 1;//paid, pending
        $purchase->datetime_paid = date('Y-m-d H:i:s');
        $purchase->save();
        return redirect(action('UsersController@profile'))->with('status', 'The receipt has been successfully uploaded. Please wait for our confirmation for your payment, thank you!');
    }

    public function cancel_purchase($id) {
        $purchase = DB::table('purchases')->where('id', $id)->first();
        if (Auth::user()->id == $purchase->user_id || Auth::user()->hasRole('manager')) {
            $purchase = Purchase::whereId($id)->firstOrFail();
            $purchase->delete();
            return redirect(action('UsersController@profile'))->with('status', 'The order has been canceled.');
        }
        else {
            return redirect(action('UsersController@profile'));
        }
    }
}
