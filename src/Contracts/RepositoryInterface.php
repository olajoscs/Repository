<?php

namespace OlajosCs\Repository\Contracts;

use OlajosCs\Repository\Exceptions\MappingException;
use OlajosCs\Repository\Model;

interface RepositoryInterface
{
    /**
     * Return a new empty model
     *
     * @return Model
     */
    public function create();


    /**
     * Return the entity with the ID in the parameter
     *
     * @param int|string $id
     *
     * @return Model
     * @throws MappingException If the object with the given ID is not found
     */
    public function get($id);


    /**
     * Return the entity with the ID in the parameter. If it does not exist a new instance is returned.
     *
     * @param int|string $id
     *
     * @return Model
     */
    public function getOrNew($id = null);


    /**
     * Return an array of the model which belongs to the repository
     *
     * @return Model[]
     */
    public function getList();


    /**
     * Save the model into the database
     *
     * @param Model $model
     *
     * @return void
     */
    public function save(Model $model);


    /**
     * Delete the instance from the database
     *
     * @param Model $model
     *
     * @return void
     */
    public function delete(Model $model);
}