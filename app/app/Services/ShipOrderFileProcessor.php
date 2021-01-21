<?php


namespace App\Services;

use App\Models\Item;
use App\Models\People;
use App\Models\ShipOrder;
use Illuminate\Support\Facades\DB;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Throwable;

class ShipOrderFileProcessor
{

    public function process($xml)
    {

        $xml = XmlParser::extract($xml);


        DB::beginTransaction();

        try {
            foreach ($xml->getContent()->shiporder as $orderData) {

                $person = People::where('person_id', '=', $orderData->orderperson)->first();

                if (empty($person)) {
                    return 'Order person not found';
                }

                $order = ShipOrder::create([
                    'order_id' => $orderData->orderid,
                    'person_id' => $person->id,
                    'name' => $orderData->name,
                    'address' => $orderData->shipto->address,
                    'city' => $orderData->shipto->city,
                    'country' => $orderData->shipto->country,
                ]);

                foreach ($orderData->items->item as $item)
                    Item::create([
                        'order_id' => $order->id,
                        'title' => $item->title,
                        'note' => $item->note,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ]);
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * Handle a job failure.
     *
     * @param \Throwable $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        info('falhou');
        // Send user notification of failure, etc...
    }
}
