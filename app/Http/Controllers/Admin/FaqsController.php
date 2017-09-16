<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Faq;
use App\Http\Requests\AddNewFaqFormRequest;
use App\Http\Requests\UpdateFaqFormRequest;


class FaqsController extends Controller
{

    public function index()
    {
        //1 for flight; 2 for tour; 3 for hotel; 4 for bus; 5 for van
        $flight_faqs = Faq::where('faq_type', 1)->get();
        $tour_faqs = Faq::where('faq_type', 2)->get();
        $hotel_faqs = Faq::where('faq_type', 3)->get();
        $bus_faqs = Faq::where('faq_type', 4)->get();
        $van_faqs = Faq::where('faq_type', 5)->get();
        return view('admin.faqs', compact('flight_faqs', 'tour_faqs', 'hotel_faqs', 'van_faqs', 'bus_faqs'));
    }

    public function get_faq_info($id)
    {
        $faqs = Faq::whereId($id)->first();
        $data = [];
        $question = $faqs->question;
        $answer = $faqs->answer;

        array_push($data, ['id' => $id, 'question' => $question, 'answer' => $answer]);
        //return date("Y", strtotime($birthday));
        return json_encode($data);
    }

    public function add_faq(AddNewFaqFormRequest $request)
    {
        $faq = new Faq(array(
            'faq_type' => $request->get('faq_type'),
            'question' => $request->get('faq_question'),
            'answer' => $request->get('faq_answer'),
        ));

        $faq->save();
        return redirect('/admin/faqs')->with('status', $request->get('faq_question').' has been successfully added.');
    }

    public function update_faq($id, UpdateFaqFormRequest $request) 
    {
        $faq = Faq::where('id', $id)->firstOrFail();
        $faq->question = $request->get('faq_question');
        $faq->answer = $request->get('faq_answer');
        $faq->save();
        return redirect('/admin/faqs')->with('status', $request->get('faq_question').' has been successfully updated.');
    }

    public function delete_faq($id)
    {
        $faq = Faq::where('id', $id)->firstOrFail();
        $faq->delete();
        return redirect('/admin/faqs')->with('status', 'FAQ has been successfully deleted.');
    }

    public function hide_faq($id)
    {
        //default is 0 == not hidden
        //1 is the hidden value

        $faq = Faq::whereId($id)->firstOrFail();

        //1 for flight; 2 for tour; 3 for hotel; 4 for bus; 5 for van
        $faq_type = $faq->faq_type;
        $faq->is_hidden = 1;
        $faq->save();
        if ($faq_type == 1) {
            return redirect('admin/pages/flight')->with('status', 'Airline Ticketing FAQ was successfully hidden.');
        }
        else if ($faq_type == 2) {
            return redirect('admin/pages/custom-tour')->with('status', 'Custom Tour FAQ was successfully hidden.');
        }
        else if ($faq_type == 3) {
            return redirect('admin/pages/hotel')->with('status', 'Hotel Reservation FAQ was successfully hidden.');
        }
        else if ($faq_type == 4) {
            return redirect('admin/pages/bus')->with('status', 'Bus Booking FAQ was successfully hidden.');
        }
        else {
            return redirect('admin/pages/van')->with('status', 'Van Rental FAQ was successfully hidden.');
        }
        
    }

    public function unhide_faq($id)
    {
        //default is 0 == not hidden
        //1 is the hidden value

        $faq = Faq::whereId($id)->firstOrFail();

        //1 for flight; 2 for tour; 3 for hotel; 4 for bus; 5 for van
        $faq_type = $faq->faq_type;
        $faq->is_hidden = 0;
        $faq->save();
        if ($faq_type == 1) {
            return redirect('admin/pages/flight')->with('status', 'Airline Ticketing FAQ was successfully shown.');
        }
        else if ($faq_type == 2) {
            return redirect('admin/pages/custom-tour')->with('status', 'Custom Tour FAQ was successfully shown.');
        }
        else if ($faq_type == 3) {
            return redirect('admin/pages/hotel')->with('status', 'Hotel Reservation FAQ was successfully shown.');
        }
        else if ($faq_type == 4) {
            return redirect('admin/pages/bus')->with('status', 'Bus Booking FAQ was successfully shown.');
        }
        else {
            return redirect('admin/pages/van')->with('status', 'Van Rental FAQ was successfully shown.');
        }
    }
    
}