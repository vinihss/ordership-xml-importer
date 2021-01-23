<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeopleResource;
use App\Models\People;

class PersonController extends Controller
{
    public function index()
    {
        return PeopleResource::collection(People::all());
    }

    public function show($id)
    {
        return new PeopleResource(People::where('person_id', '=', $id)->first());
    }
}
