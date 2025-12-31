<?php

namespace App\Services\Dashboard;

use App\Http\Dto\Dashboard\StatisticDto;
use App\Repositories\Product\IProductRepository;
use App\Repositories\User\IUserRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

use function Symfony\Component\Clock\now;

class DashboardService implements IDashboardService
{
    protected IProductRepository $productRepository;
    protected IUserRepository $userRepository;

    public function __construct(
        IProductRepository $productRepository,
        IUserRepository $userRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    public function getStatistics(): StatisticDto
    {
        try {
            $currentMonth = Carbon::now();
            $previousMonth = Carbon::now()->firstOfMonth()->subDay();

            $currentMonthProducts = $this->productRepository->getProductCountByMonth($currentMonth);
            $previousMonthProducts = $this->productRepository->getProductCountByMonth($previousMonth);
            $quantityNewUsersCurrentMonth = $this->userRepository->getUserCountByMonth($currentMonth);
            $previousMonthUsers = $this->userRepository->getUserCountByMonth($previousMonth);
            
            return new StatisticDto(
                quantityNewProductsCurrentMonth: $currentMonthProducts,
                percentageGrowthNewProducts: $this->getPercentageGrowth($currentMonthProducts, $previousMonthProducts),
                quantityNewUsersCurrentMonth: $quantityNewUsersCurrentMonth,
                percentageGrowthNewUsers: $this->getPercentageGrowth($quantityNewUsersCurrentMonth, $previousMonthUsers),
                quantityNewSalesCurrentMonth: 0,
                percentageGrowthNewSales: 0.0,
            );
        } catch (Throwable $e) {
            Log::error('Erro ao listar produtos: '.$e->getMessage());
            throw $e;
        }
    }

    private function getPercentageGrowth(int $currentMonthCount, int $previousMonthCount): float
    {
        if ($previousMonthCount === 0) {
            return $currentMonthCount > 0 ? 100.0 : 0.0;
        }

        return (($currentMonthCount - $previousMonthCount) / $previousMonthCount) * 100;
    }
}