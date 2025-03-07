<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Filter extends Component
{
    public string $modelClass;
    public ?Category $category = null;
    public Collection $allProducts;

    public array $filterWeights = [];

    public int $allProductsMinPrice;
    public int $allProductsMaxPrice;

    public int $productsMinPrice;
    public int $productsMaxPrice;

    #[Url]
    public string $search = '';
    #[Url]
    public string $categoryId = '';
    #[Url]
    public array $brands = [];
    #[Url]
    public array $properties = [];
    #[Url]
    public int $minPrice = 1;
    #[Url]
    public int $maxPrice = 999999;


    public function mount(string $modelClass, Collection $allProducts, ?Category $category = null)
    {
        $this->modelClass = $modelClass;
        $this->category = $category;
        $this->allProducts = $allProducts;

        $prices = $allProducts->pluck('price')->toArray();
        if (empty($prices))
            $prices = [1, 999999];
        $this->productsMinPrice = min($prices);
        $this->productsMaxPrice = max($prices);
    }

    public function render()
    {
        $filters = $this->getFilters();
        $filterWeights = $this->getFiltersWeight($filters);
        $filterPrices = $this->getFilterPrices();
        $filterBrands = $this->getBrands();
        $isNotBrands = $this->modelClass !== Brand::class;

        return view('livewire.filter', compact('filters', 'filterWeights', 'filterPrices', 'filterBrands', 'isNotBrands'));
    }

    public function filterCatalog()
    {
        $this->dispatch(
            'filterCatalog',
            search: $this->search,
            categoryId: $this->categoryId,
            brands: $this->brands,
            properties: $this->properties,
            minPrice: $this->minPrice,
            maxPrice: $this->maxPrice,
        )->to(Catalog::class);
    }

    #[On('set-products-prices')]
    public function setProductsPrices(int $min, int $max)
    {
        $this->productsMinPrice = $min;
        $this->productsMaxPrice = $max;

        if ($this->minPrice < $min)
            $this->minPrice = $min;

        if ($this->maxPrice > $max)
            $this->maxPrice = $max;

        $this->render();
    }

    private function isAppliedAnyFilters(): bool
    {
        return request('search') || request('brands') || request('category_id') || request('properties');
    }

    private function getProperties()
    {
        if (count($this->filterProperties) > 0)
            return Arr::mapWithKeys($this->filterProperties, function ($values, int $propId) {
                return [$propId => array_keys(array_filter($values))];
            });

        return false;
    }

    public function getFilters()
    {
        $filters = null;

        if ($this->modelClass == Category::class || $this->modelClass == Brand::class) {
            $filters = $this->getStaticFilters();
        } elseif ($this->modelClass == Product::class) {
            $filters = $this->getDynamicFilters();
        }

        $filterWeights = $this->getFiltersWeight($filters, $this->allProducts);
        $filters = $filters->filter(function ($filter) use($filterWeights) {
            $filter->values = $filter->values->filter(function ($filterValue) use ($filter, $filterWeights) {
                return $filterWeights[$filter->id][$filterValue->id] > 0;
            });
            return $filter->values->isNotEmpty();
        });

        $filters->each(function($property) use($filterWeights) {
            $property->values = $property->values->sortBy(function($value) {
                if (preg_match('/(\d+)\s.*/', $value->value, $matches)) {
                    return (int) $matches[1];
                }
                return $value->value;
            });
        });

        return $filters;
    }

    public function getStaticFilters(): Collection
    {
        return $this->category
            ->filter_properties()
            ->with('values')
            ->orderBy('name')
            ->get();
    }

    public function getDynamicFilters(): Collection
    {
        return Property::whereHas('values')
            ->with('values')
            ->orderBy('name')
            ->get();
    }

    public function getFiltersWeight($properties, ?Collection $products = null): array
    {
        if (!$products)
            $products = $this->allProducts;

        $productValuesArray = $products->load('values:id')->pluck('values', 'id')->toArray();
        $result = [];

        foreach ($properties as $property) {
            $result[$property->id] = [];
            foreach ($property->values as $propertyValue) {
                $propertyValueId = $propertyValue->id;
                $count = 0;
                foreach ($productValuesArray as $productId => $productValues) {
                    $exists = false;
                    foreach ($productValues as $value) {
                        if ($value['id'] == $propertyValueId)
                            $exists = true;
                    }
                    if ($exists)
                        $count++;
                }
                $result[$property->id][$propertyValue->id] = $count;
            }
        }

        $result['brands'] = [];
        foreach (Brand::all() as $brand) {
            $result['brands'][$brand->id] = $products->where('brand_id', $brand->id)->count();
        }

        return $result;
    }

    function getFilterPrices()
    {
        return [
            'min' => $this->productsMinPrice,
            'max' => $this->productsMaxPrice,
            'filteredMin' => $this->productsMinPrice,
            'filteredMax' => $this->productsMaxPrice,
            'currentMin' => (int) $this->minPrice,
            'currentMax' => (int) $this->maxPrice,
        ];
    }

    private function getBrands()
    {
        return Brand::select(['id', 'name'])
            ->whereIn('id', array_unique($this->allProducts->pluck('brand_id')->toArray()))
            ->orderBy('name')
            ->get();
    }

}
