<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShipOrderResource;
use App\Models\ShipOrder;

class ShipOrderController extends Controller
{
    public function index()
    {
        return ShipOrderResource::collection(ShipOrder::all());
    }

    public function show($id)
    {
        return ShipOrder::where('', $id);
    }
}
