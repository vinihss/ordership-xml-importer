<?php

namespace App\Jobs;

use App\Models\People;
use App\Services\ShipOrderFileProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessShipOrdersFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;

    /**
     * ProcessPeopleFile constructor.
     * @param People $people
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ShipOrderFileProcessor $fileProcessor)
    {
        $fileProcessor->process($this->file);;
    }
}
