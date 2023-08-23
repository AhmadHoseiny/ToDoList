<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Item;

class ItemController extends Controller
{
    
    public function index($userID)
    {
        $items = User::find($userID)->items()->orderBy('created_at', 'desc')->get();
        return $items;
    }

    public function create(Request $request, $userID)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $item = Item::create([
            'name' => $request->name,
            'user_id' => $userID
        ]);

    }

    //the update functionality is to specify that a task if finished
    public function update(Request $request, $userID, $itemID)
    {   
        $request->validate([
            'completed' => 'required',
        ]);
        $item = User::find($userID)->items()->where('id', $itemID)->first();
        if($item){
            $item->completed = $request->completed == 1? true : false;
            $item->completed_at = $request->completed == 1? Carbon::now() : null;
            $item->save();
        }
        else{
            return response()->json(['message' => 'Item not found.'], 404);
        }

    }

    public function delete($userID, $itemID)
    {
        $item = User::find($userID)->items()->where('id', $itemID)->first();
        if($item){
            $item->delete();
        }
        else{
            return response()->json(['message' => 'Item not found.'], 404);
        }
    }


}
