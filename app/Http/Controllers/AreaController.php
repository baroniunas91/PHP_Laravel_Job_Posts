<?php

namespace App\Http\Controllers;

use App;
use App\Models\Area;
use Illuminate\Http\Request;
use Validator;
use PDF;

class AreaController extends Controller
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

        $areas = Area::paginate(3);

        foreach($areas as $area) {
            $area->postsCount = $area->areaPosts->count();
            $area->postsList = $area->areaPosts;
        }
        return view('area.index', compact('areas', 'lang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $lang = $request->lang;

        return view('area.create', compact('lang'));
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
            'title' => ['required', 'string', 'min:3', 'max:128'],
            'photo' => ['image', 'max:2048']
        ]
        );
 
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
 
 
        $area = new Area;
        $area->title = $request->title;
        $area->photo = '';

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
             $area->photo = $name;
        }
 
        $area->save();
        return redirect()->route('area.index', $lang)->with('success_message', 'You are successfully add new area: ' . $area->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area, Request $request)
    {
        $lang = $request->lang;

        $area->postsList = $area->areaPosts;
        return view('area.show', compact('area', 'lang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */

    public function pdf(Area $area, Request $request)
    {
        $lang = $request->lang;

        $area->postsList = $area->areaPosts;
        $pdf = PDF::loadView('area.pdf', compact('area', 'lang'));
        // failo vardas
        return $pdf->download($area->title.'-'.$area->id.'.pdf');
    }
    
    public function edit(Area $area, Request $request)
    {
        $lang = $request->lang;

        return view('area.edit', compact('area', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $lang = $request->lang;

        $validator = Validator::make($request->all(),
        [
            'title' => ['required', 'string', 'min:3', 'max:128'],
            'photo' => ['image', 'max:2048'],
        ]
        );
 
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
 
 
        $area->title = $request->title;

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
             $area->photo = $name;
        }
 
        $area->save();
        return redirect()->route('area.index', $lang)->with('success_message', 'You are successfully edit area: ' . $area->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area, Request $request)
    {
        $lang = $request->lang;

        if($area->areaPosts->count()){
            return redirect()->route('area.index', $lang)->with('info_message', 'You can\'t delete area because it have a posts'); 
        }
        $area->delete();
        return redirect()->route('area.index', $lang)->with('success_message', 'You are successfully delete area: ' . $area->title);
    }
}
