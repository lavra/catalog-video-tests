<?php 

namespace Tests\Unit\Application\UseCase\Category;

use Mockery;
use stdClass;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category;
use PhpParser\Builder\InterfaceTest;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\UseCase\Category\CategoryCreateUseCase;
use Core\Application\DTO\Category\{
    CategoryCreateInputDto,
    CategoryCreateOutputDto
};

class CategoryCreateUseCaseUnitTest extends TestCase
{

    public function testCreateNewCategory()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'Name';
        $categoryDescription = 'Description';
        $categoryIsActive = true;

        $this->mockEntity = Mockery::mock(Category::class, [
            $uuid,
            $categoryName,
        ]);

        $this->mockEntity->shouldReceive('id')->andReturn($uuid);

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);      
        $this->mockRepository->shouldReceive('insert')->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(CategoryCreateInputDto::class, [
            $categoryName,
        ]);

        
        $useCase =  new CategoryCreateUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CategoryCreateOutputDto::class, $response);
        $this->assertEquals($categoryName, $response->name);
        $this->assertEquals('', $response->description);

        /**
         * Spies
         * Verifica se chamou o método
         * 
         */
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);      
        $this->spy->shouldReceive('insert')->andReturn($this->mockEntity);

        $useCase =  new CategoryCreateUseCase($this->spy);
        $response = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('insert');

        Mockery::close();
    }
}