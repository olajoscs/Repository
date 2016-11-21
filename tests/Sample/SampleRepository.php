<?php

namespace OlajosCs\Repository\Sample;

use OlajosCs\Repository\Repository;

/**
 * Class SampleService
 *
 * The repository used in the test cases
 */
class SampleRepository extends Repository
{
    /**
     * @inheritdoc
     */
    protected function getModelClass()
    {
        return SampleClass::class;
    }


    /**
     * Create a new SampleClass object.
     * Mainly for typehinting
     *
     * @return SampleClass
     */
    public function create()
    {
        return parent::create();
    }
}
