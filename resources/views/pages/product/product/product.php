<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVarient;

new class extends Component
{
    use WithPagination;

    public $search = '';
    public $categorySlug = null;
    public $minPrice = null;
    public $maxPrice = null;
    public $sortBy = 'featured';
    public $inStockOnly = false;

    // Track active query string states in the URL
    protected $queryString = [
        'search' => ['except' => ''],
        'categorySlug' => ['except' => null],
        'minPrice' => ['except' => null],
        'maxPrice' => ['except' => null],
        'sortBy' => ['except' => 'featured'],
        'inStockOnly' => ['except' => false],
    ];

    public function updatingSearch() { $this->resetPage(); }
    public function updatingCategorySlug() { $this->resetPage(); }
    public function updatingMinPrice() { $this->resetPage(); }
    public function updatingMaxPrice() { $this->resetPage(); }
    public function updatingSortBy() { $this->resetPage(); }
    public function updatingInStockOnly() { $this->resetPage(); }

    public function selectCategory($slug)
    {
        $this->categorySlug = $slug;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'categorySlug', 'minPrice', 'maxPrice', 'sortBy', 'inStockOnly']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query()
            ->select('products.*')
            ->join('product_varients', function ($join) {
                $join->on('products.id', '=', 'product_varients.product_id')
                     ->where('product_varients.is_default', '=', true);
            })
            ->with(['category', 'primaryImage', 'defaultVariant.inventory'])
            ->where('products.status', 'active');

        // Apply filters
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('products.name', 'like', '%' . $this->search . '%')
                  ->orWhere('products.description', 'like', '%' . $this->search . '%')
                  ->orWhere('product_varients.sku', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->categorySlug) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', $this->categorySlug);
            });
        }

        if ($this->minPrice !== null && $this->minPrice !== '') {
            $query->whereRaw('COALESCE(product_varients.sale_price, product_varients.price) >= ?', [$this->minPrice]);
        }

        if ($this->maxPrice !== null && $this->maxPrice !== '') {
            $query->whereRaw('COALESCE(product_varients.sale_price, product_varients.price) <= ?', [$this->maxPrice]);
        }

        if ($this->inStockOnly) {
            $query->whereHas('defaultVariant.inventory', function ($q) {
                $q->where('quantity', '>', 0);
            });
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'price_asc':
                $query->orderByRaw('COALESCE(product_varients.sale_price, product_varients.price) ASC');
                break;
            case 'price_desc':
                $query->orderByRaw('COALESCE(product_varients.sale_price, product_varients.price) DESC');
                break;
            case 'name_asc':
                $query->orderBy('products.name', 'ASC');
                break;
            case 'name_desc':
                $query->orderBy('products.name', 'DESC');
                break;
            case 'newest':
                $query->orderBy('products.created_at', 'DESC');
                break;
            case 'featured':
            default:
                $query->orderBy('products.is_featured', 'DESC')
                      ->orderBy('products.created_at', 'DESC');
                break;
        }

        $products = $query->paginate(12);

        // Fetch categories for filter dropdown/sidebar
        $categories = Category::where('is_active', true)->get();

        // Get system max price to initialize range slider bounds
        $systemMaxPrice = (float) ProductVarient::where('is_default', true)->max('price') ?: 2000;

        return view('pages.product.product.product', [
            'products' => $products,
            'categories' => $categories,
            'systemMaxPrice' => $systemMaxPrice,
        ]);
    }
};