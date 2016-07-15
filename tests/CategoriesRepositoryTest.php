<?php

use App\Models\Categories;
use App\Repositories\CategoriesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriesRepositoryTest extends TestCase
{
    use MakeCategoriesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CategoriesRepository
     */
    protected $categoriesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->categoriesRepo = App::make(CategoriesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCategories()
    {
        $categories = $this->fakeCategoriesData();
        $createdCategories = $this->categoriesRepo->create($categories);
        $createdCategories = $createdCategories->toArray();
        $this->assertArrayHasKey('id', $createdCategories);
        $this->assertNotNull($createdCategories['id'], 'Created Categories must have id specified');
        $this->assertNotNull(Categories::find($createdCategories['id']), 'Categories with given id must be in DB');
        $this->assertModelData($categories, $createdCategories);
    }

    /**
     * @test read
     */
    public function testReadCategories()
    {
        $categories = $this->makeCategories();
        $dbCategories = $this->categoriesRepo->find($categories->id);
        $dbCategories = $dbCategories->toArray();
        $this->assertModelData($categories->toArray(), $dbCategories);
    }

    /**
     * @test update
     */
    public function testUpdateCategories()
    {
        $categories = $this->makeCategories();
        $fakeCategories = $this->fakeCategoriesData();
        $updatedCategories = $this->categoriesRepo->update($fakeCategories, $categories->id);
        $this->assertModelData($fakeCategories, $updatedCategories->toArray());
        $dbCategories = $this->categoriesRepo->find($categories->id);
        $this->assertModelData($fakeCategories, $dbCategories->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCategories()
    {
        $categories = $this->makeCategories();
        $resp = $this->categoriesRepo->delete($categories->id);
        $this->assertTrue($resp);
        $this->assertNull(Categories::find($categories->id), 'Categories should not exist in DB');
    }
}
