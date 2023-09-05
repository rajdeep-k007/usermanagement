<?php

namespace App\Http\Controllers;

use App\Models\blockedItem;
use Illuminate\Http\Request;

class BlockedItemsController extends Controller
{
    public function show(){
        $blockedItems = blockedItem::paginate(5);
        return view('pages/blockedItemsPage/blockedItems', compact('blockedItems'));
    }

    // To remove item
    public function remove($id){
        $item = blockedItem::find($id);
        if($item){
            $item->delete();
        }
        return redirect('/blockedItemslist');
    }

    // to redirect to create page
    public function createPage(){
        return view('pages/blockedItemsPage/createBlockedItem');
    }
}
