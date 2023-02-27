<div class="aiz-sidebar-wrap">
    <div class="aiz-sidebar left c-scrollbar">
        <div class="aiz-side-nav-logo-wrap">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="d-block text-left">
                <?php if(get_setting('system_logo_white') != null): ?>
                    <img class="mw-100" width="200px" src="<?php echo e(uploaded_asset(get_setting('system_logo_white'))); ?>"
                        class="brand-icon" alt="<?php echo e(get_setting('site_name')); ?>">
                <?php else: ?>
                    <img class="mw-100" width="200px" src="<?php echo e(static_asset('assets/img/logo-white.png')); ?>"
                        class="brand-icon" alt="<?php echo e(get_setting('site_name')); ?>">
                <?php endif; ?>
            </a>
        </div>
        <div class="aiz-side-nav-wrap">
            <div class="px-20px mb-3">
                <input class="form-control bg-soft-secondary form-control-sm border-0 text-white" type="text"
                    name="" placeholder="<?php echo e(translate('Search in menu')); ?>" id="menu-search"
                    onkeyup="menuSearch()">
            </div>
            <ul class="aiz-side-nav-list" id="search-menu">
            </ul>
            <ul class="aiz-side-nav-list" id="main-menu" data-toggle="aiz-side-menu">
                <li class="aiz-side-nav-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="aiz-side-nav-link">
                        <i class="las la-home aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?php echo e(translate('Dashboard')); ?></span>
                    </a>
                </li>

                <!-- POS Addon-->
                <?php if(\App\Addon::where('unique_identifier', 'pos_system')->first() != null &&
                    \App\Addon::where('unique_identifier', 'pos_system')->first()->activated): ?>
                    <?php if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions))): ?>
                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <i class="las la-tasks aiz-side-nav-icon"></i>
                                <span class="aiz-side-nav-text"><?php echo e(translate('POS System')); ?></span>
                                <?php if(env('DEMO_MODE') == 'On'): ?>
                                    <span class="badge badge-inline badge-danger">Addon</span>
                                <?php endif; ?>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('poin-of-sales.index')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['poin-of-sales.index', 'poin-of-sales.create'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('POS Manager')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('poin-of-sales.activation')); ?>" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('POS Configuration')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Product -->
                <?php if(Auth::user()->user_type == 'admin' || in_array('2', json_decode(Auth::user()->staff->role->permissions))): ?>
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-shopping-cart aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text"><?php echo e(translate('Products')); ?></span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <!--Submenu-->
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a class="aiz-side-nav-link" href="<?php echo e(route('products.create')); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Add New product')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('products.admin')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('All Products')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('backend.status.view')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Status')); ?></span> 
                                </a>
                            </li>
                            <!-- <li class="aiz-side-nav-item">
                                <a href="" class="aiz-side-nav-link" >
                                    <span class="aiz-side-nav-text"></span>
                                </a>
                            </li> -->
                            <?php if(get_setting('vendor_system_activation') == 1 && false): ?>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('products.seller')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['products.seller', 'products.seller.edit'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Dealer Products')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('parts.admin')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Parts')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('product_bulk_upload.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Bulk Import/Export')); ?></span>
                                </a>
                            </li>

                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('categories.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['categories.index', 'categories.create', 'categories.edit'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Category')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('brands.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['brands.index', 'brands.create', 'brands.edit'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Brand')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('attributes.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['attributes.index', 'attributes.create', 'attributes.edit'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Attribute')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item d-none">
                                <a href="<?php echo e(route('colors')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['attributes.index', 'attributes.create', 'attributes.edit'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Colors')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('reviews.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Product Reviews')); ?></span>
                                </a>
                            </li>
                            <!-- Fabric Start-->
                            <li class="aiz-side-nav-item">
                                <a href="#" class="aiz-side-nav-link">
                                    <i class="las aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Fabric</span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('fabric.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Fabric List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('fabric.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Fabric</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('wrapped.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Wrapped List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('wrapped.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Wrapped</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Fabric End-->
                            <!-- Smartoption Start-->
                            <li class="aiz-side-nav-item">
                                <a href="#" class="aiz-side-nav-link">
                                    <i class="las aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Smartoptions</span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('smartoptions.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Smartoptions List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('smartoptions.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Smartoptions</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('controltype.motor.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Motors List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('controltype.motor.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Motor</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('controltype.wid_motor.list')); ?>"
                                            class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Motors(Width) List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('controltype.wid_motor.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Motor(Width)</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Smartoption End-->
                            <!-- Mount Start-->
                            <li class="aiz-side-nav-item">
                                <a href="#" class="aiz-side-nav-link">
                                    <i class="las aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Mount</span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('mount.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Mount Types List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('mount.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Mount</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('mountposition.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Mount Positions</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('mountposition.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Positions</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Mount End-->
                            <!-- Room Type Start-->
                            <li class="aiz-side-nav-item">
                                <a href="#" class="aiz-side-nav-link">
                                    <i class="las aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Room Types</span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('roomtype.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Room Types List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('roomtype.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Room Types</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Room Type End-->
                            <!-- Bracket Start-->
                            <li class="aiz-side-nav-item">
                                <a href="#" class="aiz-side-nav-link">
                                    <i class="las aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Brackets</span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('bracket.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Brackets List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('bracket.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Brackets</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Bracket End-->
                            <!-- Stack Start-->
                            <li class="aiz-side-nav-item">
                                <a href="#" class="aiz-side-nav-link">
                                    <i class="las aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Stacks</span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('stack.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Stacks List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('stack.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Stacks</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Stack End-->
                            <!-- Cassette Start-->
                            <li class="aiz-side-nav-item">
                                <a href="#" class="aiz-side-nav-link">
                                    <i class="las aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Cassettes</span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('cassette.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Cassettes List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('cassette.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Cassette</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Cassette End-->
                            <!-- Spring Assist Start-->
                            <li class="aiz-side-nav-item">
                                <a href="#" class="aiz-side-nav-link">
                                    <i class="las aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Spring Assist</span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('springassist.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Spring Assists List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('springassist.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Spring Assist</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Spring Assist End-->
                            <!-- Control Type Start-->
                            <li class="aiz-side-nav-item">
                                <a href="#" class="aiz-side-nav-link">
                                    <i class="las aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Control Types</span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('controltype.manual.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Manual List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('controltype.manual.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Manual</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('controltype.wand.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Wands List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('controltype.wand.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Wands</span>
                                        </a>
                                    </li>
                                </ul>

                            </li>
                            <!-- Control Type End-->
                            <!-- Coupon Start-->
                            <li class="aiz-side-nav-item">
                                <a href="#" class="aiz-side-nav-link">
                                    <i class="las aiz-side-nav-icon"></i>
                                    <span class="aiz-side-nav-text">Coupons</span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('coupon.list')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Coupons List</span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('coupon.add')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">Add Coupons</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Coupon End-->
                        </ul>
                    </li>
                <?php endif; ?>
                
                <!-- Sale -->
                <li class="aiz-side-nav-item">
                    <a href="<?php echo e(route('seller_orders.index')); ?>" class="aiz-side-nav-link">
                        <i class="las la-money-bill aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?php echo e(translate('Orders')); ?></span>
                    </a>
                </li>

                <!-- Deliver Boy Addon-->
                <?php if(\App\Addon::where('unique_identifier', 'delivery_boy')->first() != null &&
                    \App\Addon::where('unique_identifier', 'delivery_boy')->first()->activated): ?>
                    <?php if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions))): ?>
                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <i class="las la-truck aiz-side-nav-icon"></i>
                                <span class="aiz-side-nav-text"><?php echo e(translate('Delivery Boy')); ?></span>
                                <?php if(env('DEMO_MODE') == 'On'): ?>
                                    <span class="badge badge-inline badge-danger">Addon</span>
                                <?php endif; ?>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('delivery-boys.index')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['delivery-boys.index'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('All Delivery Boy')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('delivery-boys.create')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['delivery-boys.create'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Add Delivery Boy')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('delivery-boy.cancel-request')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['delivery-boy.cancel-request'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Cancel Request')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('delivery-boy-configuration')); ?>" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Configuration')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Refund addon -->
                <?php if(\App\Addon::where('unique_identifier', 'refund_request')->first() != null &&
                    \App\Addon::where('unique_identifier', 'refund_request')->first()->activated): ?>
                    <?php if(Auth::user()->user_type == 'admin' || in_array('7', json_decode(Auth::user()->staff->role->permissions))): ?>
                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <i class="las la-backward aiz-side-nav-icon"></i>
                                <span class="aiz-side-nav-text"><?php echo e(translate('Refunds')); ?></span>
                                <?php if(env('DEMO_MODE') == 'On'): ?>
                                    <span class="badge badge-inline badge-danger">Addon</span>
                                <?php endif; ?>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('refund_requests_all')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['refund_requests_all', 'reason_show'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Refund Requests')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('paid_refund')); ?>" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Approved Refunds')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('rejected_refund')); ?>" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('rejected Refunds')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('refund_time_config')); ?>" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Refund Configuration')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>


                <!-- Customers -->
                <?php if(Auth::user()->user_type == 'admin' || in_array('8', json_decode(Auth::user()->staff->role->permissions))): ?>
                    <!-- <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-user-friends aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text"><?php echo e(translate('Customers')); ?></span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('customers.create')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Add New Customer')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('customers.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Customer list')); ?></span>
                                </a>
                            </li> -->
                    <?php if(get_setting('classified_product') == 1): ?>
                        <!-- <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('classified_products')); ?>" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Classified Products')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('customer_packages.index')); ?>" class="aiz-side-nav-link <?php echo e(areActiveRoutes(['customer_packages.index', 'customer_packages.create', 'customer_packages.edit'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Classified Packages')); ?></span>
                                    </a>
                                </li> -->
                    <?php endif; ?>
                    <!-- </ul>
                    </li> -->
                <?php endif; ?>

                <!-- Production -->
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-industry aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Production</span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a class="aiz-side-nav-link" href="<?php echo e(route('vend_formula.index')); ?>">
                                <span class="aiz-side-nav-text">Vendors List</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a class="aiz-side-nav-link" href="<?php echo e(route('vend_formula.add')); ?>">
                                <span class="aiz-side-nav-text"><?php echo e(translate('Add New Vendor')); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Sellers -->
                <?php if((Auth::user()->user_type == 'admin' || in_array('9', json_decode(Auth::user()->staff->role->permissions))) &&
                    get_setting('vendor_system_activation') == 1): ?>
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-user aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text"><?php echo e(translate('Dealers')); ?></span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <?php
                                    $sellers = \App\Seller::where('verification_status', 0)
                                        ->where('verification_info', '!=', null)
                                        ->count();
                                ?>
                                <a href="<?php echo e(route('backend.sellers.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('All Dealer')); ?></span>
                                    <?php if($sellers > 0): ?>
                                        <span class="badge badge-info"><?php echo e($sellers); ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('sellers.payment_histories')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Payouts')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('withdraw_requests_all')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Payout Requests')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('business_settings.vendor_commission')); ?>"
                                    class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Dealer Commission')); ?></span>
                                </a>
                            </li>

                            <?php if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null &&
                                \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated): ?>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('seller_packages.index')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['seller_packages.index', 'seller_packages.create', 'seller_packages.edit'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Dealer Packages')); ?></span>
                                        <?php if(env('DEMO_MODE') == 'On'): ?>
                                            <span class="badge badge-inline badge-danger">Addon</span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('seller_verification_form.index')); ?>" class="aiz-side-nav-link">
                                    <span
                                        class="aiz-side-nav-text"><?php echo e(translate('Dealer Verification Form')); ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if(Auth::user()->user_type == 'admin' || in_array('22', json_decode(Auth::user()->staff->role->permissions))): ?>
                    <li class="aiz-side-nav-item">
                        <a href="<?php echo e(route('uploaded-files.list')); ?>"
                            class="aiz-side-nav-link <?php echo e(areActiveRoutes(['uploaded-files.create'])); ?>">
                            <i class="las la-folder-open aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text"><?php echo e(translate('Uploaded Files')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                
                <!-- Reports -->
                <?php if(Auth::user()->user_type == 'admin' || in_array('10', json_decode(Auth::user()->staff->role->permissions))): ?>
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-file-alt aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text"><?php echo e(translate('Reports')); ?></span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('in_house_sale_report.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['in_house_sale_report.index'])); ?>">
                                    <span
                                        class="aiz-side-nav-text"><?php echo e(translate('Finished Goods Product Sale')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('seller_sale_report.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['seller_sale_report.index'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Dealer Products Sale')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('stock_report.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['stock_report.index'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Products Stock')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('wish_report.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['wish_report.index'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Products wishlist')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('user_search_report.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['user_search_report.index'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('User Searches')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('commission-log.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Commission History')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('wallet-history.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Wallet Recharge History')); ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                

                <!-- marketing -->
                <?php if(Auth::user()->user_type == 'admin' || in_array('11', json_decode(Auth::user()->staff->role->permissions))): ?>
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-bullhorn aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text"><?php echo e(translate('Marketing')); ?></span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <?php if(Auth::user()->user_type == 'admin' || in_array('2', json_decode(Auth::user()->staff->role->permissions))): ?>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('flash_deals.index')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['flash_deals.index', 'flash_deals.create', 'flash_deals.edit'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Flash deals')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(Auth::user()->user_type == 'admin' || in_array('7', json_decode(Auth::user()->staff->role->permissions))): ?>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('newsletters.index')); ?>" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Newsletters')); ?></span>
                                    </a>
                                </li>
                                <?php if(\App\Addon::where('unique_identifier', 'otp_system')->first() != null &&
                                    \App\Addon::where('unique_identifier', 'otp_system')->first()->activated): ?>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('sms.index')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text"><?php echo e(translate('Bulk SMS')); ?></span>
                                            <?php if(env('DEMO_MODE') == 'On'): ?>
                                                <span class="badge badge-inline badge-danger">Addon</span>
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Support -->
                <?php if(Auth::user()->user_type == 'admin' || in_array('12', json_decode(Auth::user()->staff->role->permissions))): ?>
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-link aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text"><?php echo e(translate('Support')); ?></span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <?php if(Auth::user()->user_type == 'admin' || in_array('12', json_decode(Auth::user()->staff->role->permissions))): ?>
                                <?php
                                    $support_ticket = \App\Ticket::whereHas('user')->count();
                                ?>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('support_ticket.admin_index')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['support_ticket.admin_index', 'support_ticket.admin_show'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Ticket')); ?></span>
                                        <?php if($support_ticket > 0): ?>
                                            <span class="badge badge-info"><?php echo e($support_ticket); ?></span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php
                                $conversation = \App\Conversation::where('receiver_id', Auth::user()->id)
                                    ->where('receiver_viewed', '1')
                                    ->get();
                            ?>
                            <?php if(Auth::user()->user_type == 'admin' || in_array('12', json_decode(Auth::user()->staff->role->permissions))): ?>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('conversations.admin_index')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['conversations.admin_index', 'conversations.admin_show'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Product Queries')); ?></span>
                                        <?php if(count($conversation) > 0): ?>
                                            <span class="badge badge-info"><?php echo e(count($conversation)); ?></span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Affiliate Addon -->
                <?php if(\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
                    \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated): ?>
                    <?php if(Auth::user()->user_type == 'admin' || in_array('15', json_decode(Auth::user()->staff->role->permissions))): ?>
                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <i class="las la-link aiz-side-nav-icon"></i>
                                <span class="aiz-side-nav-text"><?php echo e(translate('Affiliate System')); ?></span>
                                <?php if(env('DEMO_MODE') == 'On'): ?>
                                    <span class="badge badge-inline badge-danger">Addon</span>
                                <?php endif; ?>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('affiliate.configs')); ?>" class="aiz-side-nav-link">
                                        <span
                                            class="aiz-side-nav-text"><?php echo e(translate('Affiliate Registration Form')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('affiliate.index')); ?>" class="aiz-side-nav-link">
                                        <span
                                            class="aiz-side-nav-text"><?php echo e(translate('Affiliate Configurations')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('affiliate.users')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['affiliate.users', 'affiliate_users.show_verification_request', 'affiliate_user.payment_history'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Affiliate Users')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('refferals.users')); ?>" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Referral Users')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('affiliate.withdraw_requests')); ?>" class="aiz-side-nav-link">
                                        <span
                                            class="aiz-side-nav-text"><?php echo e(translate('Affiliate Withdraw Requests')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('affiliate.logs.admin')); ?>" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Affiliate Logs')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Offline Payment Addon-->
                <?php if(\App\Addon::where('unique_identifier', 'offline_payment')->first() != null &&
                    \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated): ?>
                    <?php if(Auth::user()->user_type == 'admin' || in_array('16', json_decode(Auth::user()->staff->role->permissions))): ?>
                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <i class="las la-money-check-alt aiz-side-nav-icon"></i>
                                <span class="aiz-side-nav-text"><?php echo e(translate('Offline Payment System')); ?></span>
                                <?php if(env('DEMO_MODE') == 'On'): ?>
                                    <span class="badge badge-inline badge-danger">Addon</span>
                                <?php endif; ?>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('manual_payment_methods.index')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['manual_payment_methods.index', 'manual_payment_methods.create', 'manual_payment_methods.edit'])); ?>">
                                        <span
                                            class="aiz-side-nav-text"><?php echo e(translate('Manual Payment Methods')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('offline_wallet_recharge_request.index')); ?>"
                                        class="aiz-side-nav-link">
                                        <span
                                            class="aiz-side-nav-text"><?php echo e(translate('Offline Wallet Recharge')); ?></span>
                                    </a>
                                </li>
                                <?php if(get_setting('classified_product') == 1): ?>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('offline_customer_package_payment_request.index')); ?>"
                                            class="aiz-side-nav-link">
                                            <span
                                                class="aiz-side-nav-text"><?php echo e(translate('Offline Customer Package Payments')); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null &&
                                    \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated): ?>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('offline_seller_package_payment_request.index')); ?>"
                                            class="aiz-side-nav-link">
                                            <span
                                                class="aiz-side-nav-text"><?php echo e(translate('Offline Dealer Package Payments')); ?></span>
                                            <?php if(env('DEMO_MODE') == 'On'): ?>
                                                <span class="badge badge-inline badge-danger">Addon</span>
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Paytm Addon -->
                <?php if(\App\Addon::where('unique_identifier', 'paytm')->first() != null &&
                    \App\Addon::where('unique_identifier', 'paytm')->first()->activated): ?>
                    <?php if(Auth::user()->user_type == 'admin' || in_array('17', json_decode(Auth::user()->staff->role->permissions))): ?>
                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <i class="las la-mobile-alt aiz-side-nav-icon"></i>
                                <span class="aiz-side-nav-text"><?php echo e(translate('Paytm Payment Gateway')); ?></span>
                                <?php if(env('DEMO_MODE') == 'On'): ?>
                                    <span class="badge badge-inline badge-danger">Addon</span>
                                <?php endif; ?>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('paytm.index')); ?>" class="aiz-side-nav-link">
                                        <span
                                            class="aiz-side-nav-text"><?php echo e(translate('Set Paytm Credentials')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Club Point Addon-->
                <?php if(\App\Addon::where('unique_identifier', 'club_point')->first() != null &&
                    \App\Addon::where('unique_identifier', 'club_point')->first()->activated): ?>
                    <?php if(Auth::user()->user_type == 'admin' || in_array('18', json_decode(Auth::user()->staff->role->permissions))): ?>
                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <i class="lab la-btc aiz-side-nav-icon"></i>
                                <span class="aiz-side-nav-text"><?php echo e(translate('Club Point System')); ?></span>
                                <?php if(env('DEMO_MODE') == 'On'): ?>
                                    <span class="badge badge-inline badge-danger">Addon</span>
                                <?php endif; ?>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('club_points.configs')); ?>" class="aiz-side-nav-link">
                                        <span
                                            class="aiz-side-nav-text"><?php echo e(translate('Club Point Configurations')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('set_product_points')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['set_product_points', 'product_club_point.edit'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Set Product Point')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('club_points.index')); ?>"
                                        class="aiz-side-nav-link <?php echo e(areActiveRoutes(['club_points.index', 'club_point.details'])); ?>">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('User Points')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!--OTP addon -->
                <?php if(\App\Addon::where('unique_identifier', 'otp_system')->first() != null &&
                    \App\Addon::where('unique_identifier', 'otp_system')->first()->activated): ?>
                    <?php if(Auth::user()->user_type == 'admin' || in_array('19', json_decode(Auth::user()->staff->role->permissions))): ?>
                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <i class="las la-phone aiz-side-nav-icon"></i>
                                <span class="aiz-side-nav-text"><?php echo e(translate('OTP System')); ?></span>
                                <?php if(env('DEMO_MODE') == 'On'): ?>
                                    <span class="badge badge-inline badge-danger">Addon</span>
                                <?php endif; ?>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('otp.configconfiguration')); ?>" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('OTP Configurations')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('sms-templates.index')); ?>" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('SMS Templates')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('otp_credentials.index')); ?>" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text"><?php echo e(translate('Set OTP Credentials')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(\App\Addon::where('unique_identifier', 'african_pg')->first() != null &&
                    \App\Addon::where('unique_identifier', 'african_pg')->first()->activated): ?>
                    <?php if(Auth::user()->user_type == 'admin' || in_array('19', json_decode(Auth::user()->staff->role->permissions))): ?>
                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <i class="las la-phone aiz-side-nav-icon"></i>
                                <span
                                    class="aiz-side-nav-text"><?php echo e(translate('African Payment Gateway Addon')); ?></span>
                                <?php if(env('DEMO_MODE') == 'On'): ?>
                                    <span class="badge badge-inline badge-danger">Addon</span>
                                <?php endif; ?>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('african.configuration')); ?>" class="aiz-side-nav-link">
                                        <span
                                            class="aiz-side-nav-text"><?php echo e(translate('African PG Configurations')); ?></span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="<?php echo e(route('african_credentials.index')); ?>" class="aiz-side-nav-link">
                                        <span
                                            class="aiz-side-nav-text"><?php echo e(translate('Set African PG Credentials')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Website Setup -->
                

                <!-- Setup & Configurations -->
                <?php if(Auth::user()->user_type == 'admin' || in_array('14', json_decode(Auth::user()->staff->role->permissions))): ?>
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-dharmachakra aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text"><?php echo e(translate('Setup & Configurations')); ?></span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('general_setting.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('General Settings')); ?></span>
                                </a>
                            </li>

                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('activation.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Features activation')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('languages.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['languages.index', 'languages.create', 'languages.store', 'languages.show', 'languages.edit'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Languages')); ?></span>
                                </a>
                            </li>

                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('currency.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Currency')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('tax.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['tax.index', 'tax.create', 'tax.store', 'tax.show', 'tax.edit'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Vat & TAX')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('pick_up_points.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['pick_up_points.index', 'pick_up_points.create', 'pick_up_points.edit'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Pickup point')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('smtp_settings.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('SMTP Settings')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('email_content.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Email Content')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('payment_method.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Payment Methods')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('file_system.index')); ?>" class="aiz-side-nav-link">
                                    <span
                                        class="aiz-side-nav-text"><?php echo e(translate('File System & Cache Configuration')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('social_login.index')); ?>" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Social media Logins')); ?></span>
                                </a>
                            </li>

                            <li class="aiz-side-nav-item">
                                <a href="javascript:void(0);" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Facebook')); ?></span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('facebook_chat.index')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text"><?php echo e(translate('Facebook Chat')); ?></span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('facebook-comment')); ?>" class="aiz-side-nav-link">
                                            <span
                                                class="aiz-side-nav-text"><?php echo e(translate('Facebook Comment')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="aiz-side-nav-item">
                                <a href="javascript:void(0);" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Google')); ?></span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('google_analytics.index')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text"><?php echo e(translate('Analytics Tools')); ?></span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('google_recaptcha.index')); ?>" class="aiz-side-nav-link">
                                            <span
                                                class="aiz-side-nav-text"><?php echo e(translate('Google reCAPTCHA')); ?></span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('google-map.index')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text"><?php echo e(translate('Google Map')); ?></span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('google-firebase.index')); ?>" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text"><?php echo e(translate('Google Firebase')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>




                            <li class="aiz-side-nav-item">
                                <a href="javascript:void(0);" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Shipping')); ?></span>
                                    <span class="aiz-side-nav-arrow"></span>
                                </a>
                                <ul class="aiz-side-nav-list level-3">
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('shipping_configuration.index')); ?>"
                                            class="aiz-side-nav-link <?php echo e(areActiveRoutes(['shipping_configuration.index', 'shipping_configuration.edit', 'shipping_configuration.update'])); ?>">
                                            <span
                                                class="aiz-side-nav-text"><?php echo e(translate('Shipping Configuration')); ?></span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('countries.index')); ?>"
                                            class="aiz-side-nav-link <?php echo e(areActiveRoutes(['countries.index', 'countries.edit', 'countries.update'])); ?>">
                                            <span
                                                class="aiz-side-nav-text"><?php echo e(translate('Shipping Countries')); ?></span>
                                        </a>
                                    </li>
                                    <li class="aiz-side-nav-item">
                                        <a href="<?php echo e(route('cities.index')); ?>"
                                            class="aiz-side-nav-link <?php echo e(areActiveRoutes(['cities.index', 'cities.edit', 'cities.update'])); ?>">
                                            <span class="aiz-side-nav-text"><?php echo e(translate('Shipping Cities')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                <?php endif; ?>


                <!-- Staffs -->
                <?php if(Auth::user()->user_type == 'admin' || in_array('20', json_decode(Auth::user()->staff->role->permissions))): ?>
                    <li class="aiz-side-nav-item d-none">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-user-tie aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text"><?php echo e(translate('Staffs')); ?></span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('staffs.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['staffs.index', 'staffs.create', 'staffs.edit'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('All staffs')); ?></span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="<?php echo e(route('roles.index')); ?>"
                                    class="aiz-side-nav-link <?php echo e(areActiveRoutes(['roles.index', 'roles.create', 'roles.edit'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Staff permissions')); ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                

                <!-- Addon Manager -->
                
            </ul><!-- .aiz-side-nav -->
        </div><!-- .aiz-side-nav-wrap -->
    </div><!-- .aiz-sidebar -->
    <div class="aiz-sidebar-overlay"></div>
</div><!-- .aiz-sidebar -->
<?php /**PATH F:\xampp7\htdocs\ERP\resources\views/backend/inc/admin_sidenav.blade.php ENDPATH**/ ?>