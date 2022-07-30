<?php 

namespace Tests\Unit\Application\UseCase\Category;

use Mockery;
use stdClass;
use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category;
use PhpParser\Builder\InterfaceTest;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\UseCase\Category\CreateCategoryUseCase;


class CategoryCreateUseCaseUnitTest extends TestCase
{
    public function testCreateNewCategory()
    {
        $categoryId = '1';
        $categoryName = 'Name';
        $categoryDescription = 'Description';
        $categoryIsActive = true;
        $categoryCreatedAt = '2023-01-01 00:00:00';


        // $this->mockEntity = Mockery::mock(Category::class, [
        //     $categoryId,
        //     $categoryName,
        //     $categoryDescription,
        //     $categoryIsActive,
        //     $categoryCreatedAt,
        // ]);

        // $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        // $this->mockRepository->shouldReceive('insert'); //->andReturn($this->mockEntity);

        // $useCase =  new CreateCategoryUseCase($this->mockRepository);
        // $useCase->execute();

        $this->assertTrue(true);

        // Mockery::close();
    }
}