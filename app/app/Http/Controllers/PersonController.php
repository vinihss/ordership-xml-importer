<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeopleResource;
use App\Jobs\ProcessPeopleFile;
use App\Models\People;

class PersonController extends Controller
{
    public function index()
    {
        $this->post();
        //  return PeopleResource::collection(People::all());
    }

    public function show($id)
    {
        return new PeopleResource(People::where('person_id', '=', $id)->first());
    }

    public function post()
    {
        $file = file_get_contents(base_path() . '/public/teste.xml');
        ProcessPeopleFile::dispatch($file);

        return 'get all';
    }
}
