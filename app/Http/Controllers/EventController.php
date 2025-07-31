<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', Auth::id())->get();
        return view('event.index', compact('events'));
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
             'time' => 'required|date_format:H:i',
        ]);

        $event = Event::create([
            'user_id' => Auth::id(),
            'date'    => $request->date,
            'title'   => $request->title,
            'time'    => $request->time,
        ]);

        return redirect()->route('event.index')
            ->with('success', 'Event added successfully');
    }

    public function edit($id)
{
    $event = Event::where('user_id', Auth::id())->findOrFail($id);
    return view('event.edit', compact('event'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
             'time' => 'required|date_format:H:i',
        ]);

        $event = Event::where('user_id', Auth::id())->findOrFail($id);

        $event->update([
            'date'  => $request->date,
            'title' => $request->title,
            'time'  => $request->time,
        ]);

        return redirect()->route('event.index')
            ->with('success', 'Event updated successfully');
    }

    public function delete($id)
    {
        $event = Event::where('user_id', Auth::id())->findOrFail($id);
        $event->delete();

        return redirect()->route('event.index')
            ->with('success', 'Event deleted successfully');
    }
}
