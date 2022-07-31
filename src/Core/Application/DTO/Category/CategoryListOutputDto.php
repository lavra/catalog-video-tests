<?php 

namespace Core\Application\DTO\Category;

class CategoryListOutputDto
{
    /**
     * Construtor DTO Category
     *
     * @param string $name
     * @param string $description
     * @param boolean $is_active
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $description = '',
        public bool $is_active = true,
    ) { }
}