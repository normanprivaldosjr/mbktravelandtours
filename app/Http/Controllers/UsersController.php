<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserEditFormRequest;
use App\TourPackage;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class UsersController extends Controller
{
    public function profile()
    {
        $tour_packages = TourPackage::limit(3)->get();
        $homepage = DB::table('homepage')->first();
        return view('users.profile', compact('tour_packages', 'homepage'));
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
	    if (!empty($request->profile_picture)) {
	    	//echo "not empty<br>";
            $filename = $request->profile_picture->store('assets/images', 'uploads');
            $user->profile_picture = url('/')."/".$filename;
        
	    	//$s = $request->profile_picture->store('assets/images', 'public');
	    	//return $s;
	    }
	    //return $request->profile_picture;
	    $user->save();

	    return redirect(action('UsersController@profile'))->with('status', 'Your profile has been updated!');
	}
}
