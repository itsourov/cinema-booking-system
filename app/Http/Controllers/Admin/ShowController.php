<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Show;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShowRequest;
use App\Http\Requests\UpdateShowRequest;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shows = Show::with('movie')->latest()->paginate(10);

        $dateTime =  Carbon::now()->toDateTimeString();

        return view('admin.shows.index', [
            'shows' => $shows,
            'dateTime' => $dateTime,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShowRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Show $show)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Show $show)
    {
        return view('admin.shows.edit', [
            'show' => $show,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShowRequest $request, Show $show)
    {

        // return $request;
        $show->update($request->validated());


        return redirect(route('admin.shows'))->with('message', 'Show Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Show $show)
    {
        $show->delete();
        return redirect(route('admin.shows'))->with('message', 'Show deleted');
    }
}
