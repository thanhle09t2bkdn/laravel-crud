<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTestAPIRequest;
use App\Http\Requests\API\UpdateTestAPIRequest;
use App\Models\Test;
use App\Repositories\TestRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TestController
 * @package App\Http\Controllers\API
 */

class TestAPIController extends InfyOmBaseController
{
    /** @var  TestRepository */
    private $testRepository;

    public function __construct(TestRepository $testRepo)
    {
        $this->testRepository = $testRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/tests",
     *      summary="Get a listing of the Tests.",
     *      tags={"Test"},
     *      description="Get all Tests",
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
     *                  @SWG\Items(ref="#/definitions/Test")
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
        $this->testRepository->pushCriteria(new RequestCriteria($request));
        $this->testRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tests = $this->testRepository->all();

        return $this->sendResponse($tests->toArray(), 'Tests retrieved successfully');
    }

    /**
     * @param CreateTestAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/tests",
     *      summary="Store a newly created Test in storage",
     *      tags={"Test"},
     *      description="Store Test",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Test that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Test")
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
     *                  ref="#/definitions/Test"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTestAPIRequest $request)
    {
        $input = $request->all();

        $tests = $this->testRepository->create($input);

        return $this->sendResponse($tests->toArray(), 'Test saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/tests/{id}",
     *      summary="Display the specified Test",
     *      tags={"Test"},
     *      description="Get Test",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Test",
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
     *                  ref="#/definitions/Test"
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
        /** @var Test $test */
        $test = $this->testRepository->find($id);

        if (empty($test)) {
            return Response::json(ResponseUtil::makeError('Test not found'), 404);
        }

        return $this->sendResponse($test->toArray(), 'Test retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTestAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/tests/{id}",
     *      summary="Update the specified Test in storage",
     *      tags={"Test"},
     *      description="Update Test",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Test",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Test that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Test")
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
     *                  ref="#/definitions/Test"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTestAPIRequest $request)
    {
        $input = $request->all();

        /** @var Test $test */
        $test = $this->testRepository->find($id);

        if (empty($test)) {
            return Response::json(ResponseUtil::makeError('Test not found'), 404);
        }

        $test = $this->testRepository->update($input, $id);

        return $this->sendResponse($test->toArray(), 'Test updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/tests/{id}",
     *      summary="Remove the specified Test from storage",
     *      tags={"Test"},
     *      description="Delete Test",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Test",
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
        /** @var Test $test */
        $test = $this->testRepository->find($id);

        if (empty($test)) {
            return Response::json(ResponseUtil::makeError('Test not found'), 404);
        }

        $test->delete();

        return $this->sendResponse($id, 'Test deleted successfully');
    }
}
