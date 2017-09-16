<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Testimonial;


class TestimonialsController extends Controller
{

    public function index()
    {
        //0 for pending; 1 for approved; auto delete when denied
        $pending_testimonials = Testimonial::where('remark', 0)->orderBy('id', 'desc')->get();
        $approved_testimonials = Testimonial::where('remark', 1)->orderBy('id', 'desc')->get();
        $denied_testimonials = Testimonial::where('remark', 2)->orderBy('id', 'desc')->get();
        //approved
        //deny
        return view('admin.testimonials', compact('pending_testimonials', 'approved_testimonials', 'denied_testimonials'));
    }

    public function approve($id)
    {
        $testimonial = Testimonial::where('id', $id)->firstOrFail();
        $testimonial->remark = 1;
        $testimonial->save();
        return redirect('/admin/testimonials')->with('status', 'Testimonial has been successfully approved.');
    }

    public function deny($id)
    {
        $testimonial = Testimonial::where('id', $id)->firstOrFail();
        $testimonial->remark = 2;
        $testimonial->save();
        return redirect('/admin/testimonials')->with('status', 'Testimonial has been successfully denied.');
    }

    public function delete($id)
    {
        $testimonial = Testimonial::where('id', $id)->firstOrFail();
        $testimonial->delete();
        return redirect('/admin/testimonials')->with('status', 'Testimonial has been successfully deleted.');
    }
    
}