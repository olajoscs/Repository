<?php

namespace OlajosCs\Repository;

/**
 * Class RepositoryJsonTest
 *
 * Test for json_encode
 */
class RepositoryJsonTest extends RepositoryTestCase
{
    public function testJson()
    {
        $test = $this->repository->get(1);

        $expected = '{"id":"1","name":"aaaa","description":"aaaa aaaa aaaa aaaa"}';

        $this->assertEquals($expected, json_encode($test));
    }
}