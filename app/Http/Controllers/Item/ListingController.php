<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    public function getActiveListings(){
        return view('dashboard.item.active-listings', [
            'active_menu'   =>  'item.listing.active'
        ]);
    }
}
