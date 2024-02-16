<?php

namespace tests\Post\Domain;

use App\Post\Domain\PostAggregate;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostAggregateTest extends KernelTestCase
{

    public function testMamePostAggregate()
    {
        $postAggregate = PostAggregate::make();
        print(json_encode($postAggregate));
        $postAggregate->changeTitle('!!!!');
        $this->assertEquals('!!!!', $postAggregate->getTitle());
    }

}