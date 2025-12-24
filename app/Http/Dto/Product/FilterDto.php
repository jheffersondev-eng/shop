<?php

namespace App\Http\Dto\Product;

use App\Http\Dto\BaseDto;
use Illuminate\Support\Carbon;

class FilterDto extends BaseDto
{
	public function __construct(
        public int|null $id,
		public string|null $name,
        public int|null $categoryId,
        public int|null $unitId,
        public string|null $barcode,
        public float|null $stockQuantity,
        public float|null $minQuantity,
        public bool|null $isActive,
        public Carbon|null $dateDe,
        public Carbon|null $dateAte,
    ) {}
}