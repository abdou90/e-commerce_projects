<?php

namespace App\Twig;

use App\Repository\CategoryRepository;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;

class AppExtensions extends AbstractExtension implements GlobalsInterface
{


    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice']),
        ];
    }

    public function formatPrice(float $price, string $currency = 'DHS'): string
    {
        return number_format($price, 2, ',', ' ') . ' ' . $currency;
    }


    public function getGlobals(): array
    {
        return [
            'allCategories' => $this->categoryRepository->findAll(),
        ];
    }

}