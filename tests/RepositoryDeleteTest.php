<?php

namespace OlajosCs\Repository;

use OlajosCs\QueryBuilder\MySQL\RawExpression;
use OlajosCs\Repository\Factories\ConnectionFactory;


/**
 * Class RepositoryDeleteTest
 *
 * Test the deletion of the model
 */
class RepositoryDeleteTest extends RepositoryTestCase
{
    public function testDelete()
    {
        $count = (int)ConnectionFactory::get()
            ->select(new RawExpression('count(1) as counter'))
            ->from('repository_test')
            ->getOneField('counter');

        $test = $this->repository->get(1);

        $this->repository->delete($test);

        $newCount = (int)ConnectionFactory::get()
            ->select(new RawExpression('count(1) as counter'))
            ->from('repository_test')
            ->getOneField('counter');

        $this->assertEquals($count - 1, $newCount);
    }
}
