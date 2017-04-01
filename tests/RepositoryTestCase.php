<?php

namespace OlajosCs\Repository;

use OlajosCs\Repository\Factories\ConnectionFactory;
use OlajosCs\Repository\Factories\RepositoryFactory;
use OlajosCs\Repository\Sample\SampleClass;
use OlajosCs\Repository\Sample\SampleRepository;

/**
 * Class RepositoryBase
 *
 * Base of all the tests, seeds the database in setup
 */
abstract class RepositoryTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SampleRepository
     */
    protected $repository;


    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->seed();
        $this->repository = RepositoryFactory::get();
    }


    /**
     * Seed the database
     *
     * @return void
     */
    public function seed()
    {
        $connection = ConnectionFactory::get();

        $connection->execute('DROP TABLE IF EXISTS repository_test');

        $connection->execute(
            'CREATE TABLE repository_test (
                id INT PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(64),
                description TEXT
            )'
        );

        $sample1 = new SampleClass();
        $sample1->setName('aaaa')->setDescription('aaaa aaaa aaaa aaaa');

        $sample2 = new SampleClass();
        $sample2->setName('bbbb')->setDescription('bbbb bbbb bbbb bbbb');

        $sample3 = new SampleClass();
        $sample3->setName('cccc')->setDescription('cccc cccc cccc cccc');

        $connection->insert([
                'name'        => $sample1->getName(),
                'description' => $sample1->getDescription(),
            ]
        )->into('repository_test')->execute();

        $connection->insert([
                'name'        => $sample2->getName(),
                'description' => $sample2->getDescription(),
            ]
        )->into('repository_test')->execute();

        $connection->insert([
                'name'        => $sample3->getName(),
                'description' => $sample3->getDescription(),
            ]
        )->into('repository_test')->execute();
    }
}