<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
    // **************** These all routes are for Dashboard page **************************/
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('shop', [ShopController::class, 'index'])->name('shop.index');
    Route::get('shop/{product_slug}', [ShopController::class, 'product_details'])->name('shop.product.details');
    
    // **************** These all routes are for Cart page **************************/
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
    Route::put('cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.qty.increase');
    Route::put('cart/decrease-quantity/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('cart.qty.decrease');
    Route::delete('cart/remove/{rowId}', [CartController::class, 'remove_from_cart'])->name('cart.item.remove');
    Route::delete('cart/clear', [CartController::class, 'clear_cart'])->name('cart.clear');
    
    // **************** These all routes are for Applying coupon on cart **************************/
    Route::post('cart/apply-coupon', [CartController::class, 'apply_coupon_code'])->name('cart.coupon.apply');
    Route::delete('cart/remove-coupon', [CartController::class, 'remove_coupon_code'])->name('cart.coupon.remove');
    
    // **************** These all routes are for Wishlist page **************************/
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('wishlist/add', [WishlistController::class, 'add_to_wishlist'])->name('wishlist.add');
    Route::delete('wishlist/remove/{rowId}', [WishlistController::class, 'remove_wishlist'])->name('wishlist.item.remove');
    Route::delete('wishlist/clear', [WishlistController::class, 'empty_wishlist'])->name('wishlist.clear');
    Route::post('wishlist/move_to_cart/{rowId}', [WishlistController::class, 'move_to_cart'])->name('wishlist.move.to.cart');
    
    // **************** These all routes are for Checkout page **************************/
    Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('place-an-order', [CartController::class, 'place_an_order'])->name('cart.place.an.order');
    Route::get('order-confirmation', [CartController::class, 'order_confirmation'])->name('cart.order.confirmation');

    // **************** These all routes are for About Us page **************************/
    Route::get('about', [AboutController::class, 'index'])->name('about.index');
    
    // **************** These all routes are for Contact Us page **************************/
    Route::get('contact', [HomeController::class, 'contact'])->name('home.contact');
    Route::post('contact/store', [HomeController::class, 'contact_store'])->name('home.contact.store');

    Route::get('search', [HomeController::class, 'search'])->name('home.search');

Route::middleware(['auth'])->group(function(){
    Route::get('account-dashboard', [UserController::class, 'index'])->name('user.index');
    Route::get('account-orders', [UserController::class, 'orders'])->name('user.orders');
    Route::get('account-orders/{order_id}/details', [UserController::class, 'order_details'])->name('user.order.details');
    Route::put('account-orders/cancel-order', [UserController::class, 'order_cancel'])->name('user.order.cancel');
});


Route::middleware(['auth', AuthAdmin::class])->group(function(){
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    // **************** These all routes are for Brands pages **************************
    Route::get('admin/brands', [AdminController::class, 'brands'])->name('admin.brands');
    Route::get('admin/brand/add', [AdminController::class, 'add_brand'])->name('admin.brand.new');
    Route::post('admin/brand/store', [AdminController::class, 'brand_store'])->name('admin.brand.store');
    Route::get('admin/brand/edit/{id}', [AdminController::class, 'edit_brand'])->name('admin.brand.edit');
    Route::put('admin/brand/update', [AdminController::class, 'brand_update'])->name('admin.brand.update');
    Route::delete('admin/brand/{id}/delete', [AdminController::class, 'brand_delete'])->name('admin.brand.delete');

    // **************** These all routes are for Category pages **************************
    Route::get('admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('admin/categories/add', [AdminController::class, 'category_add'])->name('admin.categories.add');
    Route::post('admin/categories/store', [AdminController::class, 'category_store'])->name('admin.categories.store');
    Route::get('admin/categories/edit/{id}', [AdminController::class, 'category_edit'])->name('admin.categories.edit');
    Route::put('admin/categories/update', [AdminController::class, 'category_update'])->name('admin.categories.update');
    Route::delete('admin/category/{id}/delete', [AdminController::class, 'category_delete'])->name('admin.categories.delete');

    // **************** These all routes are for Products pages **************************
    Route::get('admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('admin/products/add', [AdminController::class, 'product_add'])->name('admin.products.add');
    Route::post('admin/products/store', [AdminController::class, 'product_store'])->name('admin.products.store');
    Route::get('admin/products/{id}/edit', [AdminController::class, 'product_edit'])->name('admin.products.edit');
    Route::put('admin/products/update', [AdminController::class, 'product_update'])->name('admin.products.update');
    Route::delete('admin/products/{id}/delete', [AdminController::class, 'product_delete'])->name('admin.products.delete');

    // **************** These all routes are for Coupons pages **************************
    Route::get('admin/coupons', [AdminController::class, 'coupons'])->name('admin.coupons');
    route::get('admin/coupon/add', [AdminController::class, 'coupon_add'])->name('admin.coupon.add');
    Route::post('admin/coupon/store', [AdminController::class, 'coupon_store'])->name('admin.coupon.store');
    Route::get('admin/coupon/edit/{id}', [AdminController::class, 'coupon_edit'])->name('admin.coupon.edit');
    Route::put('admin/coupon/update', [AdminController::class, 'coupon_update'])->name('admin.coupon.update');
    Route::delete('admin/coupon/{id}/delete', [AdminController::class, 'coupon_delete'])->name('admin.coupon.delete');

    // **************** These all routes are for Orders page **************************
    Route::get('admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('admin/order/{order_id}/details', [AdminController::class, 'order_details'])->name('admin.order.details');
    Route::put('admin/order/update-status', [AdminController::class, 'update_order_status'])->name('admin.order.status.update');
    
    Route::get('admin/slides', [AdminController::class, 'slides'])->name('admin.slides');
    Route::get('admin/slide/add', [AdminController::class, 'slide_add'])->name('admin.slide.add');
    Route::post('admin/slide/store', [AdminController::class, 'slide_store'])->name('admin.slide.store');
    Route::get('admin/slide/edit/{id}', [AdminController::class, 'slide_edit'])->name('admin.slide.edit');
    Route::put('admin/slide/update', [AdminController::class, 'slide_update'])->name('admin.slide.update');
    Route::delete('admin/slide/{id}/delete', [AdminController::class, 'slide_delete'])->name('admin.slide.delete');

    Route::get('admin/contacts', [AdminController::class, 'contact'])->name('admin.contacts');
    Route::delete('admin/contact/{id}/delete', [AdminController::class, 'contact_delete'])->name('admin.contact.delete');

    Route::get('admin/search', [AdminController::class, 'search'])->name('admin.search');
}); 
