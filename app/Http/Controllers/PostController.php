<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Area;
use Illuminate\Http\Request;
use Validator;
use PDF;

class PostController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $lang = $request->lang;
        $this->middleware("setLanguage:$lang");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lang = $request->lang;

        $areas = Area::orderBy('title')->get();

        $area_id = $search = '';

        if($request->area_id) {
            $area_id = (int) $request->area_id;
        }
        if($request->search) {
            $search = $request->search;
        }

        if($search) {
            $posts = $area_id ? 
            Post::where('area_id', $area_id)->where('title', 'LIKE', "%".$search."%")->orderBy('title')->paginate(5)->appends(['area_id' => $area_id, 'search' => $search]) : 
            Post::where('title', 'LIKE', "%".$search."%")->orderBy('title')->paginate(5)->appends(['search' => $search]);
        } else {
            $posts = $area_id ? 
            Post::where('area_id', $area_id)->orderBy('title')->paginate(5)->appends(['area_id' => $area_id]) : 
            Post::orderBy('title')->paginate(5);
        }

        foreach($posts as $post) {
            $post->postAreaName = $post->postArea->title;
        }
        return view('post.index', compact('posts', 'areas', 'area_id', 'search', 'lang')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $lang = $request->lang;

        $areas = Area::all();
        return view('post.create', compact('areas', 'lang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lang = $request->lang;

        $validator = Validator::make($request->all(),
        [
            'title' => ['required', 'min:3', 'max:128'],
            'description' => ['required', 'not_regex:/<p><br><\/p>/i'],
            'salary' => ['required', 'integer', 'min:1'],
            'area_id' => ['required', 'integer', 'min:1', 'max:1000'],
            'photo' => ['image', 'max:2048'],
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
        return redirect()->route('post.index', $lang)->with('success_message', 'You are successfully add new post: ' . $post->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Request $request)
    {
        $lang = $request->lang;

        $post->postAreaTitle = $post->postArea->title;
        return view('post.show', compact('post', 'lang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function pdf(Post $post, Request $request)
    {
        $lang = $request->lang;

        $post->postAreaTitle = $post->postArea->title;
        $pdf = PDF::loadView('post.pdf', compact('post', 'lang'));
        return $pdf->download($post->title.'-'.$post->id.'.pdf');
    }
    
    public function edit(Post $post, Request $request)
    {
        $lang = $request->lang;

        $areas = Area::all();
        return view('post.edit', compact('post', 'areas', 'lang'));
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
        $lang = $request->lang;

        $validator = Validator::make($request->all(),
        [
            'title' => ['required', 'min:3', 'max:128'],
            'description' => ['required', 'not_regex:/<p><br><\/p>/i'],
            'salary' => ['required', 'integer', 'min:1'],
            'area_id' => ['required', 'integer', 'min:1', 'max:1000'],
            'photo' => ['image', 'max:2048'],
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
        return redirect()->route('post.index', $lang)->with('success_message', 'You are successfully edit post: ' . $post->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Request $request)
    {
        $lang = $request->lang;

        $post->delete();
        return redirect()->route('post.index', $lang)->with('success_message', 'You are successfully delete post: ' . $post->task_name);
    }
}
