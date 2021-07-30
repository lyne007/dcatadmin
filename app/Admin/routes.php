<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    // 网站配置
    $router->get('/settings','SettingsController@index')->name('settings.index');
    // 商户
    $router->resource('/merchants','MerchantController');
    // banner
    $router->resource('/banners','BannerController');
    // 分类
    $router->resource('/categorys','CategoryController');
    // 商品
    $router->resource('/goods','GoodsController');
    // 属性key
    $router->resource('/attributeKeys','AttributeKeyController');
    // 属性value
    $router->resource('/attributeValues','AttributeValueController');

    // 相关接口
    $router->prefix('api')->group(function($router){
        // 获取所有商户 select下拉菜单
        $router->any('/merchant/select','ApiController@merchantSelect');
        // 获取所有分类 select下拉菜单
        $router->any('/category/select','ApiController@categorySelect');
        // 获取分类下的属性名
        $router->any('/attribute/select','ApiController@attributeSelect');
    });

});
