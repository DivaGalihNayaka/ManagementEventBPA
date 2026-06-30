<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Menampilkan daftar event beserta Carousel Event Terdekat
     */
    public function index()
    {
        // 1. Ambil 3 event yang tanggal mulainya HARI INI atau KE DEPAN (Paling dekat)
        $upcomingEvents = Event::with('user')
            ->where('start_date', '>=', date('Y-m-d'))
            ->orderBy('start_date', 'asc')
            ->take(3)
            ->get();

        // 2. Ambil seluruh event untuk ditampilkan di Grid bawah
        $events = Event::with('user')->orderBy('start_date', 'asc')->get();
        
        return view('events.index', compact('events', 'upcomingEvents'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'start_time'  => 'required',
            'end_time'    => 'required',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events_cover', 'public');
            $validatedData['image'] = $imagePath;
        }

        $validatedData['user_id'] = auth()->id();

        Event::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Event berhasil dipublikasikan!');
    }

    public function calendar()
    {
        $events = Event::with('user')->orderBy('start_date', 'asc')->get();
        return view('events.calendar', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('user');
        return view('events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses untuk menghapus event ini!');
        }

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();
        return redirect()->route('dashboard')->with('success', 'Event berhasil dihapus!');
    }
}