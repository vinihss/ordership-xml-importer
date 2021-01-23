<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPeopleFile;
use App\Jobs\ProcessShipOrdersFile;
use Illuminate\Http\Request;

class UploadXmlController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function post(Request $request)
    {

        if (!$request->hasFile('file'))
            throw new \Exception('File not found');

        $file = $request->file('file');

        if ($file->getClientOriginalExtension() !== 'xml')
            throw new \Exception('Invalid file extension');

        switch ($request->get('fileType')) {
            case 'people':
            {
                ProcessPeopleFile::dispatch($file->getContent());
                break;
            }
            case 'shipOrder':
            {
                ProcessShipOrdersFile::dispatch($file->getContent());
                break;
            }
            default: {
                throw new \Exception('Invalid file type');
            }
        }

        return response('You file will be processed', 200);
    }
}
