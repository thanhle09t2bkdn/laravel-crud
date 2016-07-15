<?php

namespace App\Repositories;

use App\Models\Page;
use InfyOm\Generator\Common\BaseRepository;

class PageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'content'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Page::class;
    }
}
