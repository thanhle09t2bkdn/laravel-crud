<?php

namespace App\Repositories;

use App\Models\Food;
use InfyOm\Generator\Common\BaseRepository;

class FoodRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'category_id',
        'content',
        'image'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Food::class;
    }
}
