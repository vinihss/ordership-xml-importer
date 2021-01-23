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
                     throw new \Exception('Order person not found');
                }

                $order = ShipOrder::where('order_id', '=', $orderData->orderid)->first();
                if (!empty($order)) {
                    throw new \Exception('Order already exists');
                }

                $order = ShipOrder::create([
                    'order_id' => $orderData->orderid,
                    'person_id' => $person->person_id,
                    'name' => $orderData->name,
                    'address' => $orderData->shipto->address,
                    'city' => $orderData->shipto->city,
                    'country' => $orderData->shipto->country,
                ]);

                foreach ($orderData->items->item as $item)
                    Item::create([
                        'order_id' => $order->order_id,
                        'title' => $item->title,
                        'note' => $item->note,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ]);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            info($e->getMessage());
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
        info('failure');
        // Send user notification of failure, etc...
    }
}
