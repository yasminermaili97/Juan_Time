<?php

namespace App\Repositories;

use App\Models\Watch;
class WatchRepository
{
    /**
     * Retrieves all watches, including their features and straps.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Watch::with('feature', 'strap','type')->get();
    }

    /**
     * Creates a new watch.
     *
     * @param Watch $watch The watch object to create.
     * @return bool True if the watch was created successfully, false otherwise.
     */
    public function create(Watch $watch)
    {
        return $watch->save();
    }

    /**
     * Deletes an existing watch.
     *
     * @param Watch $watch The watch object to delete.
     * @return bool True if the watch was deleted successfully, false otherwise.
     */
    public function delete(Watch $watch)
    {
        return $watch->delete();
    }

    /**
     * Updates an existing watch.
     *
     * @param Watch $watch The watch object to update.
     * @return bool True if the watch was updated successfully, false otherwise.
     */
    public function update(Watch $watch)
    {
        return $watch->save();
    }

    /**
     * Finds a watch by its ID.
     *
     * @param int $id The ID of the watch to find.
     * @return Watch|null The found watch, or null if not found.
     */
    public function find($id)
    {
        return Watch::with(['feature', 'strap', 'type'])->find($id);
    }

    /**
     * Checks if a watch with the given model and brand exists.
     *
     * @param Watch $watch The watch object to check.
     * @return bool True if the watch exists, false otherwise.
     */
    public function exists(Watch $watch)
    {
        return Watch::where('model', $watch->model)
            ->where('brand', $watch->brand)
            ->exists();
    }

    /**
     * Checks if a watch with the given ID exists.
     *
     * @param int $id The ID of the watch to check.
     * @return bool True if the watch exists, false otherwise.
     */
    public function existsById($id)
    {
        return Watch::where('id', $id)->exists();
    }

    /**
     * Gets all watches with a price greater than the given price, sorted by brand.
     *
     * @param float $price The minimum price.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllByPrice($price)
    {
        return Watch::where('price', '>', $price)
            ->orderBy('brand', 'ASC')
            ->get();
    }
}




