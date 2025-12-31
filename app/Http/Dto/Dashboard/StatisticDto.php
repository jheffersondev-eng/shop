<?php

namespace App\Http\Dto\Dashboard;

use App\Http\Dto\BaseDto;
use Carbon\Carbon;

class StatisticDto extends BaseDto
{
	public function __construct(
        public int $quantityNewProductsCurrentMonth,
        public float $percentageGrowthNewProducts,
        public int $quantityNewUsersCurrentMonth,
        public float $percentageGrowthNewUsers,
        public int $quantityNewSalesCurrentMonth,
        public float $percentageGrowthNewSales,
        ) {}
}