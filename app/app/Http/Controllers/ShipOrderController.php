<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShipOrderResource;
use App\Jobs\ProcessShipOrdersFile;
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

    public function post()
    {
        $file = file_get_contents(base_path() . '/public/teste.xml');
        ProcessShipOrdersFile::dispatch($file);
    }
}
