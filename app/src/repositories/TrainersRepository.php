<?php

namespace App\Repositories;

use App\Models\Trainers;

class TrainersRepository extends BaseRepository
{
    public function __construct(Trainers $model)
    {
        parent::__construct($model);
    }
}
