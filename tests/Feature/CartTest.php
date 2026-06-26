<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\CartItem;
use App\Models\ProductVarient;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->category = Category::create([
        'name' => 'Skincare',
        'slug' => 'skincare',
        'is_active' => true
    ]);

    $this->product = Product::create([
        'name' => 'Radiance Face Oil',
        'slug' => 'radiance-face-oil',
        'category_id' => $this->category->id,
        'status' => 'active',
        'short_description' => 'Test short description',
        'has_variants' => false,
        'is_featured' => false
    ]);

    $this->variant = $this->product->variants()->create([
        'sku' => 'RAD-OIL-1',
        'price' => 1000,
        'sale_price' => 800,
        'is_default' => true,
        'status' => true
    ]);
    
    $this->variant->inventory()->update(['quantity' => 5]);
});

test('guest cart loads, adds, updates and deletes items in session', function () {
    session()->forget('cart');

    Livewire::test('public.cart')
        ->assertCount('cartItems', 0)
        ->dispatch('add-to-cart', $this->product->id, $this->variant->id, 2)
        ->assertCount('cartItems', 1)
        ->assertSet('subtotal', 1600)
        ->call('updateQuantity', $this->variant->id, 3)
        ->assertSet('subtotal', 2400)
        ->call('removeItem', $this->variant->id)
        ->assertCount('cartItems', 0);
});

test('authenticated cart loads, adds, updates and deletes items in database', function () {
    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => bcrypt('password')
    ]);

    $this->actingAs($user);

    Livewire::test('public.cart')
        ->assertCount('cartItems', 0)
        ->dispatch('add-to-cart', $this->product->id, $this->variant->id, 2)
        ->assertCount('cartItems', 1)
        ->assertSet('subtotal', 1600);

    // Verify database record exists
    $this->assertDatabaseHas('cart_items', [
        'user_id' => $user->id,
        'product_varient_id' => $this->variant->id,
        'quantity' => 2
    ]);

    Livewire::test('public.cart')
        ->call('updateQuantity', $this->variant->id, 3)
        ->assertSet('subtotal', 2400);

    $this->assertDatabaseHas('cart_items', [
        'user_id' => $user->id,
        'product_varient_id' => $this->variant->id,
        'quantity' => 3
    ]);

    Livewire::test('public.cart')
        ->call('removeItem', $this->variant->id)
        ->assertCount('cartItems', 0);

    $this->assertDatabaseMissing('cart_items', [
        'user_id' => $user->id,
        'product_varient_id' => $this->variant->id
    ]);
});

test('guest session cart merges on successful user login', function () {
    session()->put('cart', [
        $this->variant->id => 2
    ]);

    $user = User::create([
        'name' => 'Jane Smith',
        'email' => 'jane@example.com',
        'password' => bcrypt('password')
    ]);

    Livewire::test('auth::user.login')
        ->set('email', 'jane@example.com')
        ->set('password', 'password')
        ->call('login')
        ->assertHasNoErrors();

    // Session cart should be cleared
    expect(session()->has('cart'))->toBeFalse();

    // Database should have merged the item
    $this->assertDatabaseHas('cart_items', [
        'user_id' => $user->id,
        'product_varient_id' => $this->variant->id,
        'quantity' => 2
    ]);
});

test('cart page handles coupon application and validations', function () {
    $coupon = Coupon::create([
        'code' => 'DISCOUNT50',
        'type' => 'percentage',
        'value' => 50,
        'min_spend' => 500,
        'is_active' => true
    ]);

    session()->put('cart', [
        $this->variant->id => 2 // Subtotal: 1600
    ]);

    Livewire::test('pages::cart')
        ->assertSet('subtotal', 1600)
        ->set('couponCode', 'DISCOUNT50')
        ->call('applyCoupon')
        ->assertHasNoErrors()
        ->assertSet('discountAmount', 800)
        ->assertSet('grandTotal', 800)
        ->call('removeCoupon')
        ->assertSet('discountAmount', 0)
        ->assertSet('grandTotal', 1600);
});

test('cart page rejects invalid or insufficient spend coupon codes', function () {
    $coupon = Coupon::create([
        'code' => 'BIGSPEND',
        'type' => 'fixed',
        'value' => 100,
        'min_spend' => 2000,
        'is_active' => true
    ]);

    session()->put('cart', [
        $this->variant->id => 1 // Subtotal: 800
    ]);

    Livewire::test('pages::cart')
        ->set('couponCode', 'BIGSPEND')
        ->call('applyCoupon')
        ->assertHasErrors(['couponCode'])
        ->assertSet('discountAmount', 0);
});
