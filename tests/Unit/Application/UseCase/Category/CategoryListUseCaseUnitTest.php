<?php 

namespace Tests\Unit\Application\UseCase\Category;

use Mockery;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\UseCase\Category\CategoryListUseCase;
use Core\Application\DTO\Category\{
    CategoryListInputDto,
    CategoryListOutputDto
};


class CategoryListUseCaseUnitTest extends TestCase
{
    public function testGetById()
    {
        $id = (string) Uuid::uuid4()->toString();

        $this->mockEntity = Mockery::mock(Category::class, [
            $id,
            'test category'
        ]);

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);      
        $this->mockRepository->shouldReceive('findById')
                            ->with($id)
                            ->andReturn($this->mockEntity);
                            
        $this->mockInputDto = Mockery::mock(CategoryListInputDto::class, [$id]);

        $useCase =  new CategoryListUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CategoryListOutputDto::class, $response);
        $this->assertEquals($id, $response->id);
        $this->assertEquals('test category', $response->name);

    }
}