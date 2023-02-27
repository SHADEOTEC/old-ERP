<?php

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register admin routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::post('/update', 'UpdateController@step0')->name('update');
Route::get('/update/step1', 'UpdateController@step1')->name('update.step1');
Route::get('/update/step2', 'UpdateController@step2')->name('update.step2');

Route::get('/admin', 'HomeController@admin_dashboard')->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    //Update Routes

    Route::resource('categories', 'CategoryController');
    Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
    Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
    Route::post('/categories/featured', 'CategoryController@updateFeatured')->name('categories.featured');

    Route::resource('brands', 'BrandController');
    Route::get('/brands/edit/{id}', 'BrandController@edit')->name('brands.edit');
    Route::get('/brands/destroy/{id}', 'BrandController@destroy')->name('brands.destroy');

    //ADMIN Products CRUD
    Route::get('/products/admin', 'ProductController@admin_products')->name('products.admin');
    Route::get('/products/seller', 'ProductController@seller_products')->name('products.seller');
    Route::get('/products/all', 'ProductController@all_products')->name('products.all');
    Route::get('/products/create', 'ProductController@create')->name('products.create');
    Route::get('/products/admin/{id}/edit', 'ProductController@admin_product_edit')->name('products.admin.edit');
    Route::post('/products/admin/{id}/update/', 'ProductController@admin_product_update')->name('products.admin.update');

    Route::get('/products/admin/toggle/{id}/{show}', 'ProductController@visibility')->name('products.admin.visibility');
    Route::get('/products/admin/destroy/{id}', 'ProductController@destroy')->name('products.admin.destroy');
    Route::get('/products/admin/recover/{id}', 'ProductController@recover')->name('products.admin.recover');

    Route::get('/products/seller/{id}/edit', 'ProductController@seller_product_edit')->name('products.seller.edit');
    Route::post('/products/todays_deal', 'ProductController@updateTodaysDeal')->name('products.todays_deal');
    Route::post('/products/featured', 'ProductController@updateFeatured')->name('products.featured');
    Route::post('/products/approved', 'ProductController@updateProductApproval')->name('products.approved');
    Route::post('/products/get_products_by_subcategory', 'ProductController@get_products_by_subcategory')->name('products.get_products_by_subcategory');
    Route::post('/bulk-product-delete', 'ProductController@bulk_product_delete')->name('bulk-product-delete');
    
    //ADMIN Parts CRUD
    Route::get('/parts/admin', 'PartsController@admin_parts')->name('parts.admin');
    // Route::get('/parts/all', 'PartsController@all_parts')->name('parts.all');
    Route::get('/parts/create', 'PartsController@create')->name('parts.admin.create');
    Route::post('/parts/create', 'PartsController@store')->name('parts.admin.store');
    Route::get('/parts/admin/{id}/edit', 'PartsController@edit')->name('parts.admin.edit');
    Route::post('/parts/admin/{id}/update/', 'PartsController@update')->name('parts.admin.update');

    Route::get('/parts/admin/toggle/{id}/{show}', 'PartsController@visibility')->name('parts.admin.visibility');
    Route::get('/parts/admin/destroy/{id}', 'PartsController@destroy')->name('parts.admin.destroy');
    Route::get('/parts/admin/recover/{id}', 'PartsController@recover')->name('parts.admin.recover');

    // Route::resource('sellers', 'SellerController');
    Route::get('sellers_ban/{id}', 'SellerController@ban')->name('sellers.ban');
    Route::post('/bulk-seller-delete', 'SellerController@bulk_seller_delete')->name('bulk-seller-delete');
    Route::get('/sellers/view/{id}/verification', 'SellerController@show_verification_request')->name('sellers.show_verification_request');
    Route::get('/sellers/approve/{id}', 'SellerController@approve_seller')->name('sellers.approve');
    Route::get('/sellers/reject/{id}', 'SellerController@reject_seller')->name('sellers.reject');
    Route::get('/sellers/login/{id}', 'SellerController@login')->name('sellers.login');
    Route::post('/sellers/payment_modal', 'SellerController@payment_modal')->name('sellers.payment_modal');
    
    Route::get('/backend/sellers/index', 'SellerController@index')->name('backend.sellers.index');
    Route::get('/backend/sellers/create', 'SellerController@create')->name('backend.sellers.create');
    Route::post('/backend/sellers/store', 'SellerController@store')->name('backend.sellers.store');
    Route::get('/backend/sellers/{id}/edit', 'SellerController@edit')->name('backend.sellers.edit');
    Route::post('/backend/sellers/{id}/update', 'SellerController@update')->name('backend.sellers.update');
    Route::get('/sellers/destroy/{id}', 'SellerController@destroy')->name('sellers.destroy');
    Route::get('/sellers/toggle/{id}/{show}', 'SellerController@visibility')->name('sellers.visibility');
    

    Route::get('/seller/payments', 'PaymentController@payment_histories')->name('sellers.payment_histories');
    Route::get('/seller/payments/show/{id}', 'PaymentController@show')->name('sellers.payment_history');

    Route::resource('customers', 'CustomerController');
    Route::get('customers_ban/{customer}', 'CustomerController@ban')->name('customers.ban');
    Route::get('/customers/login/{id}', 'CustomerController@login')->name('customers.login');
    Route::get('/customers/destroy/{id}', 'CustomerController@destroy')->name('customers.destroy');
    Route::post('/bulk-customer-delete', 'CustomerController@bulk_customer_delete')->name('bulk-customer-delete');

    Route::get('/newsletter', 'NewsletterController@index')->name('newsletters.index');
    Route::post('/newsletter/send', 'NewsletterController@send')->name('newsletters.send');
    Route::post('/newsletter/test/smtp', 'NewsletterController@testEmail')->name('test.smtp');

    Route::resource('profile', 'ProfileController');

    Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
    Route::post('/business-settings/update/activation', 'BusinessSettingsController@updateActivationSettings')->name('business_settings.update.activation');
    Route::get('/general-setting', 'BusinessSettingsController@general_setting')->name('general_setting.index');
    Route::get('/activation', 'BusinessSettingsController@activation')->name('activation.index');
    Route::get('/payment-method', 'BusinessSettingsController@payment_method')->name('payment_method.index');
    Route::get('/file_system', 'BusinessSettingsController@file_system')->name('file_system.index');
    Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');
    Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings.index');
    Route::get('/google-analytics', 'BusinessSettingsController@google_analytics')->name('google_analytics.index');
    Route::get('/google-recaptcha', 'BusinessSettingsController@google_recaptcha')->name('google_recaptcha.index');
    Route::get('/google-map', 'BusinessSettingsController@google_map')->name('google-map.index');
    Route::get('/google-firebase', 'BusinessSettingsController@google_firebase')->name('google-firebase.index');

    //Facebook Settings
    Route::get('/facebook-chat', 'BusinessSettingsController@facebook_chat')->name('facebook_chat.index');
    Route::post('/facebook_chat', 'BusinessSettingsController@facebook_chat_update')->name('facebook_chat.update');
    Route::get('/facebook-comment', 'BusinessSettingsController@facebook_comment')->name('facebook-comment');
    Route::post('/facebook-comment', 'BusinessSettingsController@facebook_comment_update')->name('facebook-comment.update');
    Route::post('/facebook_pixel', 'BusinessSettingsController@facebook_pixel_update')->name('facebook_pixel.update');

    Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
    Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');
    Route::post('/google_analytics', 'BusinessSettingsController@google_analytics_update')->name('google_analytics.update');
    Route::post('/google_recaptcha', 'BusinessSettingsController@google_recaptcha_update')->name('google_recaptcha.update');
    Route::post('/google-map', 'BusinessSettingsController@google_map_update')->name('google-map.update');
    Route::post('/google-firebase', 'BusinessSettingsController@google_firebase_update')->name('google-firebase.update');
    //Currency
    Route::get('/currency', 'CurrencyController@currency')->name('currency.index');
    Route::post('/currency/update', 'CurrencyController@updateCurrency')->name('currency.update');
    Route::post('/your-currency/update', 'CurrencyController@updateYourCurrency')->name('your_currency.update');
    Route::get('/currency/create', 'CurrencyController@create')->name('currency.create');
    Route::post('/currency/store', 'CurrencyController@store')->name('currency.store');
    Route::post('/currency/currency_edit', 'CurrencyController@edit')->name('currency.edit');
    Route::post('/currency/update_status', 'CurrencyController@update_status')->name('currency.update_status');

    //Tax
    Route::resource('tax', 'TaxController');
    Route::get('/tax/edit/{id}', 'TaxController@edit')->name('tax.edit');
    Route::get('/tax/destroy/{id}', 'TaxController@destroy')->name('tax.destroy');
    Route::post('tax-status', 'TaxController@change_tax_status')->name('taxes.tax-status');


    Route::get('/verification/form', 'BusinessSettingsController@seller_verification_form')->name('seller_verification_form.index');
    Route::post('/verification/form', 'BusinessSettingsController@seller_verification_form_update')->name('seller_verification_form.update');
    Route::get('/vendor_commission', 'BusinessSettingsController@vendor_commission')->name('business_settings.vendor_commission');
    Route::post('/vendor_commission_update', 'BusinessSettingsController@vendor_commission_update')->name('business_settings.vendor_commission.update');

    Route::resource('/languages', 'LanguageController');
    Route::post('/languages/{id}/update', 'LanguageController@update')->name('languages.update');
    Route::get('/languages/destroy/{id}', 'LanguageController@destroy')->name('languages.destroy');
    Route::post('/languages/update_rtl_status', 'LanguageController@update_rtl_status')->name('languages.update_rtl_status');
    Route::post('/languages/key_value_store', 'LanguageController@key_value_store')->name('languages.key_value_store');

    // website setting
    Route::group(['prefix' => 'website'], function() {
        Route::get('/footer', 'WebsiteController@footer')->name('website.footer');
        Route::get('/header', 'WebsiteController@header')->name('website.header');
        Route::get('/appearance', 'WebsiteController@appearance')->name('website.appearance');
        Route::get('/pages', 'WebsiteController@pages')->name('website.pages');
        Route::resource('custom-pages', 'PageController');
        Route::get('/custom-pages/edit/{id}', 'PageController@edit')->name('custom-pages.edit');
        Route::get('/custom-pages/destroy/{id}', 'PageController@destroy')->name('custom-pages.destroy');
    });

    Route::resource('roles', 'RoleController');
    Route::get('/roles/edit/{id}', 'RoleController@edit')->name('roles.edit');
    Route::get('/roles/destroy/{id}', 'RoleController@destroy')->name('roles.destroy');

    Route::resource('staffs', 'StaffController');
    Route::get('/staffs/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');

    Route::resource('flash_deals', 'FlashDealController');
    Route::get('/flash_deals/edit/{id}', 'FlashDealController@edit')->name('flash_deals.edit');
    Route::get('/flash_deals/destroy/{id}', 'FlashDealController@destroy')->name('flash_deals.destroy');
    Route::post('/flash_deals/update_status', 'FlashDealController@update_status')->name('flash_deals.update_status');
    Route::post('/flash_deals/update_featured', 'FlashDealController@update_featured')->name('flash_deals.update_featured');
    Route::post('/flash_deals/product_discount', 'FlashDealController@product_discount')->name('flash_deals.product_discount');
    Route::post('/flash_deals/product_discount_edit', 'FlashDealController@product_discount_edit')->name('flash_deals.product_discount_edit');

    //Subscribers
    Route::get('/subscribers', 'SubscriberController@index')->name('subscribers.index');
    Route::get('/subscribers/destroy/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

    // Route::get('/orders', 'OrderController@admin_orders')->name('orders.index.admin');
    // Route::get('/orders/{id}/show', 'OrderController@show')->name('orders.show');
    // Route::get('/sales/{id}/show', 'OrderController@sales_show')->name('sales.show');
    // Route::get('/sales', 'OrderController@sales')->name('sales.index');
    // All Orders
    Route::get('/all_orders', 'OrderController@all_orders')->name('all_orders.index');
    Route::get('/all_orders/{id}/show', 'OrderController@all_orders_show')->name('all_orders.show');

    // Inhouse Orders
    Route::get('/inhouse-orders', 'OrderController@admin_orders')->name('inhouse_orders.index');
    Route::get('/inhouse-orders/{id}/show', 'OrderController@show')->name('inhouse_orders.show');

    // Seller Orders
    Route::get('/seller_orders', 'OrderController@seller_orders')->name('seller_orders.index');
    Route::get('/seller_orders/delivery_note/{id}', 'OrderController@delivery_note')->name('seller_orders.delivery_note');
    Route::get('/seller_orders/main_ord_delivery_note/{id}', 'OrderController@main_ord_delivery_note')->name('seller_orders.main_ord_delivery_note');
    Route::get('/seller_orders/labels/{id}', 'OrderController@labels')->name('seller_orders.labels');
    Route::get('/seller_orders/specs/{id}', 'OrderController@specs')->name('seller_orders.specs');
    
    // Route::get('/seller_orders/{id}/show', 'OrderController@seller_orders_show')->name('seller_orders.show');
    Route::get('/seller_orders/{id}/line_items', 'OrderController@get_lineitems')->name('seller_orders.get_lineitems');
    Route::get('/seller_orders/{id}/order_detail', 'OrderController@seller_orders_show')->name('seller_orders.ord_details');
    
    Route::post('/seller_orders/order_status_update', 'OrderController@seller_status_upd')->name('seller_orders.status_upd');

    Route::post('/bulk-order-status', 'OrderController@bulk_order_status')->name('bulk-order-status');


    // Pickup point orders
    Route::get('orders_by_pickup_point', 'OrderController@pickup_point_order_index')->name('pick_up_point.order_index');
    Route::get('/orders_by_pickup_point/{id}/show', 'OrderController@pickup_point_order_sales_show')->name('pick_up_point.order_show');

    Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');
    Route::post('/bulk-order-delete', 'OrderController@bulk_order_delete')->name('bulk-order-delete');

    Route::post('/pay_to_seller', 'CommissionController@pay_to_seller')->name('commissions.pay_to_seller');

    //Reports
    Route::get('/stock_report', 'ReportController@stock_report')->name('stock_report.index');
    Route::get('/in_house_sale_report', 'ReportController@in_house_sale_report')->name('in_house_sale_report.index');
    Route::get('/seller_sale_report', 'ReportController@seller_sale_report')->name('seller_sale_report.index');
    Route::get('/wish_report', 'ReportController@wish_report')->name('wish_report.index');
    Route::get('/user_search_report', 'ReportController@user_search_report')->name('user_search_report.index');
    Route::get('/wallet-history', 'ReportController@wallet_transaction_history')->name('wallet-history.index');

    //Blog Section
    Route::resource('blog-category', 'BlogCategoryController');
    Route::get('/blog-category/destroy/{id}', 'BlogCategoryController@destroy')->name('blog-category.destroy');
    Route::resource('blog', 'BlogController');
    Route::get('/blog/destroy/{id}', 'BlogController@destroy')->name('blog.destroy');
    Route::post('/blog/change-status', 'BlogController@change_status')->name('blog.change-status');

    //Coupons
    // Route::resource('coupon', 'CouponController');
    // Route::post('/coupon/get_form', 'CouponController@get_coupon_form')->name('coupon.get_coupon_form');
    // Route::post('/coupon/get_form_edit', 'CouponController@get_coupon_form_edit')->name('coupon.get_coupon_form_edit');
    // Route::get('/coupon/destroy/{id}', 'CouponController@destroy')->name('coupon.destroy');

    //Reviews
    Route::get('/reviews', 'ReviewController@index')->name('reviews.index');
    Route::post('/reviews/published', 'ReviewController@updatePublished')->name('reviews.published');

    //Support_Ticket
    Route::get('support_ticket/', 'SupportTicketController@admin_index')->name('support_ticket.admin_index');
    Route::get('support_ticket/{id}/show', 'SupportTicketController@admin_show')->name('support_ticket.admin_show');
    Route::post('support_ticket/reply', 'SupportTicketController@admin_store')->name('support_ticket.admin_store');

    //Pickup_Points
    Route::resource('pick_up_points', 'PickupPointController');
    Route::get('/pick_up_points/edit/{id}', 'PickupPointController@edit')->name('pick_up_points.edit');
    Route::get('/pick_up_points/destroy/{id}', 'PickupPointController@destroy')->name('pick_up_points.destroy');

    //conversation of seller customer
    Route::get('conversations', 'ConversationController@admin_index')->name('conversations.admin_index');
    Route::get('conversations/{id}/show', 'ConversationController@admin_show')->name('conversations.admin_show');

    Route::post('/sellers/profile_modal', 'SellerController@profile_modal')->name('sellers.profile_modal');
    Route::post('/sellers/approved', 'SellerController@updateApproved')->name('sellers.approved');

    Route::resource('attributes', 'AttributeController');
    Route::get('/attributes/edit/{id}', 'AttributeController@edit')->name('attributes.edit');
    Route::get('/attributes/destroy/{id}', 'AttributeController@destroy')->name('attributes.destroy');

    //Attribute Value
    Route::post('/store-attribute-value', 'AttributeController@store_attribute_value')->name('store-attribute-value');
    Route::get('/edit-attribute-value/{id}', 'AttributeController@edit_attribute_value')->name('edit-attribute-value');
    Route::post('/update-attribute-value/{id}', 'AttributeController@update_attribute_value')->name('update-attribute-value');
    Route::get('/destroy-attribute-value/{id}', 'AttributeController@destroy_attribute_value')->name('destroy-attribute-value');

    //Colors
    Route::get('/colors', 'AttributeController@colors')->name('colors');
    Route::post('/colors/store', 'AttributeController@store_color')->name('colors.store');
    Route::get('/colors/edit/{id}', 'AttributeController@edit_color')->name('colors.edit');
    Route::post('/colors/update/{id}', 'AttributeController@update_color')->name('colors.update');
    Route::get('/colors/destroy/{id}', 'AttributeController@destroy_color')->name('colors.destroy');

    Route::resource('addons', 'AddonController');
    Route::post('/addons/activation', 'AddonController@activation')->name('addons.activation');

    Route::get('/customer-bulk-upload/index', 'CustomerBulkUploadController@index')->name('customer_bulk_upload.index');
    Route::post('/bulk-user-upload', 'CustomerBulkUploadController@user_bulk_upload')->name('bulk_user_upload');
    Route::post('/bulk-customer-upload', 'CustomerBulkUploadController@customer_bulk_file')->name('bulk_customer_upload');
    Route::get('/user', 'CustomerBulkUploadController@pdf_download_user')->name('pdf.download_user');
    //Customer Package

    Route::resource('customer_packages', 'CustomerPackageController');
    Route::get('/customer_packages/edit/{id}', 'CustomerPackageController@edit')->name('customer_packages.edit');
    Route::get('/customer_packages/destroy/{id}', 'CustomerPackageController@destroy')->name('customer_packages.destroy');

    //Classified Products
    Route::get('/classified_products', 'CustomerProductController@customer_product_index')->name('classified_products');
    Route::post('/classified_products/published', 'CustomerProductController@updatePublished')->name('classified_products.published');

    //Shipping Configuration
    Route::get('/shipping_configuration', 'BusinessSettingsController@shipping_configuration')->name('shipping_configuration.index');
    Route::post('/shipping_configuration/update', 'BusinessSettingsController@shipping_configuration_update')->name('shipping_configuration.update');

    // Route::resource('pages', 'PageController');
    // Route::get('/pages/destroy/{id}', 'PageController@destroy')->name('pages.destroy');

    Route::resource('countries', 'CountryController');
    Route::post('/countries/status', 'CountryController@updateStatus')->name('countries.status');

    Route::resource('cities', 'CityController');
    Route::get('/cities/edit/{id}', 'CityController@edit')->name('cities.edit');
    Route::get('/cities/destroy/{id}', 'CityController@destroy')->name('cities.destroy');

    Route::view('/system/update', 'backend.system.update')->name('system_update');
    Route::view('/system/server-status', 'backend.system.server_status')->name('system_server');

    // uploaded files
    Route::any('/uploaded-files/file-info', 'AizUploadController@file_info')->name('uploaded-files.info');
    Route::resource('/uploaded-files', 'AizUploadController');
    Route::get('/uploaded-files/destroy/{id}', 'AizUploadController@destroy')->name('uploaded-files.destroy');
    
    Route::get('/all-notification', 'NotificationController@index')->name('admin/all-notification');

    //Fabric
    Route::get('/fabric', 'FabricController@index')->name('fabric.list');
    Route::get('/fabric/toggle/{id}/{show}', 'FabricController@visibility')->name('fabric.visibility');
    Route::get('/fabric/add', 'FabricController@create')->name('fabric.add');
    Route::post('/fabric/store', 'FabricController@store')->name('fabric.store');
    Route::get('/fabric/edit/{id}', 'FabricController@edit')->name('fabric.edit');
    Route::post('/fabric/update/{id}', 'FabricController@update')->name('fabric.update');
    Route::get('/fabric/destroy/{id}', 'FabricController@destroy')->name('fabric.destroy');
    Route::get('/fabric/recover/{id}', 'FabricController@recover')->name('fabric.recover');

    //Smartoptions
    Route::get('/smartoptions', 'SmartoptionController@index')->name('smartoptions.list');
    Route::get('/smartoptions/toggle/{id}/{show}', 'SmartoptionController@visibility')->name('smartoptions.visibility');
    Route::get('/smartoptions/add', 'SmartoptionController@create')->name('smartoptions.add');
    Route::post('/smartoptions/store', 'SmartoptionController@store')->name('smartoptions.store');
    Route::get('/smartoptions/edit/{id}', 'SmartoptionController@edit')->name('smartoptions.edit');
    Route::post('/smartoptions/update/{id}', 'SmartoptionController@update')->name('smartoptions.update');
    Route::get('/smartoptions/destroy/{id}', 'SmartoptionController@destroy')->name('smartoptions.destroy');
    Route::get('/smartoptions/recover/{id}', 'SmartoptionController@recover')->name('smartoptions.recover');

    //Mount
    Route::get('/mount', 'MountController@index')->name('mount.list');
    Route::get('/mount/toggle/{id}/{show}', 'MountController@visibility')->name('mount.visibility');
    Route::get('/mount/add', 'MountController@create')->name('mount.add');
    Route::post('/mount/store', 'MountController@store')->name('mount.store');
    Route::get('/mount/edit/{id}', 'MountController@edit')->name('mount.edit');
    Route::post('/mount/update/{id}', 'MountController@update')->name('mount.update');
    Route::get('/mount/destroy/{id}', 'MountController@destroy')->name('mount.destroy');
    Route::get('/mount/recover/{id}', 'MountController@recover')->name('mount.recover');

    Route::get('/mountposition', 'MountController@index_position')->name('mountposition.list');
    Route::get('/mountposition/toggle/{id}/{show}', 'MountController@visibility_position')->name('mountposition.visibility');
    Route::get('/mountposition/add', 'MountController@create_position')->name('mountposition.add');
    Route::post('/mountposition/store', 'MountController@store_position')->name('mountposition.store');
    Route::get('/mountposition/edit/{id}', 'MountController@edit_position')->name('mountposition.edit');
    Route::post('/mountposition/update/{id}', 'MountController@update_position')->name('mountposition.update');
    Route::get('/mountposition/destroy/{id}', 'MountController@destroy_position')->name('mountposition.destroy');
    Route::get('/mountposition/recover/{id}', 'MountController@recover_position')->name('mountposition.recover');

    //Room Type
    Route::get('/roomtype', 'RoomtypeController@index')->name('roomtype.list');
    Route::get('/roomtype/toggle/{id}/{show}', 'RoomtypeController@visibility')->name('roomtype.visibility');
    Route::get('/roomtype/add', 'RoomtypeController@create')->name('roomtype.add');
    Route::post('/roomtype/store', 'RoomtypeController@store')->name('roomtype.store');
    Route::get('/roomtype/edit/{id}', 'RoomtypeController@edit')->name('roomtype.edit');
    Route::post('/roomtype/update/{id}', 'RoomtypeController@update')->name('roomtype.update');
    Route::get('/roomtype/destroy/{id}', 'RoomtypeController@destroy')->name('roomtype.destroy');
    Route::get('/roomtype/recover/{id}', 'RoomtypeController@recover')->name('roomtype.recover');

    //Brackets
    Route::get('/bracket', 'BracketController@index')->name('bracket.list');
    Route::get('/bracket/toggle/{id}/{show}', 'BracketController@visibility')->name('bracket.visibility');
    Route::get('/bracket/add', 'BracketController@create')->name('bracket.add');
    Route::post('/bracket/store', 'BracketController@store')->name('bracket.store');
    Route::get('/bracket/edit/{id}', 'BracketController@edit')->name('bracket.edit');
    Route::post('/bracket/update/{id}', 'BracketController@update')->name('bracket.update');
    Route::get('/bracket/destroy/{id}', 'BracketController@destroy')->name('bracket.destroy');
    Route::get('/bracket/recover/{id}', 'BracketController@recover')->name('bracket.recover');

    //Stack
    Route::get('/stack', 'StackshadeController@index')->name('stack.list');
    Route::get('/stack/toggle/{id}/{show}', 'StackshadeController@visibility')->name('stack.visibility');
    Route::get('/stack/add', 'StackshadeController@create')->name('stack.add');
    Route::post('/stack/store', 'StackshadeController@store')->name('stack.store');
    Route::get('/stack/edit/{id}', 'StackshadeController@edit')->name('stack.edit');
    Route::post('/stack/update/{id}', 'StackshadeController@update')->name('stack.update');
    Route::get('/stack/destroy/{id}', 'StackshadeController@destroy')->name('stack.destroy');
    Route::get('/stack/recover/{id}', 'StackshadeController@recover')->name('stack.recover');

    //Cassette
    Route::get('/cassette', 'CassetteController@index')->name('cassette.list');
    Route::get('/cassette/toggle/{id}/{show}', 'CassetteController@visibility')->name('cassette.visibility');
    Route::get('/cassette/add', 'CassetteController@create')->name('cassette.add');
    Route::post('/cassette/store', 'CassetteController@store')->name('cassette.store');
    Route::get('/cassette/edit/{id}', 'CassetteController@edit')->name('cassette.edit');
    Route::post('/cassette/update/{id}', 'CassetteController@update')->name('cassette.update');
    Route::get('/cassette/destroy/{id}', 'CassetteController@destroy')->name('cassette.destroy');
    Route::get('/cassette/recover/{id}', 'CassetteController@recover')->name('cassette.recover');

    //Spring Assist
    Route::get('/springassist', 'SpringassistController@index')->name('springassist.list');
    Route::get('/springassist/toggle/{id}/{show}', 'SpringassistController@visibility')->name('springassist.visibility');
    Route::get('/springassist/add', 'SpringassistController@create')->name('springassist.add');
    Route::post('/springassist/store', 'SpringassistController@store')->name('springassist.store');
    Route::get('/springassist/edit/{id}', 'SpringassistController@edit')->name('springassist.edit');
    Route::post('/springassist/update/{id}', 'SpringassistController@update')->name('springassist.update');
    Route::get('/springassist/destroy/{id}', 'SpringassistController@destroy')->name('springassist.destroy');
    Route::get('/springassist/recover/{id}', 'SpringassistController@recover')->name('springassist.recover');

    //Wrapped
    Route::get('/wrapped', 'WrappedController@index')->name('wrapped.list');
    Route::get('/wrapped/toggle/{id}/{show}', 'WrappedController@visibility')->name('wrapped.visibility');
    Route::get('/wrapped/add', 'WrappedController@create')->name('wrapped.add');
    Route::post('/wrapped/store', 'WrappedController@store')->name('wrapped.store');
    Route::get('/wrapped/edit/{id}', 'WrappedController@edit')->name('wrapped.edit');
    Route::post('/wrapped/update/{id}', 'WrappedController@update')->name('wrapped.update');
    Route::get('/wrapped/destroy/{id}', 'WrappedController@destroy')->name('wrapped.destroy');
    Route::get('/wrapped/recover/{id}', 'WrappedController@recover')->name('wrapped.recover');

    //Coupon
    Route::get('/coupon', 'CouponController@index')->name('coupon.list');
    Route::get('/coupon/toggle/{id}/{show}', 'CouponController@visibility')->name('coupon.visibility');
    Route::get('/coupon/add', 'CouponController@create')->name('coupon.add');
    Route::post('/coupon/store', 'CouponController@store')->name('coupon.store');
    Route::get('/coupon/edit/{id}', 'CouponController@edit')->name('coupon.edit');
    Route::post('/coupon/update/{id}', 'CouponController@update')->name('coupon.update');
    Route::get('/coupon/destroy/{id}', 'CouponController@destroy')->name('coupon.destroy');
    Route::get('/coupon/recover/{id}', 'CouponController@recover')->name('coupon.recover');

    //Control Type
    Route::get('/controltype/manual', 'ControltypeController@index_manual')->name('controltype.manual.list');
    Route::get('/controltype/manual/toggle/{id}/{show}', 'ControltypeController@visibility_manual')->name('controltype.manual.visibility');
    Route::get('/controltype/manual/add', 'ControltypeController@create_manual')->name('controltype.manual.add');
    Route::post('/controltype/manual/store', 'ControltypeController@store_manual')->name('controltype.manual.store');
    Route::get('/controltype/manual/edit/{id}', 'ControltypeController@edit_manual')->name('controltype.manual.edit');
    Route::post('/controltype/manual/update/{id}', 'ControltypeController@update_manual')->name('controltype.manual.update');
    Route::get('/controltype/manual/destroy/{id}', 'ControltypeController@destroy_manual')->name('controltype.manual.destroy');
    Route::get('/controltype/manual/recover/{id}', 'ControltypeController@recover_manual')->name('controltype.manual.recover');

    Route::get('/controltype/motor', 'ControltypeController@index_motor')->name('controltype.motor.list');
    Route::get('/controltype/motor/toggle/{id}/{show}', 'ControltypeController@visibility_motor')->name('controltype.motor.visibility');
    Route::get('/controltype/motor/add', 'ControltypeController@create_motor')->name('controltype.motor.add');
    Route::post('/controltype/motor/store', 'ControltypeController@store_motor')->name('controltype.motor.store');
    Route::get('/controltype/motor/edit/{id}', 'ControltypeController@edit_motor')->name('controltype.motor.edit');
    Route::post('/controltype/motor/update/{id}', 'ControltypeController@update_motor')->name('controltype.motor.update');
    Route::get('/controltype/motor/destroy/{id}', 'ControltypeController@destroy_motor')->name('controltype.motor.destroy');
    Route::get('/controltype/motor/recover/{id}', 'ControltypeController@recover_motor')->name('controltype.motor.recover');

    Route::get('/controltype/wid_motor', 'ControltypeController@index_wid_motor')->name('controltype.wid_motor.list');
    Route::get('/controltype/wid_motor/toggle/{id}/{show}', 'ControltypeController@visibility_wid_motor')->name('controltype.wid_motor.visibility');
    Route::get('/controltype/wid_motor/add', 'ControltypeController@create_wid_motor')->name('controltype.wid_motor.add');
    Route::post('/controltype/wid_motor/store', 'ControltypeController@store_wid_motor')->name('controltype.wid_motor.store');
    Route::get('/controltype/wid_motor/edit/{id}', 'ControltypeController@edit_wid_motor')->name('controltype.wid_motor.edit');
    Route::post('/controltype/wid_motor/update/{id}', 'ControltypeController@update_wid_motor')->name('controltype.wid_motor.update');
    Route::get('/controltype/wid_motor/destroy/{id}', 'ControltypeController@destroy_wid_motor')->name('controltype.wid_motor.destroy');
    Route::get('/controltype/wid_motor/recover/{id}', 'ControltypeController@recover_wid_motor')->name('controltype.wid_motor.recover');
    
    Route::get('/controltype/wand', 'ControltypeController@index_wand')->name('controltype.wand.list');
    Route::get('/controltype/wand/toggle/{id}/{show}', 'ControltypeController@visibility_wand')->name('controltype.wand.visibility');
    Route::get('/controltype/wand/add', 'ControltypeController@create_wand')->name('controltype.wand.add');
    Route::post('/controltype/wand/store', 'ControltypeController@store_wand')->name('controltype.wand.store');
    Route::get('/controltype/wand/edit/{id}', 'ControltypeController@edit_wand')->name('controltype.wand.edit');
    Route::post('/controltype/wand/update/{id}', 'ControltypeController@update_wand')->name('controltype.wand.update');
    Route::get('/controltype/wand/destroy/{id}', 'ControltypeController@destroy_wand')->name('controltype.wand.destroy');
    Route::get('/controltype/wand/recover/{id}', 'ControltypeController@recover_wand')->name('controltype.wand.recover');

    //Formula
    Route::get('/formula', 'FormulaController@index')->name('formula.list');
    Route::get('/formula/toggle/{id}/{show}', 'FormulaController@visibility')->name('formula.visibility');
    Route::get('/formula/add', 'FormulaController@create')->name('formula.add');
    Route::post('/formula/store', 'FormulaController@store')->name('formula.store');
    Route::get('/formula/edit/{id}', 'FormulaController@edit')->name('formula.edit');
    Route::post('/formula/update/{id}', 'FormulaController@update')->name('formula.update');
    Route::get('/formula/destroy/{id}', 'FormulaController@destroy')->name('formula.destroy');
    Route::get('/formula/recover/{id}', 'FormulaController@recover')->name('formula.recover');


    //Production
    Route::get('/move_productions/{id}', 'ProductionsController@index')->name('production.index');

    //Vendor Formula
    Route::get('/vendor_formulas', 'VendorFormulaController@index')->name('vend_formula.index');
    Route::get('/vendor_formulas/add', 'VendorFormulaController@create')->name('vend_formula.add');
    Route::post('/vendor_formulas/store', 'VendorFormulaController@store')->name('vend_formula.store');
    Route::get('/vendor_formulas/edit/{id}', 'VendorFormulaController@edit')->name('vend_formula.edit');
    Route::post('/vendor_formulas/update/{id}', 'VendorFormulaController@update')->name('vend_formula.update');
    Route::get('/vendor_formulas/destroy/{id}', 'VendorFormulaController@destroy')->name('vend_formula.destroy');
    Route::get('/vendor_formulas/recover/{id}', 'VendorFormulaController@recover')->name('vend_formula.recover');
    Route::get('/vendor_formulas/toggle/{id}/{show}', 'VendorFormulaController@visibility')->name('vend_formula.visibility');


    /////////////////////
    
    Route::get('/file/list', 'AdminFiles@index')->name('uploaded-files.list');
    Route::get('/file/upload', 'AdminFiles@create')->name('uploaded-files.create');
    Route::post('/file/upload', 'AdminFiles@UploadFile')->name('uploaded-files.store');
    Route::get('/file/delete/{id}', 'AdminFiles@DelFile');
    

});

//Get Parent ID
Route::post('/get_parent', 'ProductController@get_cat_parent');

//Add Fabric if not found.
Route::post('/prod_add_fabric', 'ProductController@add_fabric');

///////////TEST
Route::post('/getmyprice', 'ProductController@getmyprice');




Route::get('/support_ticket/show_files/{file}', 'SupportTicketController@show_files');

Route::post('/getstates', 'SellerController@return_states')->name('seller.states');
