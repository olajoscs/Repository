<?php

namespace OlajosCs\Repository\Sample;

use OlajosCs\Repository\Exceptions\ValidationException;
use OlajosCs\Repository\Model;

/**
 * Class SampleClass
 *
 * The small sample class for the testing
 */
class SampleClass extends Model
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;


    /**
     * @inheritdoc
     */
    public function validate()
    {
        if (empty($this->name)) {
            throw new ValidationException('name is empty');
        }

        if (empty($this->description)) {
            throw new ValidationException('description is empty');
        }
    }


    /**
     * @inheritdoc
     */
    public static function getIdField()
    {
        return 'id';
    }


    /**
     * @inheritdoc
     */
    public static function getTableName()
    {
        return 'repository_test';
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
