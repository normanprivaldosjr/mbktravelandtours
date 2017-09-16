<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TourPackage;
use App\Post;
use App\CartItem;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function home()
    {
    	$local_tour_packages = DB::table('tour_packages')->whereRaw(DB::raw('(CURDATE() between selling_day_start and selling_day_end) and destination = 0'))->orderBy('name')->get();
    	$international_tour_packages = DB::table('tour_packages')->whereRaw(DB::raw('(CURDATE() between selling_day_start and selling_day_end) and destination = 1'))->orderBy('name')->get();
    	$homepage = DB::table('homepage')->first();
        $services = DB::table('services')->get();
        $blogs = Post::with('media')
                ->join('medias', 'posts.featured_img', '=', 'medias.id')
                ->whereRaw(DB::raw('medias.file_type != 1  and posts.status = 1'))
                ->limit(3)
                ->orderBy('posts.date_published')
                ->get();
        $airline_partners = DB::table('airline_partners')->get();
        return view('home', compact('homepage', 'local_tour_packages', 'international_tour_packages', 'services', 'airline_partners', 'blogs'));
    }

    public function faqs()
    {
        //1 for flight; 2 for tour; 3 for hotel; 4 for bus; 5 for van
        $flight_faqs = DB::table('faqs')->whereRaw(DB::raw('faq_type = 1 and is_hidden = 0'))->get();
        $tour_faqs = DB::table('faqs')->whereRaw(DB::raw('faq_type = 2 and is_hidden = 0'))->get();
        $hotel_faqs = DB::table('faqs')->whereRaw(DB::raw('faq_type = 3 and is_hidden = 0'))->get();
        $bus_faqs = DB::table('faqs')->whereRaw(DB::raw('faq_type = 4 and is_hidden = 0'))->get();
        $van_faqs = DB::table('faqs')->whereRaw(DB::raw('faq_type = 5 and is_hidden = 0'))->get();
        $homepage = DB::table('homepage')->first();
        return view('faqs', compact('flight_faqs', 'tour_faqs', 'hotel_faqs', 'bus_faqs', 'van_faqs', 'homepage'));
    }

    public function hotel_cancellation_policy()
    {
        $sub = DB::table('sub')->first();
        $homepage = DB::table('homepage')->first();
        return view('sub.hotel_cancellation_policy', compact('sub', 'homepage'));
    }

    public function flight_cancellation_policy()
    {
        $sub = DB::table('sub')->first();
        $homepage = DB::table('homepage')->first();
        return view('sub.flight_cancellation_policy', compact('sub', 'homepage'));
    }

    public function terms_and_conditions()
    {
        $sub = DB::table('sub')->first();
        $homepage = DB::table('homepage')->first();
        return view('sub.terms_and_conditions', compact('sub', 'homepage'));
    }

    public function work_with_us()
    {
        $sub = DB::table('sub')->first();
        $homepage = DB::table('homepage')->first();
        return view('sub.work_with_us', compact('sub', 'homepage'));
    }

    public function testimonials()
    {
        $testimonials = DB::table('testimonials')->where('remark', 1)->orderBy('id', 'desc')->get();
        $homepage = DB::table('homepage')->first();
        return view('testimonials', compact('testimonials', 'homepage'));
    }

    

    

    /*
    public function about()
	{
	    return view('about');
	}

	public function contact()
	{
	    return view('tickets.create');
	}*/
	

}