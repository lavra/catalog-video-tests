<?php 

namespace Tests\Unit\Application\UseCase\Category;


use Mockery;
use stdClass;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\UseCase\Category\DeleteCategoryUseCase;
use Core\Application\DTO\Category\{
    DeleteCategoryInputDto,
    DeleteCategoryOutputDto
};


class DeleteCategoryUseCaseUnitTest extends TestCase
{
    public function testDeleteCategory()
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('delete')->andReturn(true);

        $this->mockInputDto = Mockery::mock(DeleteCategoryInputDto::class, [$uuid]);

        $useCase = new DeleteCategoryUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(DeleteCategoryOutputDto::class, $response);
        $this->assertTrue($response->success);

        /**
         * Spies
         */
        // $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        // $this->spy->shouldReceive('findById')->andReturn($this->mockEntity);
        // $this->spy->shouldReceive('delete')->andReturn($this->mockEntity);

        // $useCase = new DeleteCategoryUseCase($this->spy);
        // $useCase->execute($this->mockInputDto);

        // $this->spy->shouldHaveReceived('findById');
        // $this->spy->shouldHaveReceived('delete');


        Mockery::close();
    }
}
