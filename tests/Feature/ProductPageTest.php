<?php

use App\Models\Product;
use App\Models\Category;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('product page returns successful response and renders component', function () {
    $response = $this->get('/products');
    $response->assertStatus(200);
});

test('product page lists products and filters by category', function () {
    $category = Category::create([
        'name' => 'Test Category', 
        'slug' => 'test-category',
        'is_active' => true
    ]);
    
    $product = Product::create([
        'name' => 'Ayur Herb Unique Name',
        'slug' => 'ayur-herb-unique-name',
        'category_id' => $category->id,
        'status' => 'active',
        'short_description' => 'Test description',
        'has_variants' => false,
        'is_featured' => false,
    ]);
    
    $product->variants()->create([
        'sku' => 'TEST-SKU-1',
        'price' => 100,
        'is_default' => true,
        'status' => true,
    ]);

    Livewire::test('pages::product.product')
        ->assertSee('Ayur Herb Unique Name')
        ->set('categorySlug', 'test-category')
        ->assertSee('Ayur Herb Unique Name')
        ->set('categorySlug', 'non-existent-category')
        ->assertDontSee('Ayur Herb Unique Name');
});

test('product view page returns successful response and renders component', function () {
    $category = Category::create([
        'name' => 'Test Category', 
        'slug' => 'test-category',
        'is_active' => true
    ]);
    
    $product = Product::create([
        'name' => 'Ayur Botanical Blend',
        'slug' => 'ayur-botanical-blend',
        'category_id' => $category->id,
        'status' => 'active',
        'short_description' => 'Test description',
        'has_variants' => false,
        'is_featured' => false,
    ]);
    
    $product->variants()->create([
        'sku' => 'TEST-SKU-DETAIL',
        'price' => 100,
        'is_default' => true,
        'status' => true,
    ]);

    $response = $this->get('/products/ayur-botanical-blend');
    $response->assertStatus(200);
});

test('product view page allows variant selection and quantity modifications', function () {
    $category = Category::create([
        'name' => 'Test Category', 
        'slug' => 'test-category',
        'is_active' => true
    ]);
    
    $product = Product::create([
        'name' => 'Ayur Botanical Blend 2',
        'slug' => 'ayur-botanical-blend-2',
        'category_id' => $category->id,
        'status' => 'active',
        'short_description' => 'Test description',
        'has_variants' => true,
        'is_featured' => false,
    ]);
    
    $v1 = $product->variants()->create([
        'sku' => 'TEST-SKU-VAR-A',
        'price' => 150,
        'is_default' => true,
        'status' => true,
    ]);
    $v1->inventory()->update(['quantity' => 10]);
    
    $v2 = $product->variants()->create([
        'sku' => 'TEST-SKU-VAR-B',
        'price' => 250,
        'is_default' => false,
        'status' => true,
    ]);
    $v2->inventory()->update(['quantity' => 10]);

    Livewire::test('pages::product.product-view', ['slug' => 'ayur-botanical-blend-2'])
        ->assertSee('Ayur Botanical Blend 2')
        ->assertSet('selectedVariantId', $v1->id)
        ->assertSet('quantity', 1)
        ->call('incrementQuantity')
        ->assertSet('quantity', 2)
        ->call('decrementQuantity')
        ->assertSet('quantity', 1)
        ->call('selectVariant', $v2->id)
        ->assertSet('selectedVariantId', $v2->id)
        ->assertSet('quantity', 1);
});
