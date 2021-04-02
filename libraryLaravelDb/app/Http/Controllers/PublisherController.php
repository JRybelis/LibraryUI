<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Validator;

class PublisherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //prohibits editing without being logged in.
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if('title' == $request->sort) {
            $publishers = Publisher::orderBy('title')->get();
        } else {
            $publishers = Publisher::all();
        }

        return view('publisher.index', ['publishers' => $publishers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make
        (
            $request->all(),
            [
                'publisher_title' => ['required', 'min:2', 'max:64']
            ],
        );

        if ($validator->fails()){
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        Publisher::new()->refreshAndSavePublisher($request);
        return redirect()-> route('publisher.index')->with('success_message', 'The publisher has been successfully added to the database.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        return view ('publisher.edit', ['publisher' => $publisher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $validator = Validator::make
        (
            $request->all(),
            [
                'publisher_title' => ['required', 'min:2', 'max:64']
            ]
        );

        if ($validator->fails()){
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $publisher->refreshAndSavePublisher($request);
        return redirect()->route('publisher.index')->with('success_message', 'The publisher has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->remove($publisher);
        return redirect()->route('publisher.index')->with('success_message', 'The publisher has been successfully deleted.');
    }
}

