<?php

namespace OlajosCs\Repository;

use OlajosCs\Repository\Exceptions\MagicMethodCalledException;
use OlajosCs\Repository\Exceptions\ValidationException;

/**
 * Class Model
 *
 * Defines an abstract parent for the model
 */
abstract class Model implements \JsonSerializable
{
    /**
     * @var array The original state, as it was read from the database
     */
    protected $originalState = [];


    /**
     * Validate the model
     *
     * @return void
     * @throws ValidationException
     */
    abstract protected function validate();


    /**
     * Return the name of the id field of the model if exists
     *
     * @return string
     */
    abstract public function getIdField();


    /**
     * Return the name of the table in the database, which stores the model
     *
     * @return string
     */
    abstract public function getTableName();


    /**
     * Create a new Model object
     */
    public function __construct()
    {
        $this->originalState = $this->getSaveableProperties();
    }


    /**
     * Return the name of the properties, which are not important when checking model properties change
     *
     * @return array
     */
    protected function getAdditionalProperties()
    {
        return ['originalState', 'additionalProperties'];
    }


    /**
     * Return the saveable (basic) properties of the model
     *
     * @return array
     */
    public function getSaveableProperties()
    {
        $array = $this->getProperties();
        unset(
            $array[$this->getIdField()]
        );

        return $array;
    }


    /**
     * Return whether the model has an ID or not
     *
     * @return bool
     */
    public function exists()
    {
        return (bool)$this->{$this->getIdField()};
    }


    /**
     * Return whether the model has been modified since the construct or not
     *
     * @return bool
     */
    public function isModified()
    {
        return $this->originalState !== $this->getSaveableProperties();
    }


    /**
     * Return whether the model is valid or not
     *
     * @return bool
     */
    public function isValid()
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            return false;
        }

        return true;
    }


    /**
     * Return the ID of the model
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->{$this->getIdField()};
    }


    /**
     * Set the ID of the model
     *
     * @param mixed $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->{$this->getIdField()} = $id;

        return $this;
    }


    /**
     * Return the basic properties of the model as an array
     *
     * @return array
     */
    public function getProperties()
    {
        $properties = get_object_vars($this);
        foreach ($this->getAdditionalProperties() as $notImportantProperty) {
            unset($properties[$notImportantProperty]);
        }

        return $properties;
    }


    /**
     * Returns the model with basic properties to json_encode
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->getProperties();
    }


    /**
     * Magic get
     *
     * @param string $property
     *
     * @return mixed
     * @throws MagicMethodCalledException
     */
    public function __get($property)
    {
        throw new MagicMethodCalledException(
            sprintf(
                'Magic __get was called with %s property on %s class',
                $property,
                static::class
            )
        );
    }


    /**
     * Magic set
     *
     * @param string $property
     * @param mixed  $value
     *
     * @return void
     * @throws MagicMethodCalledException
     */
    public function __set($property, $value)
    {
        throw new MagicMethodCalledException(
            sprintf(
                'Magic __set was called with %s property on %s class',
                $property,
                static::class
            )
        );
    }


    /**
     * Magic isset
     *
     * @param string $property
     *
     * @return void
     * @throws MagicMethodCalledException
     */
    public function __isset($property)
    {
        throw new MagicMethodCalledException(
            sprintf(
                'Magic __isset was called with %s property on %s class',
                $property,
                static::class
            )
        );
    }
}
