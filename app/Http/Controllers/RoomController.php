<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\StoreRequest;
use App\Models\Contract;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index() {
        $rooms = Room::latest()->get();

        $title = "All Rooms";
        return response()
            ->view('room.index',[
                'rooms' => $rooms,
                'title' => $title
            ]);
    }
    public function create() {
        $title = "Create New Room";
        return response()
            ->view('room.create',[
                'title' => $title
            ]);
    }
    public function store(StoreRequest $request) {
        $attributes = $request->validated();
        Room::create($attributes);
        return redirect()->back()->with('success','Successfully Created');
    }
    public function edit(Room $room) {
        $title = "Edit Room {$room->name}";
        return response()
            ->view('room.edit',[
                'title' => $title,
                'room' => $room
            ]);
    }
    public function update(StoreRequest $request,Room $room) {
        $attributes = $request->validated();
        $room->update($attributes);
        return redirect()->back()->with('success',"Successfully Updated {$room->name}");
    }
    public function destroy(Room $room) {
        $room->delete();
        return redirect()->back()->with('success',"Successfully Deleted");
    }
}
