<?php 

namespace Tests\Unit\Application\UseCase\Category;

use Mockery;
use stdClass;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category as EntityCategory;
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

        $this->mockEntity = Mockery::mock(EntityCategory::class, [
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
        
        $this->spies($id, $this->mockEntity, $this->mockInputDto);
    }

    /**
     * Spies function
     * Verifica se chamou o método
     *
     * @param $id
     * @param $mockEntity
     * @param $mockInputDto
     * @return void
     */
    protected function spies($id, $mockEntity, $mockInputDto): void
    {
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);      
        $this->spy->shouldReceive('findById')->with($id)->andReturn($mockEntity);

        $useCase =  new ListCategoryUseCase($this->spy);
        $response = $useCase->execute($mockInputDto);
        $this->spy->shouldHaveReceived('findById');
    }

    /**
     * Chamado sempre que nossa class não está sendo utilizado.
     * importante: Implementar quando tiver mais de um teste na class.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }
}