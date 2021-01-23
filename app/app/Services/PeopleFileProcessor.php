<?php


namespace App\Services;


use App\Models\People;
use App\Models\PersonPhone;
use Illuminate\Support\Facades\DB;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Throwable;

class PeopleFileProcessor
{

    public function process($xml)
    {

        DB::beginTransaction();

        try {

            info('processed');
            $xml = XmlParser::extract($xml);
            foreach ($xml->getContent()->person as $personData) {

                $person = People::create([
                    'person_id' => $personData->personid,
                    'name' => $personData->personid,
                ]);

                foreach ($personData->phones->phone as $phone) {
                    PersonPhone::create([
                        'person_id' => $person->person_id,
                        'phone' => $phone,
                    ]);
                }
            }

            info('END processed');

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            info($e->getMessage());
        }
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        info('failure');
        // Send user notification of failure, etc...
    }
}
