<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategoriesAPIRequest;
use App\Http\Requests\API\UpdateCategoriesAPIRequest;
use App\Models\Categories;
use App\Repositories\CategoriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CategoriesController
 * @package App\Http\Controllers\API
 */

class CategoriesAPIController extends InfyOmBaseController
{
    /** @var  CategoriesRepository */
    private $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepo)
    {
        $this->categoriesRepository = $categoriesRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/categories",
     *      summary="Get a listing of the Categories.",
     *      tags={"Categories"},
     *      description="Get all Categories",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Categories")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->categoriesRepository->pushCriteria(new RequestCriteria($request));
        $this->categoriesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $categories = $this->categoriesRepository->all();

        return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully');
    }

    /**
     * @param CreateCategoriesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/categories",
     *      summary="Store a newly created Categories in storage",
     *      tags={"Categories"},
     *      description="Store Categories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Categories that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Categories")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Categories"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCategoriesAPIRequest $request)
    {
        $input = $request->all();

        $categories = $this->categoriesRepository->create($input);

        return $this->sendResponse($categories->toArray(), 'Categories saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/categories/{id}",
     *      summary="Display the specified Categories",
     *      tags={"Categories"},
     *      description="Get Categories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Categories",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Categories"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Categories $categories */
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            return Response::json(ResponseUtil::makeError('Categories not found'), 404);
        }

        return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCategoriesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/categories/{id}",
     *      summary="Update the specified Categories in storage",
     *      tags={"Categories"},
     *      description="Update Categories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Categories",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Categories that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Categories")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Categories"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCategoriesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Categories $categories */
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            return Response::json(ResponseUtil::makeError('Categories not found'), 404);
        }

        $categories = $this->categoriesRepository->update($input, $id);

        return $this->sendResponse($categories->toArray(), 'Categories updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/categories/{id}",
     *      summary="Remove the specified Categories from storage",
     *      tags={"Categories"},
     *      description="Delete Categories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Categories",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Categories $categories */
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            return Response::json(ResponseUtil::makeError('Categories not found'), 404);
        }

        $categories->delete();

        return $this->sendResponse($id, 'Categories deleted successfully');
    }
}
