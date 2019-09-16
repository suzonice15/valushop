<?php
defined('BASEPATH') OR exit('No direct script access allowed');





/************************ login  ************************/

$route['admin'] = 'UserController';
$route['dashboard'] = 'DashboardController';
$route['login-check'] = 'UserController/loginCheck';
$route['logout'] = 'UserController/logOut';
$route['promotion-update'] = 'management/promotionsController/update';


/************************ user  ************************/

$route['users'] = 'user/UserController/index';
$route['user-create'] = 'user/UserController/create';
$route['user-save'] = 'user/UserController/store';
$route['user-update'] = 'user/UserController/update';
$route['user-edit/(:any)'] = 'user/UserController/edit/$1';
$route['logout'] = 'UserController/logOut';
$route['promotion-update'] = 'management/promotionsController/update';

/****************************** order ***************************************/

$route['order-list'] = 'order/OrderController/index';
$route['order-today-list'] = 'order/OrderController/orderToday';
$route['order-create'] = 'order/OrderController/create';
$route['order-view/(:any)'] = 'order/OrderController/order_view/$1';
$route['order-delete/(:any)'] = 'order/OrderController/delete/$1';
$route['order-update'] = 'order/OrderController/update';
$route['order-default'] = 'order/OrderController/default';
$route['order-list-report'] = 'order/OrderController/totalOrderReport';
$route['order-report'] = 'order/OrderController/report';
$route['order-social'] = 'order/OrderController/social';
$route['order-popup'] = 'order/OrderController/popup';
$route['order-facebook'] = 'order/OrderController/facebook';





/************************ category  ************************/

$route['category-create'] = 'Category/CategoryController/create';
$route['category-save'] = 'category/CategoryController/store';
$route['category-edit/(:any)'] = 'category/CategoryController/edit/$1';
$route['category-delete/(:any)'] = 'category/CategoryController/destroy/$1';
$route['category-list'] = 'category/CategoryController/index';
$route['category-update'] = 'category/CategoryController/update';


/************************ Courier  ************************/

$route['courier-create'] = 'courier/CourierController/create';
$route['courier-save'] = 'courier/CourierController/store';
$route['courier-edit/(:any)'] = 'courier/CourierController/edit/$1';
$route['courier-delete/(:any)'] = 'courier/CourierController/destroy/$1';
$route['courier-list'] = 'courier/CourierController/index';
$route['courier-update'] = 'courier/CourierController/update';


/*********************** product  ***********************/

$route['product-create'] = 'product/ProductController/create';
$route['product-save'] = 'product/ProductController/store';
$route['product-edit/(:any)'] = 'product/ProductController/edit/$1';
$route['product-delete/(:any)'] = 'product/ProductController/destroy/$1';
$route['product-list'] = 'product/ProductController/index';
$route['product-update'] = 'product/ProductController/update';
$route['product-limited'] = 'product/ProductController/limited';
$route['product-bad-stock'] = 'product/ProductController/stock';
$route['product-return'] = 'product/ProductController/stock';
$route['product-demage'] = 'product/ProductController/stock';

/********************product size *******************************/
$route['product-size-save'] = 'product/ProductController/sizeSave';
$route['product-size-update'] = 'product/ProductController/sizeUpdate';
$route['product-size-edit/(:any)'] = 'product/ProductController/sizeEdit/$1';
$route['product-size'] = 'product/ProductController/size';


/********************product color *******************************/
$route['product-color-save'] = 'product/ProductController/colorSave';
$route['product-color-update'] = 'product/ProductController/colorUpdate';
$route['product-color-edit/(:any)'] = 'product/ProductController/colorEdit/$1';
$route['product-color'] = 'product/ProductController/color';


/*********************** slider  ***********************/

$route['slider-create'] = 'slider/SliderController/create';
$route['slider-save'] = 'slider/SliderController/store';
$route['slider-edit/(:any)'] = 'slider/SliderController/edit/$1';
$route['slider-delete/(:any)'] = 'slider/SliderController/destroy/$1';
$route['slider-list'] = 'slider/SliderController/index';
$route['slider-update'] = 'slider/SliderController/update';


/*********************** ADD  ***********************/

$route['add-create'] = 'add/AddController/create';
$route['add-save'] = 'add/AddController/store';
$route['add-edit/(:any)'] = 'add/AddController/edit/$1';
$route['add-delete/(:any)'] = 'add/AddController/destroy/$1';
$route['add-list'] = 'add/AddController/index';
$route['add-update'] = 'add/AddController/update';



/*********************** media  ***********************/

$route['media-create'] = 'media/MediaController/create';
$route['media-save'] = 'media/MediaController/store';
$route['media-edit/(:any)'] = 'media/MediaController/edit/$1';
$route['media-delete/(:any)'] = 'media/MediaController/destroy/$1';
$route['media-list'] = 'media/MediaController/index';
$route['media-update'] = 'media/MediaController/update';
$route['picture-delete'] = 'media/MediaController/picture_delete';



/*********************** expense category  ***********************/

$route['expense-category-create'] = 'expense/ExpenseController/create';
$route['expense-category-save'] = 'expense/ExpenseController/store';
$route['expense-category-edit/(:any)'] = 'expense/ExpenseController/edit/$1';
$route['expense-category-delete/(:any)'] = 'expense/ExpenseController/destroy/$1';
$route['expense-category-list'] = 'expense/ExpenseController/index';
$route['expense-category-update'] = 'expense/ExpenseController/update';





/****************************** setting ***************************************/

$route['setting-default'] = 'setting/SettingController/default';
$route['setting-home'] = 'setting/SettingController/home';
$route['setting-extra'] = 'setting/SettingController/extra';
$route['setting-default'] = 'setting/SettingController/default';
$route['setting-default'] = 'setting/SettingController/default';
$route['setting-social'] = 'setting/SettingController/social';
$route['setting-popup'] = 'setting/SettingController/popup';
$route['setting-facebook'] = 'setting/SettingController/facebook';

/****************************** Page ***************************************/

$route['page-list'] = 'page/PageController/index';
$route['page-create'] = 'page/PageController/create';
$route['page-save'] = 'page/PageController/store';
$route['page-edit/(:any)'] = 'page/PageController/edit/$1';
$route['page-update'] = 'page/PageController/update';
$route['page-delete/(:any)'] = 'page/PageController/destroy/$1';



/********************************* website          *********************************/

$route['default_controller'] = 'Home';
$route['chechout'] = 'Home/checkout';
$route['checkout/thank-you'] = 'Home/thank_you';
$route['category/(:any)'] = 'Home/category/$1';
$route['product/(:any)'] = 'Home/product/$1';






//$route['404_override'] = 'Custom404';
$route['translate_uri_dashes'] = FALSE;
