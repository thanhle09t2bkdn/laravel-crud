<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FoodApiTest extends TestCase
{
    use MakeFoodTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFood()
    {
        $food = $this->fakeFoodData();
        $this->json('POST', '/api/v1/foods', $food);

        $this->assertApiResponse($food);
    }

    /**
     * @test
     */
    public function testReadFood()
    {
        $food = $this->makeFood();
        $this->json('GET', '/api/v1/foods/'.$food->id);

        $this->assertApiResponse($food->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFood()
    {
        $food = $this->makeFood();
        $editedFood = $this->fakeFoodData();

        $this->json('PUT', '/api/v1/foods/'.$food->id, $editedFood);

        $this->assertApiResponse($editedFood);
    }

    /**
     * @test
     */
    public function testDeleteFood()
    {
        $food = $this->makeFood();
        $this->json('DELETE', '/api/v1/foods/'.$food->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/foods/'.$food->id);

        $this->assertResponseStatus(404);
    }
}
