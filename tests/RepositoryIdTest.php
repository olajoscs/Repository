<?php

namespace OlajosCs\Repository;

/**
 * Class RepositoryIdTest
 *
 * Test for setting and getting the ID of the model
 */
class RepositoryIdTest extends RepositoryTestCase
{
    public function testGetId()
    {
        $test = $this->repository->get(1);

        $this->assertEquals(1, $test->getId());
    }


    public function testSetId()
    {
        $test = $this->repository->get(1);
        $test->setId(2);

        $this->assertEquals(2, $test->getId());
    }
}