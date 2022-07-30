<?php

namespace Tests\Unit\Domain\Entity;

use Throwable;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category;
use PhpParser\Node\Stmt\TryCatch;
use Core\Domain\Exception\EntityValidationException;


class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $category = new Category(
            name: 'New Cat',
            description: 'New Desc',
            isActive: true 
        );

        $this->assertNotEmpty($category->id());
        $this->assertEquals('New Cat', $category->name);
        $this->assertEquals('New Desc', $category->description);
        $this->assertEquals(true, $category->isActive);
        $this->assertNotEmpty($category->createdAt());

    }

    public function testActivated()
    {
        $category = new Category(
            name: 'New Cat', 
            isActive: false           
        );

        $this->assertFalse($category->isActive);
        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function testDisabled()
    {
        $category = new Category(
            name: 'New Cat'
        );

        $this->assertTrue($category->isActive);

        $category->disabled();

        $this->assertFalse($category->isActive);
    }

    public function testUpdate()
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $category = new Category(
            id: $uuid,
            name: 'New Cat', 
            description: 'New Desc',
            isActive: true,
            createdAt: '2023-01-01 00:00:00'
        );

        $category->update(
            name: 'new_name', 
            description: 'new_desc',
        );

        $this->assertEquals($uuid, $category->id);
        $this->assertEquals('new_name', $category->name);
        $this->assertEquals('new_desc', $category->description);
    }

    public function testExceptionName()
    {
        try {
            new Category(
                name: 'Ne', 
                description: 'New Desc'
            );

            $this->assertTrue(false);
    
        } catch (Throwable $th) {

            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testExceptionDescription()
    {
        try {
            new Category(
                name: 'Name Cat', 
                description: random_bytes(999999)
            );

            $this->assertTrue(false);
    
        } catch (Throwable $th) {

            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}