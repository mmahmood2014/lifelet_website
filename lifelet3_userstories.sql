-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 08, 2019 at 09:22 AM
-- Server version: 5.7.23
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lifelet3_userstories`
--

-- --------------------------------------------------------

--
-- Table structure for table `bracelet_bundle_text`
--

DROP TABLE IF EXISTS `bracelet_bundle_text`;
CREATE TABLE IF NOT EXISTS `bracelet_bundle_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warning_exactly` text NOT NULL,
  `warning_review` text NOT NULL,
  `above_special_inst` text NOT NULL,
  `warning_more_items` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bracelet_bundle_text`
--

INSERT INTO `bracelet_bundle_text` (`id`, `warning_exactly`, `warning_review`, `above_special_inst`, `warning_more_items`) VALUES
(1, '<strong>Warning!</strong> You have to add exactly {nth} symbols for your bracelet', '<p><strong>Warning!</strong><br />Once you add your bracelet to the cart, you will not be able to change your symbol selections without starting over. Please review your selections carefully before continuing.</p>', '<p><strong>My message</strong> above special instructions goes here.</p>', 'Warning! You must remove symbols or select a higher number of symbols on the previous page in order to complete your bracelet.');

-- --------------------------------------------------------

--
-- Table structure for table `bracelet_text`
--

DROP TABLE IF EXISTS `bracelet_text`;
CREATE TABLE IF NOT EXISTS `bracelet_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `top` text NOT NULL,
  `exp_16` text NOT NULL,
  `exp_8` text NOT NULL,
  `exp_4` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bracelet_text`
--

INSERT INTO `bracelet_text` (`id`, `top`, `exp_16`, `exp_8`, `exp_4`) VALUES
(1, '<p style=\"box-sizing: border-box; margin: 0px 0px 25px; padding: 0px; color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\">Welcome to creating a LIFElet bracelet!</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 25px; padding: 0px; color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\">You will have a choice of selecting 16, 8 or 4 Life Experience symbols for the bracelet. If you are selecting 8 or 4 Life Experience symbols, you will also need to select the material for the blank beads on the bracelet. Here is an idea of the pricing for the full bracelet with the current material options available:</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 25px; padding: 0px; color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\">- Black Anodized Aluminum (all beads the same material) - $112.00 ($7.00/bead)<br style=\"box-sizing: border-box; margin: 0px; padding: 0px;\" />- 316 Stainless Steel (all beads the same material) - $128.00 ($8.00/bead)</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 25px; padding: 0px; color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\"><strong style=\"box-sizing: border-box; margin: 0px; padding: 0px;\">Note: Blank beads are at the same cost as beads marked with Life Experience symbols.</strong></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 25px; padding: 0px; color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\"><strong style=\"box-sizing: border-box; margin: 0px; padding: 0px;\">Choose the total number of Life Experience Symbols you would like on the bracelet:</strong></p>', '<span style=\"color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\">Continue to the next page where you will select 16 Life Experience symbols and the material you would like each symbol to be marked on.</span>', '<span style=\"color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\">Select the material for the 8 blank beads on the bracelet.</span><br style=\"box-sizing: border-box; margin: 0px; padding: 0px; color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\" /><span style=\"color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\">Once selected, continue to next page where you will select 8 Life Experience symbols and the material you would like each symbol to be marked on.</span>', '<span style=\"color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\">Select the material for the 12 blank beads on the bracelet.</span><br style=\"box-sizing: border-box; margin: 0px; padding: 0px; color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\" /><span style=\"color: #333333; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;\">Once selected, continue to next page where you will select 4 Life Experience symbols and the material you would like each symbol to be marked on.</span>');

-- --------------------------------------------------------

--
-- Table structure for table `html`
--

DROP TABLE IF EXISTS `html`;
CREATE TABLE IF NOT EXISTS `html` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `top` text NOT NULL,
  `bottom` text NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `html`
--

