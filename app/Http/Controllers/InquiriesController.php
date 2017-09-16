<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FlightInquiryFormRequest;
use App\Http\Requests\BusInquiryFormRequest;
use App\Http\Requests\VanRentalInquiryFormRequest;
use App\Http\Requests\HotelReservationInquiryFormRequest;
use Illuminate\Support\Facades\DB;
use App\FlightInquiry;
use App\Location;
use App\BusInquiry;
use App\VanRentalInquiry;
use App\HotelReservationInquiry;

class InquiriesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function flight()
    {
    	$locations = DB::table('locations')
    									->select(DB::raw('CONCAT(location_name, " (", location_code, ")") as location'), 'id')->pluck('location', 'id');
        //$locations = Location::select('id', DB::raw('CONCAT(location_name, "(", location_code, ")") as location')->pluck('location', 'id');
        $homepage = DB::table('homepage')->first();
        // 1 for flight
        $faqs = DB::table('faqs')->whereRaw(DB::raw('faq_type = 1 and is_hidden = 0'))->get();
        $steps = DB::table('steps')->where('step_type', 1)->get();
        $airline_partners = DB::table('airline_partners')->get();
        return view('inquiries.flight', compact('homepage', 'faqs', 'steps', 'locations', 'airline_partners'));

    }

    public function bus()
    {
        $bus_travel_locations = DB::table('bus_travel_locations')->orderBy('location_name')->pluck('location_name', 'id');
        //$drop_off_points = DB::table('drop_off_points')->distinct()->orderBy('drop_off_point_name')->pluck('drop_off_point_name', 'id');
        //$locations = Location::select('id', DB::raw('CONCAT(location_name, "(", location_code, ")") as location')->pluck('location', 'id');
        $homepage = DB::table('homepage')->first();
        // 1 for flight
        $faqs = DB::table('faqs')->whereRaw(DB::raw('faq_type = 4 and is_hidden = 0'))->get();
        $steps = DB::table('steps')->where('step_type', 4)->get();
        $bus_travel_locations = json_decode($bus_travel_locations, true);
        $bus_travel_locations = array('' => '-- Select a location --') + $bus_travel_locations;

        //$drop_off_points = json_decode($drop_off_points, true);
        $drop_off_points = array('' => '-- Select a drop off point --');// + $drop_off_points;
        //return $bus_travel_locations;
        return view('inquiries.bus', compact('homepage', 'faqs', 'steps', 'bus_travel_locations', 'drop_off_points'));
       
    }

    public function hotel()
    {
        //$locations = Location::select('id', DB::raw('CONCAT(location_name, "(", location_code, ")") as location')->pluck('location', 'id');
        $homepage = DB::table('homepage')->first();
        // 1 for flight
        $faqs = DB::table('faqs')->whereRaw(DB::raw('faq_type = 3 and is_hidden = 0'))->get();
        $steps = DB::table('steps')->where('step_type', 3)->get();
        return view('inquiries.hotels', compact('homepage', 'faqs', 'steps'));
    }

    public function van_rental()
    {
        //$locations = Location::select('id', DB::raw('CONCAT(location_name, "(", location_code, ")") as location')->pluck('location', 'id');
        $homepage = DB::table('homepage')->first();
        // 1 for flight
        $faqs = DB::table('faqs')->whereRaw(DB::raw('faq_type = 5 and is_hidden = 0'))->get();
        $steps = DB::table('steps')->where('step_type', 5)->get();
        $vans = DB::table('vans')->get();
        return view('inquiries.van_rental', compact('homepage', 'faqs', 'steps', 'vans'));
    }

    public function get_drop_offs(Request $request)
    {
        $origin_id = $request->get('origin_id');
        $destination_id = $request->get('destination_id');
        $rules = "";
        if (isset($origin_id) && $origin_id != 0 && $origin_id != '0' && isset($destination_id) && $destination_id != 0 && $destination_id != '0') {
            //if there is an origin ID set
            $rules .= "origin = ".$origin_id." and destination = ".$destination_id;
        }
        if ($rules != "") {
            $drop_off_points = DB::table('drop_off_points')->whereRaw($rules)->orderBy('drop_off_point_name')->pluck('drop_off_point_name', 'id');
        }
        else {
            $drop_off_points = "none";
            //$drop_off_points = DB::table('drop_off_points')->orderBy('drop_off_point_name')->toSql();//pluck('drop_off_point_name', 'id');
        }
        return json_encode($drop_off_points);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store_flight(FlightInquiryFormRequest $request)
    {
        $flight_inquiry = new FlightInquiry(array(
        	'name' => $request->get('name'),
            'phone_number' => $request->get('phone_number'),
            'email_address' => $request->get('email_address'),
            'flight_type' => $request->get('flight_type'),
            'flight_route'=> $request->get('flight_route'),
            'location_from'=> $request->get('location_from'),
            'location_to'=> $request->get('location_to'),
            'date_departure'=> date('Y-m-d', strtotime($request->get('date_departure'))),
            'date_return'=> date('Y-m-d', strtotime($request->get('date_return'))),
            'birthday'=> date('Y-m-d', strtotime($request->get('birthday'))),
            'adult_no'=> $request->get('adult_no'),
            'child_no'=> $request->get('child_no'),
            'infant_no'=> $request->get('infant_no')
        ));

        $flight_inquiry->save();

        return redirect('/inquiries/airline-ticketing')->with('status', 'Your inquiry has been sent! We will be in touch with you shortly.');
    }

    public function store_bus(BusInquiryFormRequest $request)
    {
        $bus_inquiry = new BusInquiry(array(
            'name' => $request->get('name'),
            'phone_number' => $request->get('phone_number'),
            'email_address' => $request->get('email_address'),
            'travel_type' => $request->get('travel_type'),
            'origin'=> $request->get('origin'),
            'destination'=> $request->get('destination'),
            'drop_off_point'=> $request->get('drop_off_point'),
            'date_departure'=> date('Y-m-d', strtotime($request->get('date_departure'))),
            'date_return'=> date('Y-m-d', strtotime($request->get('date_return'))),
            'birthday'=> date('Y-m-d', strtotime($request->get('birthday'))),
            'id_number'=> $request->get('id_number')

        ));

        $bus_inquiry->save();

        return redirect('/inquiries/bus-booking')->with('status', 'Your inquiry has been sent! We will be in touch with you shortly.');
    }

    public function store_hotel_reservation(HotelReservationInquiryFormRequest $request)
    {
        $bus_inquiry = new HotelReservationInquiry(array(
            'location_name' => $request->get('location_name'),
            'name' => $request->get('name'),
            'phone_number' => $request->get('phone_number'),
            'email_address' => $request->get('email_address'),
            'check_in'=> date('Y-m-d', strtotime($request->get('check_in'))),
            'check_out'=> date('Y-m-d', strtotime($request->get('check_out'))),
            'birthday'=> date('Y-m-d', strtotime($request->get('birthday'))),
            'adult_no' => $request->get('adult_no'),
            'child_no' => $request->get('child_no'),
            'for_work' => $request->get('for_work'),
            'no_of_rooms' => $request->get('no_of_rooms')

        ));

        $bus_inquiry->save();

        return redirect('/inquiries/hotel-reservation')->with('status', 'Your inquiry has been sent! We will be in touch with you shortly.');
    }

    public function store_van_rental(VanRentalInquiryFormRequest $request)
    {
        $van_rental_inquiry = new VanRentalInquiry(array(
            'van_id' => $request->get('van_id'),
            'name' => $request->get('name'),
            'phone_number' => $request->get('phone_number'),
            'email_address' => $request->get('email_address'),
            'location_from'=> $request->get('location_from'),
            'location_to'=> $request->get('location_to'),
            'rental_day_start'=> date('Y-m-d', strtotime($request->get('rental_day_start'))),
            'rental_day_end'=> date('Y-m-d', strtotime($request->get('rental_day_end'))),
            'birthday'=> date('Y-m-d', strtotime($request->get('birthday')))

        ));

        $van_rental_inquiry->save();

        return redirect('/inquiries/van-rental')->with('status', 'Your inquiry has been sent! We will be in touch with you shortly.');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $comments = $ticket->comments()->get();
        return view('tickets.show', compact('ticket', 'comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $ticket->delete();
        return redirect('/tickets')->with('status', 'The ticket '.$slug.' has been deleted!');
    }
}
