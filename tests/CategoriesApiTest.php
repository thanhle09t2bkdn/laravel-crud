<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriesApiTest extends TestCase
{
    use MakeCategoriesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCategories()
    {
        $categories = $this->fakeCategoriesData();
        $this->json('POST', '/api/v1/categories', $categories);

        $this->assertApiResponse($categories);
    }

    /**
     * @test
     */
    public function testReadCategories()
    {
        $categories = $this->makeCategories();
        $this->json('GET', '/api/v1/categories/'.$categories->id);

        $this->assertApiResponse($categories->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCategories()
    {
        $categories = $this->makeCategories();
        $editedCategories = $this->fakeCategoriesData();

        $this->json('PUT', '/api/v1/categories/'.$categories->id, $editedCategories);

        $this->assertApiResponse($editedCategories);
    }

    /**
     * @test
     */
    public function testDeleteCategories()
    {
        $categories = $this->makeCategories();
        $this->json('DELETE', '/api/v1/categories/'.$categories->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/categories/'.$categories->id);

        $this->assertResponseStatus(404);
    }
}
