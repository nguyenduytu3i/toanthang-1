<?php

namespace App\Jobs\Page;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Contracts\Repositories\PageRepository;
use App\Traits\UploadableTrait;

class DestroyJob
{
    use Dispatchable, Queueable, UploadableTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(PageRepository $repository)
    {
        $item = $repository->find($this->id);
        if (!empty($item->image)) {
            $this->destroyFile($item->image);
        }

        return $repository->destroy($this->id);
    }
}