INSERT INTO `html` (`id`, `top`, `bottom`, `date_time`) VALUES
(1, '<!doctype html> <!--[if lt IE 7]><html class=\"no-js lt-ie9 lt-ie8 lt-ie7\" lang=\"en\"> <![endif]--> <!--[if IE 7]><html class=\"no-js lt-ie9 lt-ie8\" lang=\"en\"> <![endif]--> <!--[if IE 8]><html class=\"no-js lt-ie9\" lang=\"en\"> <![endif]--> <!--[if IE 9 ]><html class=\"ie9 no-js\"> <![endif]--> <!--[if (gt IE 9)|!(IE)]><!--> <html class=\"no-js\"> <!--<![endif]--> <head>    <!-- Basic page needs ================================================== -->   <meta charset=\"utf-8\">   <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">         <link rel=\"shortcut icon\" href=\"//cdn.shopify.com/s/files/1/0046/9473/6965/files/Favicon_-_png_32x32.png?v=1540098722\" type=\"image/png\" />       <!-- Title and description ================================================== -->   <title>   Bracelet App   </title>       <meta name=\"description\" content=\"Lifelet is a luxury bracelet company in Canada, looking to make an impact on the world! We strive to create exquisite bracelets that hold a powerful meaning toÂ each owner and we create a space for them to share their life experiences in effort to facilitate a story telling community.Â  Lifelet was founded in 2018 and is\">       <!-- Helpers ================================================== -->   <!-- /snippets/social-meta-tags.liquid -->     <meta property=\"og:site_name\" content=\"LIFElet\"> <meta property=\"og:url\" content=\"https://lifelet.co/pages/about\"> <meta property=\"og:title\" content=\"About\"> <meta property=\"og:type\" content=\"website\"> <meta property=\"og:description\" content=\"Lifelet is a luxury bracelet company in Canada, looking to make an impact on the world! We strive to create exquisite bracelets that hold a powerful meaning toÂ each owner and we create a space for them to share their life experiences in effort to facilitate a story telling community.Â  Lifelet was founded in 2018 and is\">      <meta name=\"twitter:card\" content=\"summary_large_image\"> <meta name=\"twitter:title\" content=\"About\"> <meta name=\"twitter:description\" content=\"Lifelet is a luxury bracelet company in Canada, looking to make an impact on the world! We strive to create exquisite bracelets that hold a powerful meaning toÂ each owner and we create a space for them to share their life experiences in effort to facilitate a story telling community.Â  Lifelet was founded in 2018 and is\">    <link rel=\"canonical\" href=\"https://lifelet.co/pages/about\">   <meta name=\"viewport\" content=\"width=device-width,initial-scale=1,shrink-to-fit=no\">   <meta name=\"theme-color\" content=\"#286446\">    <!-- CSS ================================================== -->   <link href=\"//cdn.shopify.com/s/files/1/0046/9473/6965/t/2/assets/timber.scss.css?4128897473268809957\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />   <link href=\"//cdn.shopify.com/s/files/1/0046/9473/6965/t/2/assets/theme.scss.css?4128897473268809957\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />    <!-- Sections ================================================== -->   <script>     window.theme = window.theme || {};     theme.strings = {       zoomClose: \"Close (Esc)\",       zoomPrev: \"Previous (Left arrow key)\",       zoomNext: \"Next (Right arrow key)\",       moneyFormat: \"${{amount}}\",       addressError: \"Error looking up that address\",       addressNoResults: \"No results for that address\",       addressQueryLimit: \"You have exceeded the Google API usage limit. Consider upgrading to a \\u003ca href=\\\"https:\\/\\/developers.google.com\\/maps\\/premium\\/usage-limits\\\"\\u003ePremium Plan\\u003c\\/a\\u003e.\",       authError: \"There was a problem authenticating your Google Maps account.\",       cartEmpty: \"Your cart is currently empty.\",       cartCookie: \"Enable cookies to use the shopping cart\",       cartSavings: \"I18n Error: Missing interpolation value \\\"savings\\\" for \\\"You\'re saving {{ savings }}\\\"\"     };     theme.settings = {       cartType: \"drawer\",       gridType: \"collage\"     };   </script>    <script src=\"//cdn.shopify.com/s/files/1/0046/9473/6965/t/2/assets/jquery-2.2.3.min.js?4128897473268809957\" type=\"text/javascript\"></script>    <!--[if (gt IE 9)|!(IE)]><!--><script src=\"//cdn.shopify.com/s/files/1/0046/9473/6965/t/2/assets/lazysizes.min.js?4128897473268809957\" async=\"async\"></script><!--<![endif]-->   <!--[if lte IE 9]><script src=\"//cdn.shopify.com/s/files/1/0046/9473/6965/t/2/assets/lazysizes.min.js?4128897473268809957\"></script><![endif]-->    <!--[if (gt IE 9)|!(IE)]><!--><script src=\"//cdn.shopify.com/s/files/1/0046/9473/6965/t/2/assets/theme.js?4128897473268809957\" defer=\"defer\"></script><!--<![endif]-->   <!--[if lte IE 9]><script src=\"//cdn.shopify.com/s/files/1/0046/9473/6965/t/2/assets/theme.js?4128897473268809957\"></script><![endif]-->    <!-- Header hook for plugins ================================================== -->   <meta id=\"shopify-digital-wallet\" name=\"shopify-digital-wallet\" content=\"/4694736965/digital_wallets/dialog\"> <meta name=\"shopify-checkout-api-token\" content=\"e7760766203883b5511d989bee7b7783\"> <meta id=\"in-context-paypal-metadata\" data-shop-id=\"4694736965\" data-environment=\"production\" data-locale=\"en_US\" data-paypal-v4=\"true\" data-currency=\"CAD\"> <style media=\"all\">.additional-checkout-button{border:0 !important;border-radius:5px !important;display:inline-block;margin:0 0 10px;padding:0 24px !important;max-width:100%;min-width:150px !important;line-height:44px !important;text-align:center !important}.additional-checkout-button+.additional-checkout-button{margin-left:10px}.additional-checkout-button:last-child{margin-bottom:0}.additional-checkout-button span{font-size:14px !important}.additional-checkout-button img{display:inline-block !important;height:1.3em !important;margin:0 !important;vertical-align:middle !important;width:auto !important}@media (max-width: 500px){.additional-checkout-button{display:block;margin-left:0 !important;padding:0 10px !important;width:100%}}.additional-checkout-button--apple-pay{background-color:#000 !important;color:#fff !important;display:none;font-family:-apple-system, Helvetica Neue, sans-serif !important;min-width:150px !important;white-space:nowrap !important}.additional-checkout-button--apple-pay:hover,.additional-checkout-button--apple-pay:active,.additional-checkout-button--apple-pay:visited{color:#fff !important;text-decoration:none !important}.additional-checkout-button--apple-pay .additional-checkout-button__logo{background:-webkit-named-image(apple-pay-logo-white) center center no-repeat !important;background-size:auto 100% !important;display:inline-block !important;vertical-align:middle !important;width:3em !important;height:1.3em !important}@media (max-width: 500px){.additional-checkout-button--apple-pay{display:none}}.additional-checkout-button--google-pay{line-height:0 !important;padding:0 !important;border-radius:unset !important;width:80px !important}@media (max-width: 500px){.additional-checkout-button--google-pay{width:100% !important}}.gpay-iframe{height:44px !important;width:100%  !important;cursor:pointer;vertical-align:middle !important}.additional-checkout-button--paypal-express{background-color:#ffc439 !important}.additional-checkout-button--paypal,.additional-checkout-button--venmo{vertical-align:top;line-height:0 !important;padding:0 !important}.additional-checkout-button--amazon{background-color:#fad676 !important;position:relative !important}.additional-checkout-button--amazon .additional-checkout-button__logo{-webkit-transform:translateY(4px) !important;transform:translateY(4px) !important}.additional-checkout-button--amazon .alt-payment-list-amazon-button-image{max-height:none !important;opacity:0 !important;position:absolute !important;top:0 !important;left:0 !important;width:100% !important;height:100% !important}.additional-checkout-button-visually-hidden{border:0 !important;clip:rect(0, 0, 0, 0) !important;clip:rect(0 0 0 0) !important;width:1px !important;height:1px !important;margin:-2px !important;overflow:hidden !important;padding:0 !important;position:absolute !important} </style> <style>.shopify-payment-button__button--hidden {   visibility: hidden; }  .shopify-payment-button__button {   border-radius: 4px;   border: none;   box-shadow: 0 0 0 0 transparent;   color: white;   cursor: pointer;   display: block;   font-size: 1em;   font-weight: 500;   line-height: 1;   text-align: center;   width: 100%;   transition: background 0.2s ease-in-out; }  .shopify-payment-button__button[disabled] {   opacity: 0.6;   cursor: default; }  .shopify-payment-button__button--unbranded {   background-color: #1990c6;   padding: 1em 2em; }  .shopify-payment-button__button--unbranded:hover:not([disabled]) {   background-color: #136f99; }  .shopify-payment-button__more-options {   background: transparent;   border: 0 none;   cursor: pointer;   display: block;   font-size: 1em;   margin-top: 1em;   text-align: center;   width: 100%; }  .shopify-payment-button__more-options:hover:not([disabled]) {   text-decoration: underline; }  .shopify-payment-button__more-options[disabled] {   opacity: 0.6;   cursor: default; }  .shopify-payment-button__button--branded {   display: flex;   flex-direction: column;   min-height: 44px;   position: relative;   z-index: 1; }  .shopify-payment-button__button--branded .shopify-cleanslate {   flex: 1 !important;   display: flex !important;   flex-direction: column !important; } </style> <script id=\"shopify-features\" type=\"application/json\">{\"accessToken\":\"e7760766203883b5511d989bee7b7783\",\"betas\":[],\"domain\":\"lifelet.co\",\"shopId\":4694736965,\"smart_payment_buttons_url\":\"https:\\/\\/cdn.shopifycloud.com\\/payment-sheet\\/assets\\/latest\\/spb.js\"}</script> <script>var Shopify = Shopify || {}; Shopify.shop = \"lifelet.myshopify.com\"; Shopify.currency = {\"active\":\"CAD\"}; Shopify.theme = {\"name\":\"Brooklyn\",\"id\":40686354501,\"theme_store_id\":730,\"role\":\"main\"}; Shopify.theme.handle = \"null\"; Shopify.theme.style = {\"id\":null,\"handle\":null};</script> <script id=\"__st\">var __st={\"a\":4694736965,\"offset\":-25200,\"reqid\":\"0cf34460-ed04-4c59-8c32-d3b5ceb2d6d1\",\"pageurl\":\"lifelet.co\\/pages\\/about\",\"s\":\"pages-23005986885\",\"u\":\"ac61992cf856\",\"p\":\"page\",\"rtyp\":\"page\",\"rid\":23005986885};</script> <script>window.ShopifyPaypalV4VisibilityTracking = true;</script> <script>window.Shopify = window.Shopify || {}; window.Shopify.Checkout = window.Shopify.Checkout || {}; window.Shopify.Checkout.apiHost = \"lifelet.myshopify.com\";</script> <script>window.ShopifyAnalytics = window.ShopifyAnalytics || {}; window.ShopifyAnalytics.meta = window.ShopifyAnalytics.meta || {}; window.ShopifyAnalytics.meta.currency = \'CAD\'; var meta = {\"page\":{\"pageType\":\"page\",\"resourceType\":\"page\",\"resourceId\":23005986885}}; for (var attr in meta) {   window.ShopifyAnalytics.meta[attr] = meta[attr]; }</script> <script>window.ShopifyAnalytics.merchantGoogleAnalytics = function() {    }; </script> <script class=\"analytics\">(function () {   var customDocumentWrite = function(content) {     var jquery = null;      if (window.jQuery) {       jquery = window.jQuery;     } else if (window.Checkout && window.Checkout.$) {       jquery = window.Checkout.$;     }      if (jquery) {       jquery(\'body\').append(content);     }   };    var trekkie = window.ShopifyAnalytics.lib = window.trekkie = window.trekkie || [];   if (trekkie.integrations) {     return;   }   trekkie.methods = [     \'identify\',     \'page\',     \'ready\',     \'track\',     \'trackForm\',     \'trackLink\'   ];   trekkie.factory = function(method) {     return function() {       var args = Array.prototype.slice.call(arguments);       args.unshift(method);       trekkie.push(args);       return trekkie;     };   };   for (var i = 0; i < trekkie.methods.length; i++) {     var key = trekkie.methods[i];     trekkie[key] = trekkie.factory(key);   }   trekkie.load = function(config) {     trekkie.config = config;     var script = document.createElement(\'script\');     script.type = \'text/javascript\';     script.onerror = function(e) {       (new Image()).src = \'//v.shopify.com/internal_errors/track?error=trekkie_load\';     };     script.async = true;     script.src = \'https://cdn.shopify.com/s/javascripts/tricorder/trekkie.storefront.min.js?v=2017.09.05.1\';     var first = document.getElementsByTagName(\'script\')[0];     first.parentNode.insertBefore(script, first);   };   trekkie.load(     {\"Trekkie\":{\"appName\":\"storefront\",\"development\":false,\"defaultAttributes\":{\"shopId\":4694736965,\"isMerchantRequest\":null,\"themeId\":40686354501,\"themeCityHash\":13184386525925582941}},\"Performance\":{\"navigationTimingApiMeasurementsEnabled\":true,\"navigationTimingApiMeasurementsSampleRate\":1.0},\"Session Attribution\":{}}   );    var loaded = false;   trekkie.ready(function() {     if (loaded) return;     loaded = true;      window.ShopifyAnalytics.lib = window.trekkie;           var originalDocumentWrite = document.write;     document.write = customDocumentWrite;     try { window.ShopifyAnalytics.merchantGoogleAnalytics.call(this); } catch(error) {};     document.write = originalDocumentWrite;               window.ShopifyAnalytics.lib.page(           null,           {\"pageType\":\"page\",\"resourceType\":\"page\",\"resourceId\":23005986885}         );               });           var eventsListenerScript = document.createElement(\'script\');       eventsListenerScript.async = true;       eventsListenerScript.src = \"//cdn.shopify.com/s/assets/shop_events_listener-76ce6d7f3e50d4b8c05874c34d2ea1340c45e5babba61276dadcaeed488ca16a.js\";       document.getElementsByTagName(\'head\')[0].appendChild(eventsListenerScript);      })();</script> <script integrity=\"sha256-LSSd/irVbp++ejYsk3vd86UUqmyUoHsKhsADtERDioA=\" defer=\"defer\" src=\"//cdn.shopify.com/s/assets/storefront/express_buttons-2d249dfe2ad56e9fbe7a362c937bddf3a514aa6c94a07b0a86c003b444438a80.js\" crossorigin=\"anonymous\"></script> <script integrity=\"sha256-03brKlGJkFluEWuVU2bbMkmqtPMYe/svhru01Sq7y9E=\" defer=\"defer\" src=\"//cdn.shopify.com/s/assets/storefront/features-d376eb2a518990596e116b955366db3249aab4f3187bfb2f86bbb4d52abbcbd1.js\" crossorigin=\"anonymous\"></script>    <!-- /snippets/oldIE-js.liquid -->  <!--[if lt IE 9]> <script src=\"//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js\" type=\"text/javascript\"></script> <![endif]-->   <!--[if (lte IE 9) ]><script src=\"//cdn.shopify.com/s/files/1/0046/9473/6965/t/2/assets/match-media.min.js?4128897473268809957\" type=\"text/javascript\"></script><![endif]-->     <script src=\"//cdn.shopify.com/s/files/1/0046/9473/6965/t/2/assets/modernizr.min.js?4128897473268809957\" type=\"text/javascript\"></script>                     <!--Gem_Page_Header_Script-->  <!--End_Gem_Page_Header_Script--> </head><body id=\"lifelet\" class=\"template-index\"><div id=\"shopify-section-header\" class=\"shopify-section\"><style>   .site-header__logo img {     max-width: 300px;   }    @media screen and (max-width: 768px) {     .site-header__logo img {       max-width: 100%;     }   } </style>   <div data-section-id=\"header\" data-section-type=\"header-section\" data-template=\"page\">   <div id=\"NavDrawer\" class=\"drawer drawer--left\">       <div class=\"drawer__inner drawer-left__inner\">            <ul class=\"mobile-nav\">                            <li class=\"mobile-nav__item\">             <a               href=\"https://lifelet.co/pages/what-is-it\"               class=\"mobile-nav__link\"               >                 What is it?             </a>           </li>                                      <li class=\"mobile-nav__item\">             <a               href=\"https://lifelet.co/collections\"               class=\"mobile-nav__link\"               >                 Life Experiences             </a>           </li>                                      <li class=\"mobile-nav__item\">             <a               href=\"https://lifelet.co/pages/life-experience-stories\"               class=\"mobile-nav__link\"               >                 Life Stories             </a>           </li>                                     <li class=\"mobile-nav__item\">             <div class=\"mobile-nav__has-sublist\">               <a                 href=\"https://lifelet.co/\"                 class=\"mobile-nav__link\"                 id=\"Label-4\"                 >Shop</a>               <div class=\"mobile-nav__toggle\">                 <button type=\"button\" class=\"mobile-nav__toggle-btn icon-fallback-text\" aria-controls=\"Linklist-4\" aria-expanded=\"false\">                   <span class=\"icon-fallback-text mobile-nav__toggle-open\">                     <span class=\"icon icon-plus\" aria-hidden=\"true\"></span>                     <span class=\"fallback-text\">Expand submenu Shop</span>                   </span>                   <span class=\"icon-fallback-text mobile-nav__toggle-close\">                     <span class=\"icon icon-minus\" aria-hidden=\"true\"></span>                     <span class=\"fallback-text\">Collapse submenu Shop</span>                   </span>                 </button>               </div>             </div>             <ul class=\"mobile-nav__sublist\" id=\"Linklist-4\" aria-labelledby=\"Label-4\" role=\"navigation\">                                                                <li class=\"mobile-nav__item\">                   <a                     href=\"https://lifelet.co/apps/lifeletcheckout\"                     class=\"mobile-nav__link\"                     >                       Bracelets                   </a>                 </li>                                             </ul>           </li>                                 <li class=\"mobile-nav__spacer\"></li>                                   <li class=\"mobile-nav__item mobile-nav__item--secondary\">             <a href=\"https://lifelet.co/account/login\" id=\"customer_login_link\">Log In</a>           </li>           <li class=\"mobile-nav__item mobile-nav__item--secondary\">             <a href=\"https://lifelet.co/account/register\" id=\"customer_register_link\">Create Account</a>           </li>                                <li class=\"mobile-nav__item mobile-nav__item--secondary\"><a href=\"https://lifelet.co/pages/about\">About Us</a></li>                <li class=\"mobile-nav__item mobile-nav__item--secondary\"><a href=\"https://lifelet.co/pages/shipping-returns\">Shipping & Returns</a></li>                <li class=\"mobile-nav__item mobile-nav__item--secondary\"><a href=\"https://lifelet.co/pages/policies-guidelines\">Policies & Guidelines</a></li>                <li class=\"mobile-nav__item mobile-nav__item--secondary\"><a href=\"https://lifelet.co/pages/lifelet-corp-privacy-policy\">Privacy Policy</a></li>                <li class=\"mobile-nav__item mobile-nav__item--secondary\"><a href=\"https://lifelet.co/pages/contact-us\">Contact Us</a></li>            </ul>     <!-- //mobile-nav -->   </div>     </div>   <div class=\"header-container drawer__header-container\">     <div class=\"header-wrapper\">                               <header class=\"site-header\" role=\"banner\">         <div class=\"wrapper\">           <div class=\"grid--full grid--table\">             <div class=\"grid__item large--hide large--one-sixth one-quarter\">               <div class=\"site-nav--open site-nav--mobile\">                 <button type=\"button\" class=\"icon-fallback-text site-nav__link site-nav__link--burger js-drawer-open-button-left\" aria-controls=\"NavDrawer\">                   <span class=\"burger-icon burger-icon--top\"></span>                   <span class=\"burger-icon burger-icon--mid\"></span>                   <span class=\"burger-icon burger-icon--bottom\"></span>                   <span class=\"fallback-text\">Site navigation</span>                 </button>               </div>             </div>             <div class=\"grid__item large--one-third medium-down--one-half\">                                               <div class=\"h1 site-header__logo large--left\" itemscope itemtype=\"http://schema.org/Organization\">                                                                     <a href=\"https://lifelet.co/\" itemprop=\"url\" class=\"site-header__logo-link\">                      <img src=\"//cdn.shopify.com/s/files/1/0046/9473/6965/files/LIFElet_Logo_RGB_Colour_300x.png?v=1540230453\"                      srcset=\"//cdn.shopify.com/s/files/1/0046/9473/6965/files/LIFElet_Logo_RGB_Colour_300x.png?v=1540230453 1x, //cdn.shopify.com/s/files/1/0046/9473/6965/files/LIFElet_Logo_RGB_Colour_300x@2x.png?v=1540230453 2x\"                      alt=\"LIFElet\"                      itemprop=\"logo\">                   </a>                                                 </div>                            </div>             <nav class=\"grid__item large--two-thirds large--text-right medium-down--hide\" role=\"navigation\">                              <!-- begin site-nav -->               <ul class=\"site-nav\" id=\"AccessibleNav\">                                                         <li class=\"site-nav__item\">                       <a                         href=\"https://lifelet.co/pages/what-is-it\"                         class=\"site-nav__link\"                         data-meganav-type=\"child\"                         >                           What is it?                       </a>                     </li>                                                                            <li class=\"site-nav__item\">                       <a                         href=\"https://lifelet.co/collections\"                         class=\"site-nav__link\"                         data-meganav-type=\"child\"                         >                           Life Experiences                       </a>                     </li>                                                                            <li class=\"site-nav__item\">                       <a                         href=\"https://lifelet.co/pages/life-experience-stories\"                         class=\"site-nav__link\"                         data-meganav-type=\"child\"                         >                           Life Stories                       </a>                     </li>                                                                                               <li                       class=\"site-nav__item site-nav--has-dropdown\"                       aria-haspopup=\"true\"                       data-meganav-type=\"parent\">                       <a                         href=\"https://lifelet.co/\"                         class=\"site-nav__link\"                         data-meganav-type=\"parent\"                         aria-controls=\"MenuParent-4\"                         aria-expanded=\"false\"                         >                           Shop                           <span class=\"icon icon-arrow-down\" aria-hidden=\"true\"></span>                       </a>                       <ul                         id=\"MenuParent-4\"                         class=\"site-nav__dropdown\"                         data-meganav-dropdown>                                                                                 <li>                               <a                                 href=\"https://lifelet.co/apps/lifeletcheckout\"                                 class=\"site-nav__dropdown-link\"                                 data-meganav-type=\"child\"                                                                  tabindex=\"-1\">                                   Bracelets                               </a>                             </li>                                                                           </ul>                     </li>                                                                                          <li class=\"site-nav__item site-nav__expanded-item site-nav__item--compressed\">                     <a class=\"site-nav__link site-nav__link--icon\" href=\"https://lifelet.co/account\">                       <span class=\"icon-fallback-text\">                         <span class=\"icon icon-customer\" aria-hidden=\"true\"></span>                         <span class=\"fallback-text\">                                                        Log In                                                    </span>                       </span>                     </a>                   </li>                                                                                            <li class=\"site-nav__item site-nav__item--compressed\">                     <a href=\"https://lifelet.co/search\" class=\"site-nav__link site-nav__link--icon js-toggle-search-modal\" data-mfp-src=\"#SearchModal\">                       <span class=\"icon-fallback-text\">                         <span class=\"icon icon-search\" aria-hidden=\"true\"></span>                         <span class=\"fallback-text\">Search</span>                       </span>                     </a>                   </li>                                   <li class=\"site-nav__item site-nav__item--compressed\">                   <a href=\"https://lifelet.ca/cart.php\" class=\"site-nav__link site-nav__link--icon cart-link\" aria-controls=\"CartDrawer\">                     <span class=\"icon-fallback-text\">                       <span class=\"icon icon-cart\" aria-hidden=\"true\"></span>                       <span class=\"fallback-text\">Cart</span>                     </span>                     <span class=\"cart-link__bubble\"></span>                   </a>                 </li>                </ul>               <!-- //site-nav -->             </nav>             <div class=\"grid__item large--hide one-quarter\">               <div class=\"site-nav--mobile text-right\">                 <a href=\"https://lifelet.ca/cart.php\" class=\"site-nav__link cart-link\" aria-controls=\"CartDrawer\">                   <span class=\"icon-fallback-text\">                     <span class=\"icon icon-cart\" aria-hidden=\"true\"></span>                     <span class=\"fallback-text\">Cart</span>                   </span>                   <span class=\"cart-link__bubble\"></span>                 </a>               </div>             </div>           </div>          </div>       </header>     </div>   </div> </div>     </div><div id=\"PageContainer\" class=\"page-container\">', '<hr class=\"hr--large\"><div id=\"shopify-section-footer\" class=\"shopify-section\"><footer class=\"site-footer small--text-center\" role=\"contentinfo\">   <div class=\"wrapper\">      <div class=\"grid-uniform\">                                                                                            <div class=\"grid__item one-half small--one-whole\">           <ul class=\"no-bullets site-footer__linklist\">                                            <li><a href=\"https://lifelet.co/pages/about\">About Us</a></li>                                             <li><a href=\"https://lifelet.co/pages/shipping-returns\">Shipping & Returns</a></li>                                             <li><a href=\"https://lifelet.co/pages/policies-guidelines\">Policies & Guidelines</a></li>                                             <li><a href=\"https://lifelet.co/pages/lifelet-corp-privacy-policy\">Privacy Policy</a></li>                                             <li><a href=\"https://lifelet.co/pages/contact-us\">Contact Us</a></li>                         </ul>         </div>                       <div class=\"grid__item one-half small--one-whole large--text-right\">         <p>&copy; 2018, <a href=\"https://lifelet.co/\" title=\"\">LIFElet</a><br></p></div>     </div>    </div> </footer>     </div></div><div id=\"SearchModal\" class=\"mfp-hide\">     <!-- /snippets/search-bar.liquid -->      <form action=\"https://lifelet.co/search\" method=\"get\" class=\"input-group search-bar search-bar--modal\" role=\"search\">      <input type=\"search\" name=\"q\" value=\"\" placeholder=\"Search our store\" class=\"input-group-field\" aria-label=\"Search our store\">   <span class=\"input-group-btn\">     <button type=\"submit\" class=\"btn icon-fallback-text\">       <span class=\"icon icon-search\" aria-hidden=\"true\"></span>       <span class=\"fallback-text\">Search</span>     </button>   </span> </form>    </div></body></html>', '2018-12-10 01:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `json`
--

DROP TABLE IF EXISTS `json`;
CREATE TABLE IF NOT EXISTS `json` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `json_format` text NOT NULL,
  `date_time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `life_exp`
--

DROP TABLE IF EXISTS `life_exp`;
CREATE TABLE IF NOT EXISTS `life_exp` (
  `le_id` int(11) NOT NULL AUTO_INCREMENT,
  `le_category` varchar(12) NOT NULL,
  `le_option` varchar(255) NOT NULL,
  `le_price` varchar(25) NOT NULL,
  `le_date` datetime NOT NULL,
  PRIMARY KEY (`le_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `life_exp`
--

INSERT INTO `life_exp` (`le_id`, `le_category`, `le_option`, `le_price`, `le_date`) VALUES
(5, '4', 'Plastic', '25', '2018-11-12 15:33:15'),
(8, '4', 'Rubber', '15', '2018-11-12 15:50:08'),
(9, '4', 'Gems', '20', '2018-11-12 15:50:50'),
(11, '8', 'Blue Beed', '30', '2018-11-26 04:02:35'),
(12, '8', 'Pink Beed', '40', '2018-11-26 04:03:03'),
(13, '8', 'Stone Beed', '25', '2018-11-26 04:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_name_count` int(11) NOT NULL,
  `order_option` varchar(255) NOT NULL,
  `order_price` varchar(25) NOT NULL,
  `order_total` varchar(25) NOT NULL,
  `order_instruction` text NOT NULL,
  `order_status` tinyint(1) NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders_complete`
--

DROP TABLE IF EXISTS `orders_complete`;
CREATE TABLE IF NOT EXISTS `orders_complete` (
  `oc_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `order_number_shopify` varchar(25) NOT NULL,
  `trans_id` varchar(100) NOT NULL,
  `oc_cus_email` varchar(255) NOT NULL,
  `oc_cus_fname` varchar(255) NOT NULL,
  `oc_cus_lname` varchar(255) NOT NULL,
  `oc_cus_address1` text NOT NULL,
  `oc_cus_city` varchar(100) NOT NULL,
  `oc_cus_province` varchar(100) NOT NULL,
  `oc_cus_zip` varchar(30) NOT NULL,
  `oc_cus_country` varchar(100) NOT NULL,
  `oc_grand_total` float NOT NULL,
  `oc_discount_cent` varchar(100) NOT NULL,
  `oc_discount_value` varchar(50) NOT NULL,
  `oc_discount_code` varchar(100) NOT NULL,
  `oc_shipping_charges` varchar(25) NOT NULL,
  `oc_tax` varchar(255) NOT NULL,
  `oc_date` datetime NOT NULL,
  PRIMARY KEY (`oc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

DROP TABLE IF EXISTS `orders_detail`;
CREATE TABLE IF NOT EXISTS `orders_detail` (
  `od_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `product_id` varchar(25) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `variant_id` varchar(25) NOT NULL,
  `variant_title` varchar(255) NOT NULL,
  `variant_price` varchar(25) NOT NULL,
  PRIMARY KEY (`od_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `public_key` varchar(100) NOT NULL,
  `secret_key` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `public_key`, `secret_key`) VALUES
(1, 'pk_test_AfWHtT5RclqKHoMNDXxYkcoP', 'sk_test_ur4uR85ANAYFTqVsdE0UXCD8');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
