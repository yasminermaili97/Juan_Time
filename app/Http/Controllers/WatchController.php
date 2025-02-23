<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\CreateWatchRequest;
use App\Services\WatchService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WatchController extends Controller
{
    /**
     * WatchService dependency injection
     *
     * @var WatchService
     */
    protected $watchService;

    /**
     * Constructs the WatchController
     *
     * @param WatchService $watchService
     */
    public function __construct(WatchService $watchService)
    {
        $this->watchService = $watchService;
    }

    /**
     * Retrieves all watches
     *
     * @return ApiResponse
     */
    public function getAll()
    {
        $watches = $this->watchService->getAll();
        return ApiResponse::success($watches, "Successfully", Response::HTTP_OK);
    }

    /**
     * Retrieves a watch
     * 
     * @return ApiResponse
     */
    public function get($id)
    {
        $watches = $this->watchService->get($id);
        return ApiResponse::success($watches, "Successfully", Response::HTTP_OK);
    }

    /**
     * Creates a new watch
     *
     * @param CreateWatchRequest $request
     * @return ApiResponse
     */
    public function create(CreateWatchRequest $request)
    {
        $watch = $this->watchService->create($request->all());
        return ApiResponse::success($watch, "Watch created", Response::HTTP_CREATED);
    }

    /**
     * Deletes an existing watch
     *
     * @param int $id
     * @return ApiResponse
     */
    public function delete($id)
    {
        $watch = $this->watchService->delete($id);
        return ApiResponse::success('', "Watch deleted", Response::HTTP_OK);
    }

    /**
     * Updates an existing watch
     *
     * @param Request $request
     * @param int $id
     * @return ApiResponse
     */
    public function update(Request $request, $id)
    {
        $watch = $this->watchService->update($request->all(), $id);
        return ApiResponse::success($watch, "Watch updated", Response::HTTP_OK);
    }

    /**
     * Retrieves watches by price
     *
     * @param float $price
     * @return ApiResponse
     */
    public function getWatchByPrice($price)
    {
        $watches = $this->watchService->getAllByPrice($price);
        return ApiResponse::success($watches, "Successfully", Response::HTTP_OK);
    }
}