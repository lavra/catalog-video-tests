<?php 

namespace Core\Application\DTO\Category;

class CategoryListInputDto
{
    /**
     * Construct function
     *
     * @param string $id
     */
    public function __construct(
        public string $id
    ) { }
}