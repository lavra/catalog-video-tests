<?php 

namespace Tests\Unit\Application\UseCase\Category;

use Mockery;
use stdClass;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use PhpParser\Builder\InterfaceTest;
use Core\Domain\Entity\Category as EntityCategory;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\UseCase\Category\CreateCategoryUseCase;
use Core\Application\DTO\Category\{
    CreateCategoryInputDto,
    CreateCategoryOutputDto
};

class CreateCategoryUseCaseUnitTest extends TestCase
{

    public function testCreateNewCategory()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'Name';
        $categoryDescription = 'Description';
        $categoryIsActive = true;

        $this->mockEntity = Mockery::mock(EntityCategory::class, [
            $uuid,
            $categoryName,
        ]);

        $this->mockEntity->shouldReceive('id')->andReturn($uuid);

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);      
        $this->mockRepository->shouldReceive('insert')->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(CreateCategoryInputDto::class, [
            $categoryName,
        ]);

        
        $useCase =  new CreateCategoryUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CreateCategoryOutputDto::class, $response);
        $this->assertEquals($categoryName, $response->name);
        $this->assertEquals('', $response->description);

        /**
         * Spies
         * Verifica se chamou o método
         * 
         */
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);      
        $this->spy->shouldReceive('insert')->andReturn($this->mockEntity);

        $useCase =  new CreateCategoryUseCase($this->spy);
        $response = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('insert');

        Mockery::close();
    }
}