<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login-user'] = 'Welcome/login_user';
$route['logout'] = 'AdminController/logout';

$route['addcard'] = 'Welcome/addcard';
$route['product/(:any)'] ='Welcome/product/$1';
$route['cart'] ='Welcome/cart';
$route['update_cart'] ='Welcome/update_cart';
$route['checkout'] ='Welcome/checkout';
$route['place-order'] ='Welcome/place_order';
$route['shop'] ='Welcome/shop';
$route['order_success'] ='Welcome/order_success';



$route['edit-category/(:num)'] = 'AdminController/edit_category/(:num)';
$route['update-category'] = 'AdminController/update_category';
$route['delete-category/(:num)'] = 'AdminController/delete_category/(:num)';

$route['customer-list'] = 'AdminController/customer_list';
$route['add-customer'] = 'AdminController/add_customer';
$route['addcustomer'] = 'AdminController/addcustomer';
$route['edit-customer/(:num)'] = 'AdminController/edit_customer/(:num)';
$route['update-customer'] = 'AdminController/update_customer';
$route['delete-customer/(:num)'] = 'AdminController/delete_customer/(:num)';

$route['employee-list'] = 'AdminController/employee_list';
$route['admission-form'] = 'AdminController/admission_form';

// admin controllers

$route['add-users'] = 'AdminController/add_users';
$route['addusers'] = 'AdminController/addusers';


$route['emp-leave-list'] = 'AdminController/emp_leave_list';
$route['leave-status/(:num)/(:num)'] = 'AdminController/leave_status/(:num)/(:num)';
$route['emp-work-list'] = 'AdminController/emp_work_list';
$route['emp-login-list'] = 'AdminController/emp_login_list';

// cateory_list
$route['category_list'] = 'AdminController/category_list';
$route['add-category'] = 'AdminController/add_category';
$route['insert-notes'] = 'AdminController/insert_notes';
$route['edit-category/(:num)'] = 'AdminController/edit_category/(:num)';
$route['update-notes/(:num)'] = 'AdminController/update_notes/(:num)';
$route['delete-category/(:num)'] = 'AdminController/delete_category/(:num)';

#subcategory route
$route['subcategory-list'] = 'AdminController/subcategory_list';
$route['add-subcategory'] = 'AdminController/add_subcategory';
$route['addsubcategory'] = 'AdminController/addsallery';
$route['edit-subcategory/(:num)'] = 'AdminController/edit_subcategory/(:num)';
$route['updatesubcategory/(:num)'] = 'AdminController/updatesubcategory/(:num)';
$route['delete-subcategory/(:num)'] = 'AdminController/delete_subcategory/(:num)';
#offers route

$route['offers-list'] = 'AdminController/offers_list';
$route['add-offer'] = 'AdminController/add_offers';
$route['insert-offers'] = 'AdminController/insert_offers';
$route['edit-offer/(:num)'] = 'AdminController/edit_offers/(:num)';
$route['updateoffers/(:num)'] = 'AdminController/updateoffers/(:num)';
$route['delete-offer/(:num)'] = 'AdminController/delete_offers/(:num)';

// invoice route
$route['invoice'] = 'AdminController/invoice';
$route['add-invoice'] = 'AdminController/add_invoice';
$route['addinvoive'] = 'AdminController/addinvoive';
$route['print-invoice/(:num)'] = 'AdminController/print_invoice/(:num)';
$route['edit-invoice/(:num)'] = 'AdminController/edit_invoice/(:num)';
$route['updateinvoive/(:num)'] = 'AdminController/updateinvoive/(:num)';
$route['delete-poster/(:num)'] = 'AdminController/delete_poster/(:num)';



$route['free-poster'] = 'AdminController/free_poster';
$route['addfreeposter'] = 'AdminController/addfreeposter';
$route['insertfreeposter'] = 'AdminController/insertfreeposter';
$route['edit-freeposter/(:num)'] = 'AdminController/edit_freeposter/(:num)';
$route['updatefreeposter/(:num)'] = 'AdminController/updatefreeposter/(:num)';
$route['delete-freeposter/(:num)'] = 'AdminController/delete_freeposter/(:num)';

$route['variant-list'] = 'AdminController/variant_list';
$route['add-variant'] = 'AdminController/add_variant';
$route['insert-variant'] = 'AdminController/insert_variant';
$route['edit-variant/(:num)'] = 'AdminController/edit_variant/(:num)';
$route['update-variant'] = 'AdminController/update_variant';
$route['delete-variant/(:num)'] = 'AdminController/delete_variant/(:num)';


$route['product-list'] = 'AdminController/product_list';
$route['add-product'] = 'AdminController/add_product';
$route['insert-product'] = 'AdminController/insert_product';
$route['edit-product/(:num)'] = 'AdminController/edit_product/(:num)';
$route['update-product'] = 'AdminController/update_product';

$route['delete-attr/(:num)/(:num)'] = 'AdminController/delete_attr/(:num)/(:num)';
$route['delete-product/(:num)'] = 'AdminController/delete_product/(:num)';



//slider 

$route['slider_list'] = 'AdminController/slider_list';
$route['add-slider'] = 'AdminController/add_slider';
$route['insert-slider'] = 'AdminController/insert_slider';
$route['edit-slider/(:num)'] = 'AdminController/edit_slider/(:num)';
$route['update-slider/(:num)'] = 'AdminController/update_slider/(:num)';
$route['delete-slider/(:num)'] = 'AdminController/delete_slider/(:num)';

//doctor notes 
$route['prescription_orders'] = 'AdminController/prescription_orders';
$route['prescription_orders/(:any)'] = 'AdminController/prescription_orders/(:any)';
$route['delete-doctor/(:num)'] = 'AdminController/delete_doctor/(:num)';

//order
$route['orders-list'] = 'AdminController/orders_list';
$route['orders-list/(:any)'] = 'AdminController/orders_list/(:any)';

// userlist

$route['users-list'] = 'AdminController/users_list';
$route['edit-users/(:num)'] = 'AdminController/edit_employee/(:num)';
$route['update-employee'] = 'AdminController/update_employee';
$route['delete-users/(:num)'] = 'AdminController/delete_employee/(:num)';

$route['product_upload'] = 'Import';
//orderdetails

$route['orderdetails/(:num)'] = 'AdminController/orderdetails/(:num)';


// term & conditions

$route['term-conditions'] = 'AdminController/term_conditions';
$route['insert-term'] = 'AdminController/insert_term';

// cancle policy
$route['cancel-policy'] = 'AdminController/cancel_policy';
$route['insert-policy'] = 'AdminController/insert_policy';

// reports

$route['reports'] = 'AdminController/reports';
$route['customerreports'] = 'AdminController/customerreports';
$route['productreports'] = 'AdminController/productreports';
$route['feedback'] = 'AdminController/feedback';
$route['delete-feedback/(:num)'] = 'AdminController/delete_feedback/(:num)';
















//








