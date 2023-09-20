<?php

namespace App\Http\Controllers;

use App\Models\blockedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockedItemsController extends Controller
{
    public function show(){
        $blockedItems = blockedItem::withTrashed()->paginate(10);
        return view('pages/blockedItemsPage/blockedItems', compact('blockedItems'));
    }

    // To remove item
    public function remove($id){
        $item = blockedItem::find($id);
        if($item){
            $item->delete();
        }
        return redirect('blockedItemslist');
    }

    // To restore item
    public function restore($id){
        $item = blockedItem::withTrashed()->find($id);
        // dd($item);
        if($item){
            $item->restore();
        }
        return redirect('blockedItemslist');
    }

    // to redirect to create page
    public function createPage(){
        return view('pages/blockedItemsPage/createBlockedItem');
    }

    // To add a new item
    public function create(Request $request){
        $request->validate([
            'block_type' => 'required',
            'block_value' => 'required',
            'blocked_user' => '',
            'block_note' => ''
        ]);

        // $input = $request->all();
        $input = [
            'type' => $request->block_type,
            'value' => $request->block_value,
            'user_id' => Auth::user()->name,
            'note' => $request->block_note?$request->block_note:'null',
        ];
        // dd($input);
        blockedItem::create($input);


        return redirect('blockedItemslist');
    }

}
