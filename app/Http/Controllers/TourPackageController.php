<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TourPackage;
use App\CustomTourPackage;
use App\Http\Requests\CustomTourFormRequest;


class TourPackageController extends Controller
{
    public function index()
    {	
    	$destination_query = "";
    	$days_query = "";
    	$nights_query = "";
    	$prices_query = "";

    	$destinations = request()->destination;//2 for all
    	$no_of_days = request()->no_of_days;//0 for all
    	$no_of_nights = request()->no_of_nights;//0 for all
    	$prices = request()->price;//0 for all

    	if (!isset($destinations) || in_array('2', $destinations, true)) {
    		$destination_query = "";
    	}
    	else {
    		$destination_query = " and (destination = ".$destinations[0].")";
    	}

    	if (!isset($no_of_days) || in_array('0', $no_of_days, true)) {
    		$days_query = "";
    	}
    	else {
    		$days_query = " and (";
    		$counter = 0;
    		foreach ($no_of_days as $day) {
    			if ($counter > 0) {
    				$days_query .= " or ";
    			}
    			$days_query .= " no_of_days ".$day." ";
    			$counter++;
    		}
    		$days_query .= ")";
    	}

    	if (!isset($no_of_nights) || in_array('0', $no_of_nights, true)) {
    		$nights_query = "";
    	}
    	else {
    		$nights_query = " and (";
    		$counter = 0;
    		foreach ($no_of_nights as $night) {
    			if ($counter > 0) {
    				$nights_query .= " or ";
    			}
    			$nights_query .= " no_of_nights ".$night." ";
    			$counter++;
    		}
    		$nights_query .= ")";
    	}

    	if (!isset($prices) || in_array('0', $prices, true)) {
    		//echo !(isset($prices)) || in_array(0, $prices);
    		$prices_query = "";
    	}
    	else {
    		$prices_query = " and (";
    		$counter = 0;
    		foreach ($prices as $price) {
    			if ($counter > 0) {
    				$prices_query .= " or ";
    			}
    			$prices_query .= " price_starts ".$price." ";
    			$counter++;
    		}
    		$prices_query .= ")";
    	}

    	$sort_by  = request()->sort_type[0];
    	if (empty($sort_by)) {
    		$sort_by = 'name';
    	}
    	$sort_procedure = request()->sort_procedure[0];
    	if (empty($sort_procedure)) {
    		$sort_procedure = 'asc';
    	}

        $guest = request()->guest[0];
        $duration = request()->duration[0];
        $keyword = request()->keyword[0];
        $travel_date = request()->travel_date[0];
        $date_query = "(CURDATE() between selling_day_start and selling_day_end)";
        $keyword_query = "";
        $travel_date_query = "";
        if (isset($duration) || isset($keyword) || isset($travel_date)) {
            if (isset($duration) && $duration > 0) {
                $days_query = " and (no_of_days <= ".$duration."+1 )";
            }
            if (isset($keyword) && !empty($keyword)) {
                $keyword_query .= " and (name like '%".$keyword."%')";
            }
            else {
                $keyword_query = "";
            }
            if (isset($travel_date) && !empty($travel_date)) {
                $travel_date = date('Y-m-d', strtotime($travel_date));
                $travel_date_query .= " and ('".$travel_date."' between travel_day_start and travel_day_end)";
            }
            else {
                $travel_date_query = "";
            }
        }
        $tour_packages = DB::table('tour_packages')->whereRaw(DB::raw($date_query.$destination_query.$days_query.$nights_query.$prices_query.$travel_date_query.$keyword_query))->orderBy($sort_by, $sort_procedure)->get();
        //to get the query use this function : toSql() instead of get();
        $max_day = DB::table('tour_packages')->max('no_of_days');
        $min_day = DB::table('tour_packages')->min('no_of_days');
        $max_night = DB::table('tour_packages')->max('no_of_nights');
        $min_night = DB::table('tour_packages')->min('no_of_nights');
        $max_price = DB::table('tour_packages')->max('price_starts');
        $min_price = DB::table('tour_packages')->min('price_starts');
        //return $tour_packages;
        //return print_r($_GET);
        $homepage = DB::table('homepage')->first();
        return view('tour_packages.index', compact('homepage', 'tour_packages', 'max_day', 'max_night', 'max_price', 'min_day', 'min_night', 'min_price'));
        
    }

    public function cheap_packages()
    {	

    	$sort_by  = request()->sort_type[0];
    	if (empty($sort_by)) {
    		$sort_by = 'price_starts';
    	}
    	$sort_procedure = request()->sort_procedure[0];
    	if (empty($sort_procedure)) {
    		$sort_procedure = 'asc';
    	}
        $tour_packages = DB::table('tour_packages')->whereRaw(DB::raw('(CURDATE() between selling_day_start and selling_day_end) and price_starts <= 10000'))->orderBy($sort_by, $sort_procedure)->get();
        $homepage = DB::table('homepage')->first();
        return view('tour_packages.cheap_packages', compact('homepage', 'tour_packages', 'max_day', 'max_night', 'max_price', 'min_day', 'min_night', 'min_price'));
        
    }

    public function custom_tour()
    {
        $locations = DB::table('locations')
                                        ->select(DB::raw('CONCAT(location_name, " (", location_code, ")") as location'), 'id')->pluck('location', 'id');
        $homepage = DB::table('homepage')->first();
        // 2 for tour
        $faqs = DB::table('faqs')->whereRaw(DB::raw('faq_type = 2 and is_hidden = 0'))->get();
        $steps = DB::table('steps')->where('step_type', 2)->get();
        return view('tour_packages.custom', compact('homepage', 'faqs', 'steps', 'locations'));
    }

    public function show($slug)
    {
        $tour_package = TourPackage::whereSlug($slug)->firstOrFail();
        $package_types = DB::table('package_types')->where('package_id', $tour_package->id)->get();
        $select_package_types = DB::table('package_types')
                            ->pluck('type_name', 'id');
        $homepage = DB::table('homepage')->first();
        return view('tour_packages.show', compact('tour_package', 'package_types', 'homepage', 'select_package_types'));
    }

    public function store(CustomTourFormRequest $request)
    {
        $custom_tour = new CustomTourPackage(array(
            'name' => $request->get('name'),
            'phone_number' => $request->get('phone_number'),
            'email_address' => $request->get('email_address'),
            'no_of_pax' => $request->get('no_of_pax'),
            'no_of_days'=> $request->get('no_of_days'),
            'no_of_nights'=> $request->get('no_of_nights'),
            'location'=> $request->get('location'),
            'min_budget'=> $request->get('min_budget'),
            'max_budget'=> $request->get('max_budget'),
            'birthday'=> date('Y-m-d', strtotime($request->get('birthday')))
        ));

        $custom_tour->save();

        return redirect('/tour-packages/custom')->with('status', 'Your custom tour has been requested! We will be in touch with you shortly.');
    }
}
