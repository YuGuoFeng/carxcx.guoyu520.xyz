<?php

namespace App\Admin\Repositories;

use App\Models\WxQrCode as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class WxQrCode extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
