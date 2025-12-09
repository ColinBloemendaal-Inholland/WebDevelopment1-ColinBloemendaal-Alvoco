<?php

namespace App\Repositories;

use App\Models\Wedstrijden;

class WedstrijdenRepository extends BaseRepository
{
    public function __construct(Wedstrijden $model)
    {
        parent::__construct($model);
    }
}
