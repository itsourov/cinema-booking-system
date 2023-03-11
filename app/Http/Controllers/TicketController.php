<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Show;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $price = 0;
        foreach ($ticket->seat_number as $key => $seat) {
            $row = substr($seat, 0, 1);
            $col = substr($seat, 1, 2);
            $price += json_decode(Show::where('id', $ticket->show->id)->first()->seat)->$row->$col->price;
        }


        $dateTime =  Carbon::now()->toDateTimeString();
        return view('ticket.payment', [
            'ticket' => $ticket,
            'dateTime' => $dateTime,
            'price' => $price,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());
        return redirect(route('ticket.show', $ticket->id))->with('message', 'Ticket Payment Done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
