<?php

namespace App\Services;

use App\Exceptions\WatchExistException;
use App\Exceptions\WatchNotFoundException;
use App\Models\Watch;
use App\Repositories\WatchRepository;
use Illuminate\Http\Response;


class WatchService
{

    protected $watchRepository;

    public function __construct(WatchRepository $watchRepository)
    {
        $this->watchRepository = $watchRepository;
    }

    /**
     * Retrieves all watches.
     *
     * @return array|Watch[]
     */
    public function getAll()
    {
        return $this->watchRepository->getAll();
    }

    /** 
    * Retrieves a watch by ID.
    *
    * @param int $id The ID of the watch to retrieve.
    * @return Watch
    */
   public function get($id)
   {
       return $this->findWatch($id);
   }
    /**
     * Creates a new watch.
     *
     * @param array $data The watch data to create.
     * @return Watch The created watch.
     * @throws WatchExistException If the watch already exists.
     */
    public function create( $data)
    {
        $watch = new Watch();
        /*$watch->model = $data['model'];
        $watch->brand = $data['brand'];
        $watch->type = $data['type'];
        $watch->price = $data['price'];*/
        $watch->fill($data);

        if ($this->watchRepository->exists($watch)) {
            throw new WatchNotFoundException("A watch with model='{$watch->model}' and brand='{$watch->brand}' already exists.", Response::HTTP_CONFLICT);
        }

        $this->watchRepository->create($watch);
        return $watch;
    }

    /**
     * Deletes a watch by its ID.
     *
     * @param int $id The ID of the watch to delete.
     * @return bool True if the watch was deleted successfully, false otherwise.
     * @throws WatchNotFoundException If the watch is not found.
     */
    public function delete($id)
    {
        $watch = $this->findWatch($id);
        return $this->watchRepository->delete($watch);
    }

    /**
     * Updates a watch by its ID.
     *
     * @param array $data The updated watch data.
     * @param int $id The ID of the watch to update.
     * @return Watch The updated watch.
     * @throws WatchNotFoundException If the watch is not found.
     */
    public function update($data, $id)
    {
        $watch = $this->findWatch($id);
        $watch->fill($data);
        $this->watchRepository->update($watch);
        return $watch;
    }


    /**
     * Finds a watch by its ID.
     *
     * @param int $id The ID of the watch to find.
     * @return Watch The found watch.
     * @throws WatchNotFoundException If the watch is not found.
     */
    private function findWatch($id)
    {
        $watch = $this->watchRepository->find($id);
        if (!$watch) {
            throw new WatchNotFoundException("Watch with ID '{$id}' not found.", Response::HTTP_NOT_FOUND);
        }
        return $watch;
    }

    /**
     * Retrieves all watches with a price greater than or equal to the given price.
     *
     * @param float $price The minimum price.
     * @return array|Watch[]
     */
    public function getAllByPrice($price)
    {
        return $this->watchRepository->getAllByPrice($price);
    }
}
