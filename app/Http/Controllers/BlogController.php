<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::with('media')
                ->join('medias', 'posts.featured_img', '=', 'medias.id')
                ->whereRaw(DB::raw('medias.file_type != 1  and posts.status = 1'))
                ->orderBy('posts.date_published')
                ->paginate(9);
        $homepage = DB::table('homepage')->first();
        return view('blog.index', compact('posts', 'homepage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::with('media')
                ->join('medias', 'posts.featured_img', '=', 'medias.id')
                ->whereRaw(DB::raw('posts.slug = \''.$slug.'\' and medias.file_type != 1  and posts.status = 1'))
                ->firstOrFail();
        $homepage = DB::table('homepage')->first();
        return view('blog.show', compact('post', 'homepage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
