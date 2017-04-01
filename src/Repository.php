<?php

namespace OlajosCs\Repository;

use OlajosCs\QueryBuilder\Contracts\Connection;
use OlajosCs\QueryBuilder\Exceptions\QueryBuilderException;
use OlajosCs\Repository\Contracts\RepositoryInterface;
use OlajosCs\Repository\Exceptions\MappingException;

/**
 * Class Repository
 *
 * Basic abstract repository
 */
abstract class Repository implements RepositoryInterface
{
    /**
     * Defaul order
     */
    const DEFAULT_ORDER = 'ASC';

    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var Model
     */
    protected $dummy;


    /**
     * Return which model class belongs to the repository
     *
     * @return string
     */
    abstract protected function getModelClass();


    /**
     * Create a new Repository object
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $class            = $this->getModelClass();

        $this->dummy = new $class();
    }


    /**
     * Return a new empty model
     *
     * @return Model
     */
    public function create()
    {
        return clone $this->dummy;
    }


    /**
     * Return the entity with the ID in the parameter
     *
     * @param int|string $id
     *
     * @return Model
     * @throws MappingException If the object with the given ID is not found
     */
    public function get($id)
    {
        try {
            $model = $this->connection
                ->select()
                ->from($this->dummy->getTableName())
                ->where($this->dummy->getIdField(), '=', $id)
                ->getOneClass($this->getModelClass());
        } catch (QueryBuilderException $e) {
            throw new MappingException($e->getMessage());
        }

        return $model;
    }


    /**
     * Return the entity with the ID in the parameter. If it does not exist a new instance is returned.
     *
     * @param int|string $id
     *
     * @return Model
     */
    public function getOrNew($id = null)
    {
        try {
            $model = $this->get($id);
        } catch (MappingException $e) {
            $modelClass = $this->getModelClass();
            $model      = new $modelClass();
        }

        return $model;
    }


    /**
     * Return an array of the model which belongs to the repository
     *
     * @return Model[]
     */
    public function getList()
    {
        return $this->connection
            ->select()
            ->from($this->dummy->getTableName())
            ->orderBy($this->dummy->getIdField(), static::DEFAULT_ORDER)
            ->getAsClasses($this->getModelClass());
    }


    /**
     * Save the model into the database
     *
     * @param Model $model
     *
     * @return void
     * @throws \OlajosCs\Repository\Exceptions\ValidationException
     */
    public function save(Model $model)
    {
        $model->validate();

        if ($model->exists()) {
            if ($model->isModified()) {
                $this->connection
                    ->update($this->dummy->getTableName())
                    ->where($model::getIdField(), '=', $model->getId())
                    ->set($model->getSaveableProperties())
                    ->execute();
            }
        } else {
            $this->connection
                ->insert($model->getSaveableProperties())
                ->into($this->dummy->getTableName())
                ->execute();

            $model->setId($this->connection->getPdo()->lastInsertId());
        }
    }


    /**
     * Delete the instance from the database
     *
     * @param Model $model
     *
     * @return void
     */
    public function delete(Model $model)
    {
        $this->connection
            ->delete()
            ->from($this->dummy->getTableName())
            ->where($model::getIdField(), '=', $model->getId())
            ->execute();
    }


    /**
     * Return the instances, which have the ID in the parameter array
     *
     * @param array $ids The IDs which are needed
     *
     * @return Model[]
     */
    public function getWhereIdIn(array $ids)
    {
        return $this->connection
            ->select()
            ->from($this->dummy->getTableName())
            ->whereIn($this->dummy->getIdField(), $ids)
            ->getAsClasses($this->getModelClass());
    }

    /**
     * Return the models, which have the ID in the parameter array.
     * The keys of the returning array are the IDs of the models.
     *
     * @param array $ids
     *
     * @return Model[]
     */
    public function getWhereIdInWithKeys(array $ids)
    {
        $models = $this->getWhereIdIn($ids);

        $returning = [];
        foreach ($models as $model) {
            $returning[$model->getId()] = $model;
        }

        return $returning;
    }
}
