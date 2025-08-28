<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::get('/city/{cityId}/available-shipping-slots', [CityShippingScheduleController::class, 'getAvailableSlots'])->name('api-city-available-slots');

    Route::get('logout', 'Api\UserController@logout')->middleware('auth:api');
    Route::get('details', 'Api\UserController@user')->middleware('auth:api');
    Route::post('login', 'Api\UserController@login');
    Route::post('phonelogin', 'Api\UserController@phonelogin');
    Route::post('signup', 'Api\UserController@signup');
    Route::post('phoneregister', 'Api\UserController@phoneregister');
    Route::post('phoneverify', 'Api\UserController@phoneverify');
    
    Route::post('forgetpass', 'Api\UserController@forgetpass'); //forget password and send code to phone
    Route::post('phonepass', 'Api\UserController@phonepass'); // for verify phone code when sent
    Route::post('forgetpasses', 'Api\UserController@forgetpasses')->middleware('auth:api'); // change password after code verify by phone
    
    
    Route::POST('forgot', 'Api\UserController@forgot'); //forget password and send password to email
    
    Route::post('changepass', 'Api\UserController@changepass')->middleware('auth:api'); 
    
  //  Route::post('social_auth', 'Api\SocialAuthController@socialAuth');
    
    Route::get('/login-facebook', 'Api\SocialAuthController@AuthenticateFacebook');
    Route::get('/login-google', 'Api\SocialAuthController@googleAuthenticate');
     Route::post('/login-apple', 'Api\SocialAuthController@appleAuthenticate');
    
         Route::get('auth/{provider}', 'Api\SocialController@redirectToProvider')->name('social-provider');
  Route::get('auth/{provider}/callback', 'Api\SocialController@handleProviderCallback');
  
    // product api 
    Route::get('product/{id}', 'Api\FrontendController@Product');
      Route::get('colors/{id}/{size}', 'Api\FrontendController@colors');
      Route::get('sizes/{id}/{color}', 'Api\FrontendController@sizes');
    Route::get('allproducts', 'Api\FrontendController@allProducts');
    Route::get('ProductByBrand/{id}', 'Api\FrontendController@ProductByBrand');
    Route::get('ProductByCategory/{id}', 'Api\FrontendController@ProductByCategory');
    Route::get('ProductBySubcategory/{id}', 'Api\FrontendController@ProductBySubcategory');
    Route::get('ProductByChildcategory/{id}', 'Api\FrontendController@ProductByChildcategory');

    Route::get('ProductHot', 'Api\FrontendController@ProductHot')->middleware('auth:api');
    Route::get('ProductBest', 'Api\FrontendController@ProductBest')->middleware('auth:api');
    Route::get('ProductTop', 'Api\FrontendController@ProductTop')->middleware('auth:api');
    Route::get('LatestProduct', 'Api\FrontendController@LatestProduct');
    Route::get('TrendingProduct', 'Api\FrontendController@TrendingProduct');
    Route::get('SaleProduct', 'Api\FrontendController@SaleProduct')->middleware('auth:api');


 



    Route::get('ProductSearch/{slug?}', 'Api\FrontendController@ProductSearch');

    Route::get('ProductReview', 'Api\FrontendController@ProductReveiw')->middleware('auth:api');
    Route::post('addProductReveiw', 'Api\FrontendController@addProductReveiw')->middleware('auth:api');

    Route::get('auth', 'Api\FrontendController@auth');
    // filter 
    
    Route::get('category/{category?}/{subcategory?}/{childcategory?}','Api\FrontendController@categoryy');
    Route::get('categoryy','Api\FrontendController@category');
    Route::get('brandss','Api\FrontendController@brandss')->middleware('auth:api');
    Route::get('policy','Api\FrontendController@policy');
    
    
    Route::get('subcategory/{id}','Api\FrontendController@subcategory');
    Route::get('childcategory/{id}','Api\FrontendController@childcategory');
    
    // slider Api 
    
    Route::get('slider', 'Api\FrontendController@Slider');
    
    
    Route::post('autosearch', 'Api\FrontendController@autosearch');
    
    // order api 
    
    
    Route::get('orders', 'Api\OrderController@orders')->middleware('auth:api');
    Route::get('subscribes', 'Api\OrderController@subscribes')->middleware('auth:api');
    Route::get('subscribe', 'Api\OrderController@subscribe')->middleware('auth:api');
    Route::get('ordertrack', 'Api\OrderController@ordertrack')->middleware('auth:api');
    Route::get('trackload/{id}', 'Api\OrderController@trackload')->middleware('auth:api');
    Route::get('order/{id}', 'Api\OrderController@order')->middleware('auth:api');
    Route::post('makeorder', 'Api\OrderController@makeorder')->middleware('auth:api');
    Route::post('test', 'Api\OrderController@test')->middleware('auth:api');
    
    Route::post('addtocart', 'Api\CartController@addtocart')->middleware('auth:api');
    Route::get('removecart/{id}', 'Api\CartController@removecart')->middleware('auth:api');
    Route::get('showcart', 'Api\CartController@showcart')->middleware('auth:api');

    Route::get('shipments', 'Api\OrderController@shipment')->middleware('auth:api');
    Route::get('shipment', 'Api\OrderController@shipments')->middleware('auth:api');
    Route::get('payment/{id}', 'Api\OrderController@payment')->middleware('auth:api');
    // coupon api 
    
    Route::get('pointscoupon/{id}', 'Api\CouponController@pointscoupon')->middleware('auth:api');
    Route::get('promocodes', 'Api\CouponController@promocodes')->middleware('auth:api');
    Route::post('couponcheck', 'Api\CouponController@couponcheck')->middleware('auth:api');
    Route::get('forget', 'Api\CouponController@forget')->middleware('auth:api');
    Route::get('refelar', 'Api\CouponController@refelar')->middleware('auth:api');
    Route::get('points', 'Api\CouponController@points')->middleware('auth:api');
    Route::get('coupondetails/{id}', 'Api\CouponController@coupondetails')->middleware('auth:api');

    
    // compare api 
    
  Route::get('/item/compare/view', 'Api\CompareController@compare');
  Route::get('/item/compare/add/{id}', 'Api\CompareController@addcompare');
  Route::get('/item/compare/remove/{id}', 'Api\CompareController@removecompare');

    // vendor api ProductSearch
  Route::get('/Sellerprofile/{id}', 'Api\VendorController@show')->middleware('auth:api');
  
  // payment information api
  Route::get('/paymentinfo', 'Api\FrontendController@paymentsinfo')->middleware('auth:api');
  
  // user profile 
    Route::get('/profile', 'Api\UserController@profile')->middleware('auth:api');
    Route::post('/profile/update', 'Api\UserController@profileupdate')->middleware('auth:api');
    Route::post('/profile/updatephoto', 'Api\UserController@updatephoto')->middleware('auth:api');

    
  // faq api 
    Route::get('/faq','Api\FrontendController@faq');
    
  // CART api
  Route::get('/carts/','Api\CartController@cart');
  Route::get('/addcart/{id}','Api\CartController@addcart');
  Route::get('/addnumcart','Api\CartController@addnumcart');
  Route::get('/addbyone','Api\CartController@addbyone');
  Route::get('/reducebyone','Api\CartController@reducebyone');
  Route::get('/upcolor','Api\CartController@upcolor');
  Route::get('/removecart/{id}','Api\CartController@removecart');
  Route::get('/carts/coupon','Api\CartController@coupon');
  Route::get('/carts/coupon/check','Api\CartController@couponcheck');
  // CART SECTION ENDS
  
  
  
  //offer page
  Route::get('/offers','Api\FrontendController@offers');
  Route::get('/offerpage/{id}','Api\FrontendController@offerpage');
  
  // wishlist api 
    
  
  Route::get('/wishlists','Api\WishlistController@wishlists')->middleware('auth:api');
  Route::get('/wishlist/add/{id}','Api\WishlistController@addwish')->middleware('auth:api');
  Route::get('/wishlist/remove/{id}','Api\WishlistController@removewish')->middleware('auth:api');
  // User Wishlist Ends
  
  
  //brands api 
  Route::get('brands', 'Api\FrontendController@brands');
  
  // filter api 
  
  Route::post('filter', 'Api\FrontendController@filter');
  Route::get('atrabuites/{cat}', 'Api\FrontendController@atrabuites')->middleware('auth:api');
  Route::post('atrabuitescats', 'Api\FrontendController@atrabuitescats')->middleware('auth:api');
  
  Route::get('filterColor/{color}', 'Api\FrontendController@filterColor');
  
  Route::get('filterBrand/{brand}', 'Api\FrontendController@filterBrand');

  
  // wallet api 
   Route::get('/wallet', 'Api\UserController@wallet')->middleware('auth:api');
   Route::get('/usewallet', 'Api\UserController@usewallet')->middleware('auth:api');
   
   
   Route::get('/notifications', 'Api\FrontendController@notifications')->middleware('auth:api');
   Route::get('/notificationsid/{id}', 'Api\FrontendController@notificationsid')->middleware('auth:api');

    // user adress api 
    
  Route::get('useraddress/{userid}', 'Api\FrontendController@Useraddress');
  Route::post('AddUseraddress', 'Api\FrontendController@AddUseraddress')->middleware('auth:api');
  Route::post('UpdateUseraddress', 'Api\FrontendController@UpdateUseraddress')->middleware('auth:api');
  Route::get('DeleteUseraddress/{id}', 'Api\FrontendController@DeleteUseraddress');


      // product comment api 
  Route::post('comment', 'Api\FrontendController@comment')->middleware('auth:api');
  Route::post('commentedit', 'Api\FrontendController@commentedit')->middleware('auth:api');
  Route::get('commentdelete/{id}', 'Api\FrontendController@commentdelete')->middleware('auth:api');
  
  
  // testimonial api 
  
   Route::get('/testimonial', 'Api\FrontendController@testimonial');
   Route::get('/Country', 'Api\FrontendController@Country');
   Route::get('/city/{id}', 'Api\FrontendController@city');

    //currencies api 
   Route::get('/currencies', 'Api\FrontendController@currencies');
   Route::get('/setcurrencies/{id}', 'Api\FrontendController@setcurrencies')->middleware('auth:api');

    // sub category 
     Route::post('subcategory', 'Api\FrontendController@getsubs');
     
     
     // sub product by  subcategory 
     Route::post('getProductBysubCategory', 'Api\FrontendController@getProductBysubCategory');

     
    //  category
  
     Route::post('getcategory', 'Api\FrontendController@getcategory'); 
    
    
    // ads api 
    
   Route::get('/ads', 'Api\FrontendController@ads');
   Route::get('/banners', 'Api\FrontendController@banners');
   
   Route::get('/banner1', 'Api\FrontendController@banner1');
   Route::get('/banner2', 'Api\FrontendController@banner2');
   Route::get('/banner3', 'Api\FrontendController@banner3');
   Route::get('/banner4', 'Api\FrontendController@banner4');
   Route::get('/banner5', 'Api\FrontendController@banner5');
   
   
    // favorit api 
    
