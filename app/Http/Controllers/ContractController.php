<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contract\StoreRequest;
use App\Models\Contract;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index(Room $room) {

        $contracts = $room->contracts()->get();
    // To Get Latest Data DCS
//        $contracts = $room->contracts()->latest()->get();

        $title = "Contracts For {$room->name}";
        return response()
            ->view('contract.index',[
                'contracts' => $contracts,
                'room' => $room,
                'title' => $title
            ]);
    }
    public function join(Request $request,Room $room) {
        $contracts = $room->contracts()->get()->groupBy('start_date');
        $request->merge(['join' => true]);

    // To Get Latest Data DCS
//        $contracts = $room->contracts()->latest()->get();

        $title = "Contracts For {$room->name}";
        return response()
            ->view('contract.index',[
                'contracts' => $contracts,
                'room' => $room,
                'title' => $title
            ]);
    }
    public function create(Room $room) {
        $title = "Create New Contract";
        return response()
            ->view('contract.create',[
                'room' => $room,
                'title' => $title
            ]);
    }
    public function store(StoreRequest $request,Room $room) {
        $attributes = $request->validated();
        $date = new Carbon($request->start_date);
        $latest_contract = $room->contracts()->latest()->first() ?? '';
        $latest_date = new Carbon($latest_contract->start_date ?? '' ) ;
        if(isset($latest_contract) && $date->month == $latest_date->month && $date->year == $latest_date->year )
        {
            if($date->between($latest_contract->start_date,$latest_contract->end_date)){
                $latest_contract->update(['end_date' =>  $attributes['end_date']]);
                $attributes['end_date'] = $latest_contract->start_date;
            }
        }
        $contract = $room->contracts()->create($attributes);
        $title = "Contracts For {$room->name}";
        return redirect()->back()->with('success','Successfully Created');
    }
//    I never Use it at all but i put it if you reading this code
    public function edit(Contract $contract) {
        $title = "Edit Contract {$contract->name}";
        return response()
            ->view('contract.edit',[
                'title' => $title,
                'contract' => $contract
            ]);
    }
    public function update(StoreRequest $request,Contract $contract) {
        $attributes = $request->validated();
        $contract->update($attributes);
        return redirect()->back()->with('success',"Successfully Updated {$contract->name}");
    }
    public function destroy(Contract $contract) {
        $contract->delete();
        return redirect()->back()->with('success',"Successfully Deleted {$contract->name}");
    }
}
