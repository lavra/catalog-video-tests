<?php 

namespace Tests\Unit\Application\UseCase\Category;

use Mockery;
use stdClass;
use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category;
use Core\Domain\Repository\PaginationInterface;
use Core\Application\UseCase\Category\ListCategoriesUseCase;
use Core\Application\DTO\Category\{
    ListCategoriesInputDto,
    ListCategoriesOutputDto,
};

class ListCategoriesUseCaseUnitTest extends TestCase
{
    public function testListCategoriesEmpty()
    {
        $this->mockPagination = Mockery::mock(stdClass::class, PaginationInterface::class);
        $this->mockPagination->shouldReceive('items')->andReturn([]);


        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('paginate')->andReturn([$this->mockPagination]);

        $this->mockInputDto = Mockery::mock(ListCategoriesInputDto::class, [

        ]);

        $useCase =  new ListCategoriesUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertCount(0, count($response->items));
        $this->assertInstanceOf(ListCategoriesOutputDto::class, $response);
      

    }    
}