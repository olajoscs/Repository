<?php

namespace OlajosCs\Repository;

/**
 * Class RepositorySaveTest
 *
 * Test the save method of the repository
 */
class RepositorySaveTest extends RepositoryTestCase
{
    public function testIsValidWhenValid()
    {
        $test = $this->repository->create()->setName('a')->setDescription('b');
        $this->assertTrue($test->isValid());
    }


    public function testIsValidWhenNotValid()
    {
        $test = $this->repository->create();
        $this->assertFalse($test->isValid());
    }


    public function testExistsWhenExists()
    {
        $test = $this->repository->get(1);
        $this->assertTrue($test->exists());
    }


    public function testExistsWhenNotExists()
    {
        $test = $this->repository->getOrNew(555);
        $this->assertFalse($test->exists());
    }


    public function testIsModifiedWhenModified()
    {
        $test = $this->repository->get(1);
        $test->setName('bbbb');

        $this->assertTrue($test->isModified());
    }


    public function testIsModifiedWhenNotModified()
    {
        $test = $this->repository->get(1);
        $test->setName('aaaa');

        $this->assertFalse($test->isModified());
    }


    public function testUpdate()
    {
        $test = $this->repository->get(1);
        $test->setName('aaab');

        $this->repository->save($test);

        $read = $this->repository->get(1);

        $this->assertEquals($test->getProperties(), $read->getProperties());
    }


    public function testInsert()
    {
        $test = $this->repository->create()->setName('dddd')->setDescription('dddd dddd dddd dddd');

        $this->repository->save($test);

        $this->assertEquals(4, $test->getId());

    }
}