<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Area;
use Illuminate\Http\Request;
use Validator;
use PDF;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::orderBy('title')->get();
        $posts = Post::all();
        foreach($posts as $post) {
            $post->postAreaName = $post->postArea->title;
        }
        return view('post.index', compact('posts', 'areas')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all();
        return view('post.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'title' => ['required', 'min:3', 'max:128'],
            'description' => ['required', 'not_regex:/<p><br><\/p>/i'],
            'salary' => ['required', 'min:3', 'max:128'],
            'area_id' => ['required', 'integer', 'min:1', 'max:100']
        ],
        [
            'description.not_regex' => 'Post description field should not be empty!',
        ]
        );
 
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->salary = $request->salary;
        $post->area_id = $request->area_id;
        $post->photo = '';

        if($request->hasFile('photo')) {
             //    nuoroda į failą
            $image = $request->file('photo');
             //    failo vardas
            $name = $request->file('photo')->getClientOriginalName();
             //    sugeneruojam path, kur dėsim failus
             $destinationPath = public_path('/images');
             // perkeliu nuotrauką į sugeneruotą kelią ir palieku jam originalų vardą
             $image->move($destinationPath, $name);
             // į DB įrašau tik vardą failo
             $post->photo = $name;
        }
        $post->save();
        return redirect()->route('post.index')->with('success_message', 'You are successfully add new post: ' . $post->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->postAreaTitle = $post->postArea->title;
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function pdf(Post $post)
    {
        $post->postAreaTitle = $post->postArea->title;
        $pdf = PDF::loadView('post.pdf', compact('post'));
        return $pdf->download($post->title.'-'.$post->id.'.pdf');
    }
    
    public function edit(Post $post)
    {
        $areas = Area::all();
        return view('post.edit', compact('post', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(),
        [
            'title' => ['required', 'min:3', 'max:128'],
            'description' => ['required', 'not_regex:/<p><br><\/p>/i'],
            'salary' => ['required', 'min:3', 'max:128'],
            'area_id' => ['required', 'integer', 'min:1', 'max:100']
        ],
        [
            'description.not_regex' => 'Post description field should not be empty!',
        ]
        );
 
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->salary = $request->salary;
        $post->area_id = $request->area_id;

        if($request->hasFile('photo')) {
             //    nuoroda į failą
            $image = $request->file('photo');
             //    failo vardas
            $name = $request->file('photo')->getClientOriginalName();
             //    sugeneruojam path, kur dėsim failus
             $destinationPath = public_path('/images');
             // perkeliu nuotrauką į sugeneruotą kelią ir palieku jam originalų vardą
             $image->move($destinationPath, $name);
             // į DB įrašau tik vardą failo
             $post->photo = $name;
        }
        $post->save();
        return redirect()->route('post.index')->with('success_message', 'You are successfully edit post: ' . $post->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('success_message', 'You are successfully delete post: ' . $post->task_name);
    }
}
