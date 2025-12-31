<?php

namespace App\Http\Dto\Product;

use App\Http\Dto\BaseDto;

class ProductDto extends BaseDto
{
	public function __construct(
		public string $name,
        public array $images,
        public string $removedImages,
        public string $description,
        public int $categoryId,
        public int $unitId,
        public string $barcode,
        public float $price,
        public float $costPrice,
        public float $stockQuantity,
        public float $minQuantity,
        public bool $isActive
    ) {}
}