//   Route::post('/favorite', 'Api\FrontendController@addfavorite')->middleware('auth:api');

   Route::get('/favorite/{id}', 'Api\FrontendController@addfavorite')->middleware('auth:api');
   
   
    
  Route::get('/favoriteProduct', 'Api\FrontendController@myFavoriteProduct')->middleware('auth:api'); 


    // ratings api  
      Route::get('/ratingByProduct/{id}', 'Api\FrontendController@ratingByProduct');
      Route::post('/addRating', 'Api\FrontendController@addRating')->middleware('auth:api');
      Route::get('/allrate', 'Api\FrontendController@allrate');
      
      Route::get('/colikes/{rate_id}', 'Api\FrontendController@colikes')->middleware('auth:api');
      Route::get('/prolikes/{pro_id}', 'Api\FrontendController@prolikes')->middleware('auth:api');
      Route::get('/allcomment', 'Api\FrontendController@allcomment')->middleware('auth:api');
      Route::post('/addcomment/{pro_id}', 'Api\FrontendController@addcomment')->middleware('auth:api');
      
      
      Route::post('/filter-product', 'Api\FrontendController@filterproduct')->middleware('auth:api');

    

  Route::get('/GetAllCategoryAndSub', 'Api\FrontendController@GetAllCategoryAndSub'); 
  
  //pages
   Route::get('/pages','Api\FrontendController@pages');
    Route::get('/contact','Api\FrontendController@contact');
     Route::post('/contactsave','Api\FrontendController@contactsave');
        Route::post('/contactemail','Api\FrontendController@contactemail');
     
   //blogs
   Route::get('/blogcategories','Api\FrontendController@blogcategories');
   Route::get('/blogs/{id}','Api\FrontendController@blogs');
   Route::get('/blog/{id}','Api\FrontendController@blog');
   
   
     /*Paginate*/

   Route::get('allproductsp', 'Api\FrontendController@allProductsp');
    Route::get('ProductByBrandp/{id}', 'Api\FrontendController@ProductByBrandp');
    Route::get('ProductByCategoryp/{id}', 'Api\FrontendController@ProductByCategoryp');
    Route::get('ProductBySubcategoryp/{id}', 'Api\FrontendController@ProductBySubcategoryp');
    Route::get('ProductByChildcategoryp/{id}', 'Api\FrontendController@ProductByChildcategoryp');

    Route::get('ProductHotp', 'Api\FrontendController@ProductHotp')->middleware('auth:api');
    Route::get('ProductBestp', 'Api\FrontendController@ProductBestp')->middleware('auth:api');
    Route::get('ProductTopp', 'Api\FrontendController@ProductTopp')->middleware('auth:api');
    Route::get('LatestProductp', 'Api\FrontendController@LatestProductp');
    Route::get('TrendingProductp', 'Api\FrontendController@TrendingProductp');
    Route::get('SaleProductp', 'Api\FrontendController@SaleProductp')->middleware('auth:api');
    
    Route::post('getProductBysubCategoryp', 'Api\FrontendController@getProductBysubCategoryp');
     Route::get('/favoriteProductp', 'Api\FrontendController@myFavoriteProductp')->middleware('auth:api'); 

 Route::get('ProductSearchp/{slug?}', 'Api\FrontendController@ProductSearchp');
 Route::get('/offerpagep/{id}','Api\FrontendController@offerpagep');
 
   Route::post('filterp', 'Api\FrontendController@filterp');
       Route::get('ordersp', 'Api\OrderController@ordersp')->middleware('auth:api');

        /* End Paginate*/






  
 // erp connection
 
   Route::post('/connection','Api\ErpController@connection');
   Route::post('/erpcategory','Api\ErpController@erpcreatecategory');
   Route::post('/erpcategory-update','Api\ErpController@erpupdatecategory');
   
     Route::post('/erp-brand-create','Api\ErpController@erpcreatebrand');
   Route::post('/erp-brand-update','Api\ErpController@erpupdatebrand');
   
    Route::post('/erp-product-create','Api\ErpController@erpcreateproduct');
    
        Route::post('/erp-product-edit','Api\ErpController@erpupdateproduct');
    
    
    Route::post('/erp-delete-media','Api\ErpController@erpdeletemedia');
    
    Route::post('/erp-open-stock','Api\ErpController@erpopenstock');
    
    Route::post('/erp-adjustQuantity','Api\ErpController@adjustQuantity');
    
    Route::post('/erp-decreaseProductQuantity','Api\ErpController@decreaseProductQuantity');
     Route::post('/erp-ProductPrice','Api\ErpController@ProductPrice');
   