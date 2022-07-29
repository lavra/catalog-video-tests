<?php

namespace Tests\Unit\Domain\Entity;

use Throwable;
use Core\Domain\Entity\Category;
use PHPUnit\Framework\TestCase;
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

        $this->assertEquals('New Cat', $category->name);
        $this->assertEquals('New Desc', $category->description);
        $this->assertEquals(true, $category->isActive);
    }

    public function testActivated()
    {
        $category = new Category(
            name: 'New Cat', 
            isActive: false, 
        );

        $this->assertFalse($category->isActive);
        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function testDisabled()
    {
        $category = new Category(
            name: 'New Cat', 
        );

        $this->assertTrue($category->isActive);

        $category->disabled();

        $this->assertFalse($category->isActive);
    }

    public function testUpdate()
    {
        $uuid = 'uuid.value';

        $category = new Category(
            id: $uuid,
            name: 'New Cat', 
            description: 'New Desc',
            isActive: true

        );

        $category->update(
            name: 'new_name', 
            description: 'new_desc',
        );

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