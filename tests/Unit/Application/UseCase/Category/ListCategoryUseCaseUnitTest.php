<?php 

namespace Tests\Unit\Application\UseCase\Category;

use Mockery;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\UseCase\Category\ListCategoryUseCase;
use Core\Application\DTO\Category\{
    ListCategoryInputDto,
    ListCategoryOutputDto
};


class ListCategoryUseCaseUnitTest extends TestCase
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
                            
        $this->mockInputDto = Mockery::mock(ListCategoryInputDto::class, [$id]);

        $useCase =  new ListCategoryUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(ListCategoryOutputDto::class, $response);
        $this->assertEquals($id, $response->id);
        $this->assertEquals('test category', $response->name);

    }
}