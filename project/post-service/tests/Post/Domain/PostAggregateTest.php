<?php

namespace tests\Post\Domain;

use App\Post\Domain\Exceptions\DomainTitleValidationException;
use App\Post\Domain\PostAggregate;
use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use Random\Randomizer;
use Symfony\Component\Uid\Uuid;

class PostAggregateTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $postId = Uuid::v4();
        $title = $this->getRandomString(10);
        $content = $this->getRandomString(10);
        $authorId = Uuid::v4();
        $isPublished = (bool)(new Randomizer())->getInt(0, 1);
        $createdAt = new DateTimeImmutable('now');
        $updatedAt = new DateTimeImmutable('now');

        $post = PostAggregate::make($postId, $title, $content, $authorId, $isPublished, $createdAt, $updatedAt);

        $this->assertInstanceOf(PostAggregate::class, $post);
        $this->assertEquals($postId, $post->getId());
        $this->assertEquals($title, $post->getTitle());
        $this->assertEquals($content, $post->getContent());
        $this->assertEquals($authorId, $post->getAuthor());
        $this->assertEquals($isPublished, $post->getPublished());
        $this->assertEquals($createdAt->format(DateTimeInterface::ATOM), $post->getCreatedAt()->toISO());
        $this->assertEquals($updatedAt->format(DateTimeInterface::ATOM), $post->getUpdatedAt()->toISO());
    }

    /**
     * @throws DomainTitleValidationException
     */
    public function testChangeTitle(): void
    {
        $post = $this->createSamplePost();
        $newTitle = $this->getRandomString(10);
        $post->changeTitle($newTitle);
        $this->assertEquals($newTitle, $post->getTitle());
    }

    public function testChangeTitleWithInvalidDataThrowsException(): void
    {
        $this->expectException(DomainTitleValidationException::class);
        $post = $this->createSamplePost();
        $post->changeTitle(
            $this->getRandomString((new Randomizer())->getInt(0, 9))
        );
    }

    public function testPublishUnpublish(): void
    {
        $post = $this->createSamplePost();

        $post->published();
        $this->assertTrue($post->getPublished());

        $post->unpublished();
        $this->assertFalse($post->getPublished());
    }

    private function createSamplePost(): PostAggregate
    {
        $postId = Uuid::v4();
        $title = $this->getRandomString(10);
        $content = $this->getRandomString(10);
        $authorId = Uuid::v4();
        $isPublished = (bool)(new Randomizer())->getInt(0, 1);
        $createdAt = new DateTimeImmutable('now');
        $updatedAt = null;

        return PostAggregate::make(
            $postId,
            $title,
            $content,
            $authorId,
            $isPublished,
            $createdAt,
            $updatedAt
        );
    }

    private function getRandomString(int $len): string
    {
        return (new Randomizer())->getBytesFromString('abcdefghijklmnopqrstuvwxyz0123456789', $len);
    }
}
