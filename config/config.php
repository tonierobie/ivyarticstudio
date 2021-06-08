<?php

  define('DEBUG', true); // set debug to false for production

  // this should be set to false for security reasons. If you need to run migrations from the browser you can set this to true, then run migrations, then set it back to false.
  define('RUN_MIGRATIONS_FROM_BROWSER', false);

  define('DB_NAME', 'ivyartic_studio'); // database name
  define('DB_USER', 'ivyartic_rootat1'); // database user
  define('DB_PASSWORD', 'Nakupata2019'); // database password
  define('DB_HOST', '127.0.0.1'); // database host *** use IP address to avoid DNS lookup

  define('DEFAULT_CONTROLLER', 'Home'); // default controller if there isn't one defined in the url
  define('DEFAULT_LAYOUT', 'default'); // if no layout is set in the controller use this layout.

  define('KENYA_SHILLING_EXCHANGE_RATE',103.1);
  define('SITE_CHARGES',0.08);

  define('PROOT', '/'); // set this to '/' for a live server.
  define('VERSION','0.30'); // release version this can be used to display version or version assets like css and js files useful for fighting cached browser files

  define('SITE_TITLE', 'IvyArtic Studio'); // This will be used if no site title is set
  define('MENU_BRAND', 'IvyArtic Studio'); //This is the Brand text in the menu
  define('MENU_LOGO', 'img/logo_main.jpeg'); //This is the Brand text in the menu

  define('CURRENT_USER_SESSION_NAME', 'foi89ohf455gOknVeY6Qp1'); //session name for logged in user
  define('REMEMBER_ME_COOKIE_NAME', 'lophgt567jjbzxSeL5M9g1x'); // cookie name for logged in user remember me
  define('REMEMBER_ME_COOKIE_EXPIRY', 2592000); // time in seconds for remember me cookie to live (30 days)

  define('CART_COOKIE_NAME','hkjhfkjfh78888P9I39iihi5bFC');
  define('CART_COOKIE_EXPIRY',1209600);

  define('THANKYOU_COOKIE_NAME','ertyu768usP9I3dtyty657657');
  define('THANKYOU_COOKIE_EXPIRY',60);

  define('ACCESS_RESTRICTED', 'Restricted'); //controller name for the restricted redirect

  ################# Gateway Settings #######################################
  //define('GATEWAY','braintree'); // could use braintree
  //define('GATEWAY','stripe'); // could use stripe
  
  define('GATEWAY','pesapal'); // could use pesapal
  define('CHECKOUT','Pesapal, Mpesa, Airtel, Mobile Banking, Mastercard Or Visa'); // could use pesapal


  //Stripe details
  define('STRIPE_PUBLIC','pk_test_M0wI3vDLVwMpYQV3kDsj4HJI');
  define('STRIPE_PRIVATE','sk_test_caaDpUplR45uLpYijvOHW8Wm');
  // Braintree details
  define('BRAINTREE_MERCHANT_ID', 'j8zyqwv8yz9stwwx');
  define('BRAINTREE_ENV', 'sandbox');
  define('BRAINTREE_PUBLIC', '6brmg6rfcy28j26d');
  define('BRAINTREE_PRIVATE', 'dbaead385c88dad288ea34951e8c9091');

  //Mpesa details
  define('CONSUMER_KEY','xxxxxxxxxxxxxxxxxxxxxxxxxx');
  define('CONSUMER_SECRET','xxxxxxxxxxxxxxxxxxxxxxxxx');

  //PepaPal
  define('PESAPAL_ENV', 'sandbox');
  define('PESAPAL_CONSUMER_KEY','XS60XmFS1XmVJAUyCiYls36poR4lZUtS');
  define('PESAPAL_CONSUMER_SECRET','d2NgfNx/Qebw48whYGJdBUfWmHE=');
