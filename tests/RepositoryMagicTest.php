<?php

namespace OlajosCs\Repository;

use OlajosCs\Repository\Exceptions\MagicMethodCalledException;

/**
 * Class RepositoryExceptionTest
 *
 * Test for of the magic methods
 */
class RepositoryExceptionTest extends RepositoryTestCase
{
    public function testMagicGetException()
    {
        $this->expectException(MagicMethodCalledException::class);
        $id = $this->repository->get(1)->id;
    }


    public function testMagicSetException()
    {
        $this->expectException(MagicMethodCalledException::class);
        $this->repository->get(1)->id = 5;
    }


    public function testMagicIssetException()
    {
        $this->expectException(MagicMethodCalledException::class);
        $exists = isset($this->repository->get(1)->id);
    }
}