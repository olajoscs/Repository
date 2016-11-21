<?php

namespace OlajosCs\Repository;

use OlajosCs\Repository\Exceptions\MappingException;
use OlajosCs\Repository\Sample\SampleClass;

/**
 * Class RepositoryTest
 *
 * Test the repository get methods
 */
class RepositoryGetTest extends RepositoryTestCase
{
    /**
     * Test that the repository returns a valid model if it is found
     *
     * @return void
     */
    public function testGetReturnsValid()
    {
        $expected = $this->repository->create()->setId('1')->setName('aaaa')->setDescription('aaaa aaaa aaaa aaaa');
        $test     = $this->repository->get(1);
        $this->assertEquals($expected->getProperties(), $test->getProperties());
    }


    /**
     * Test that RepositoryException is thrown when the model is not found
     *
     * @return void
     */
    public function testGetNotFound()
    {
        $this->expectException(MappingException::class);
        $this->repository->get(2222);
    }


    /**
     * Test list
     *
     * @return void
     */
    public function testGetList()
    {
        $expected   = [];
        $expected[] = $this->repository->create()->setId('1')->setName('aaaa')->setDescription('aaaa aaaa aaaa aaaa');
        $expected[] = $this->repository->create()->setId('2')->setName('bbbb')->setDescription('bbbb bbbb bbbb bbbb');
        $expected[] = $this->repository->create()->setId('3')->setName('cccc')->setDescription('cccc cccc cccc cccc');

        $test = $this->repository->getList();

        $expectedProperties = array_map(
            function(SampleClass $sample) {
                return $sample->getProperties();
            },
            $expected
        );

        $testProperties = array_map(
            function(SampleClass $sample) {
                return $sample->getProperties();
            },
            $test
        );

        $this->assertEquals($expectedProperties, $testProperties);
    }


    /**
     * Test that the getOrNew returns a valid model if found
     *
     * @return void
     */
    public function testGetOrNewReturnsValid()
    {
        $expectedExisting = $this->repository->create()
            ->setId('1')
            ->setName('aaaa')
            ->setDescription('aaaa aaaa aaaa aaaa');
        $testExisting     = $this->repository->get(1);
        $this->assertEquals($expectedExisting->getProperties(), $testExisting->getProperties());
    }


    /**
     * Test that the getOrNew returns a new instance if model is not found
     *
     * @return void
     */
    public function testGetOrNewReturnsNew()
    {
        $expectedNew = $this->repository->create();
        $testNew     = $this->repository->getOrNew(2222);
        $this->assertEquals($expectedNew->getProperties(), $testNew->getProperties());
    }


    /**
     * Testh when the getOrNew does not get any parameter
     *
     * @return void
     */
    public function testGetOrNewWithoutArg()
    {
        $expectedNew = $this->repository->create();
        $testNew     = $this->repository->getOrNew();
        $this->assertEquals($expectedNew->getProperties(), $testNew->getProperties());
    }
}