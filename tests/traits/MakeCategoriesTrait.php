<?php

use Faker\Factory as Faker;
use App\Models\Categories;
use App\Repositories\CategoriesRepository;

trait MakeCategoriesTrait
{
    /**
     * Create fake instance of Categories and save it in database
     *
     * @param array $categoriesFields
     * @return Categories
     */
    public function makeCategories($categoriesFields = [])
    {
        /** @var CategoriesRepository $categoriesRepo */
        $categoriesRepo = App::make(CategoriesRepository::class);
        $theme = $this->fakeCategoriesData($categoriesFields);
        return $categoriesRepo->create($theme);
    }

    /**
     * Get fake instance of Categories
     *
     * @param array $categoriesFields
     * @return Categories
     */
    public function fakeCategories($categoriesFields = [])
    {
        return new Categories($this->fakeCategoriesData($categoriesFields));
    }

    /**
     * Get fake data of Categories
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCategoriesData($categoriesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'image' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $categoriesFields);
    }
}
