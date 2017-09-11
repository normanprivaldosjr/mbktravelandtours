<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestimonialsFormRequest;
use App\Testimonial;

class TestimonialsController extends Controller
{
    public function store(TestimonialsFormRequest $request)
    {
        $slug = uniqid();
        $testimonial = new Testimonial(array(
            'message' => $request->get('message'),
            'full_name' => $request->get('full_name')
        ));

        $testimonial->save();

        return redirect('/testimonials')->with('status', 'Your testimonial has been sent! We\'ll post it as soon as we are done reviewing it, thank you!');
    }
}
