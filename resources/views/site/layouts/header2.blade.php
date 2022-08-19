<!DOCTYPE HTML>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
<meta charset="utf-8" />
<title>{{setting()->sitename()}}</title>
<meta name="description" content="kaizendesign" />
<meta name="generator" content="kaizendesign" />
<meta name="robots" content="index,follow" />
<meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="icon" type="image/vnd.microsoft.icon" href="{{url('storage/images/setting/'.setting()->icon)}}" />
<link rel="shortcut icon" type="image/x-icon" href="{{url('storage/images/setting/'.setting()->icon)}}" />
<link rel="stylesheet" href="{{url('des/site')}}/css/style.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{url('des/site')}}/css/custom.css" />
<link rel="stylesheet" type="text/css" href="{{url('des/site')}}/js/jquery/plugins/fancybox/jquery.fancybox.css" />
<link rel="stylesheet" href="{{url('des/site')}}/css/product_list.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/tmverticalmenu.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/blockcart.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/module/banner/flexslider.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/blockuserinfo.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/module/ovicnewsletter/ovicnewsletter.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/productcomments.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/product.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{url('des/site')}}/css/font-awesome.min.css" />
<link rel="stylesheet" href="{{url('des/site')}}/css/rtl.css" type="text/css" media="all" />
@if(app()->getLocale()=='ar')
<link rel="stylesheet" type="text/css" href="{{url('des/site')}}/css/custom.css" />
<link rel="stylesheet" href="{{url('des/site')}}/css/product_list.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/tmverticalmenu.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/blockcart.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/blocklayered.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/uniform.default.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/module/banner/flexslider.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/module/ovicnewsletter/ovicnewsletter.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{url('des/site')}}/css/font-awesome.min.css" />
<link rel="stylesheet" href="{{url('des/site')}}/css/rtl.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/bootstrap-rtl.css" type="text/css" media="all" />
@else
<link rel="stylesheet" href="{{url('des/site')}}/css/product_list.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/tmverticalmenu.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/blockcart.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/module/banner/flexslider.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/blockuserinfo.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/productcomments.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/product.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{url('des/site')}}/css/font-awesome.min.css" />
<link rel="stylesheet" href="{{url('des/site')}}/css/rtl.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/bootstrap.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/style.css" type="text/css" media="all" />
@endif
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/css/intlTelInput.css" type="text/css" media="all" />
<!-- ================ Additional CSS By Tempaltemela : START  ============= -->
<!-- ================ Additional CSS By Tempaltemela : START  ============= -->

<script type="text/javascript">

var CUSTOMIZE_TEXTFIELD = 1;
var FancyboxI18nClose = 'Close';
var FancyboxI18nNext = 'Next';
var FancyboxI18nPrev = 'Previous';
var PS_CATALOG_MODE = false;
var added_to_wishlist = 'تم إضافة المنتج بنجاح إلى قائمة الأمنيات.';
var ajax_allowed = true;
var ajaxsearch = true;
var allowBuyWhenOutOfStock = false;
var attribute_anchor_separator = '-';
var attributesCombinations = [{"id_attribute":"2","id_attribute_group":"1","attribute":"m","group":"size"},{"id_attribute":"13","id_attribute_group":"3","attribute":"orange","group":"color"},{"id_attribute":"3","id_attribute_group":"1","attribute":"l","group":"size"},{"id_attribute":"1","id_attribute_group":"1","attribute":"s","group":"size"}];
var availableLaterValue = '';
var availableNowValue = 'فى المخزن';
var baseDir = 'index.html';
var baseUri = 'index.html';
var combinations = {"60":{"attributes_values":{"1":"S","3":"Orange"},"attributes":[1,13],"price":0,"specific_price":false,"ecotax":0,"weight":0,"quantity":350,"reference":"","unit_impact":0,"minimal_quantity":"1","date_formatted":"","available_date":"","id_image":-1,"list":"'1','13'"},"58":{"attributes_values":{"1":"M","3":"Orange"},"attributes":[2,13],"price":0,"specific_price":false,"ecotax":0,"weight":0,"quantity":500,"reference":"","unit_impact":0,"minimal_quantity":"1","date_formatted":"","available_date":"","id_image":-1,"list":"'2','13'"},"59":{"attributes_values":{"1":"L","3":"Orange"},"attributes":[3,13],"price":0,"specific_price":false,"ecotax":0,"weight":0,"quantity":210,"reference":"","unit_impact":0,"minimal_quantity":"1","date_formatted":"","available_date":"","id_image":-1,"list":"'3','13'"}};
var combinationsFromController = {"60":{"attributes_values":{"1":"S","3":"Orange"},"attributes":[1,13],"price":0,"specific_price":false,"ecotax":0,"weight":0,"quantity":350,"reference":"","unit_impact":0,"minimal_quantity":"1","date_formatted":"","available_date":"","id_image":-1,"list":"'1','13'"},"58":{"attributes_values":{"1":"M","3":"Orange"},"attributes":[2,13],"price":0,"specific_price":false,"ecotax":0,"weight":0,"quantity":500,"reference":"","unit_impact":0,"minimal_quantity":"1","date_formatted":"","available_date":"","id_image":-1,"list":"'2','13'"},"59":{"attributes_values":{"1":"L","3":"Orange"},"attributes":[3,13],"price":0,"specific_price":false,"ecotax":0,"weight":0,"quantity":210,"reference":"","unit_impact":0,"minimal_quantity":"1","date_formatted":"","available_date":"","id_image":-1,"list":"'3','13'"}};
var comparator_max_item = 3;
var comparedProductsIds = [];
var confirm_report_message = 'هل أنت متأكد أنك تريد الإبلاغ عن هذا التعليق؟';
var contentOnly = false;
var currency = {"id":1,"name":"Dollar","iso_code":"USD","iso_code_num":"840","sign":"$","blank":"0","conversion_rate":"1.000000","deleted":"0","format":"1","decimals":"1","active":"1","prefix":"$ ","suffix":"","id_shop_list":null,"force_id":false};
var currencyBlank = 0;
var currencyFormat = 1;
var currencyRate = 1;
var currencySign = '$';
var currentDate = '2016-12-31 05:24:33';
var customerGroupWithoutTax = true;
var customizationFields = false;
var customizationId = null;
var customizationIdMessage = 'التخصيص #';
var default_eco_tax = 0;
var delete_txt = 'حذف';
var displayDiscountPrice = '0';
var displayList = false;
var displayPrice = 1;
var doesntExist = 'هذه المجموعة غير موجودة لهذا المنتج. يرجى اختيار مجموعة أخرى.';
var doesntExistNoMore = 'هذا المنتج لم يعد في المخزن';
var doesntExistNoMoreBut = 'مع تلك الصفات ولكن متاح مع الآخرين.';
var ecotaxTax_rate = 0;
var fieldRequired = 'يرجى ملء جميع الحقول المطلوبة قبل حفظ التخصيص الخاص بك.';
var freeProductTranslation = '!مجاناً';
var freeShippingTranslation = 'شحن مجاني!';
var generated_date = 1483179872;
var groupReduction = 0;
var hasDeliveryAddress = false;
var highDPI = false;
var idDefaultImage = 207;
var id_lang = 5;
var id_product = 10;
var img_dir = '';
var img_prod_dir = 'img/index.html';
var img_ps_dir = 'img/index.html';
var instantsearch = false;
var isGuest = 0;
var isLogged = 0;
var isMobile = false;
var jqZoomEnabled = true;
var loggin_required = 'يجب أن تكون مسجلا لإدارة قائمتك المفضلة.';
var maxQuantityToAllowDisplayOfLastQuantityMessage = 3;
var max_item = 'لا يمكنك إضافة أكثر من 3 منتج (منتجات) إلى مقارنة المنتج';
var min_item = 'الرجاء تحديد منتج واحد على الأقل';
var minimalQuantity = 1;
var moderation_active = true;
var mywishlist_url = '#';
var noTaxForThisProduct = true;
var oosHookJsCodeFunctions = [];
var page_name = 'product';
var placeholder_blocknewsletter = 'أدخل بريدك الالكتروني';
var productReference = 'demo_10';
var productShowPrice = true;
var productUnitPriceRatio = 0;
var product_fileButtonHtml = 'اختر ملف';
var product_fileDefaultHtml = 'لم يتم اختيار اي ملف';
var product_specific_price = [];
var productcomment_added = 'تمت إضافة تعليقك!';
var productcomment_added_moderation = 'لقد تمت إضافة تعليقك وسيصبح متاحًا بمجرد موافقة المشرف عليه.';
var productcomment_ok = 'حسنا';
var productcomment_title = 'تعليق جديد';
var productcomments_controller_url = '#';
var productcomments_url_rewrite = false;
var quantitiesDisplayAllowed = true;
var quantityAvailable = 1060;
var quickView = true;
var reduction_percent = 0;
var reduction_price = 0;
var removingLinkText = 'حذف';
var roundMode = 2;
var search_url = '#';
var secure_key = '4b79505d466f5a3ad577b5397a44c4d8';
var specific_currency = false;
var specific_price = 0;
var static_token = 'a62abb9149a9532b8286755cbf8a443a';
var stf_msg_error = 'لا يمكن إرسال بريدك الإلكتروني. يرجى التحقق من عنوان البريد الإلكتروني والمحاولة مرة أخرى.';
var stf_msg_required = 'أنت لم تملأ الحقول المطلوبة';
var stf_msg_success = 'تم إرسال البريد الإلكتروني الخاص بك بنجاح';
var stf_msg_title = 'Send to a friend';
var stf_secure_key = '511e5dfb61624b780e5209876b29680a';
var stock_management = 1;
var taxRate = 0;
var tmblocksearch_type = 'top';
var toBeDetermined = 'يتم تحديدها';
var token = 'a62abb9149a9532b8286755cbf8a443a';
var upToTxt = 'Up to';
var uploading_in_progress = 'جاري التحميل ، يرجى التحلي بالصبر.';
var usingSecureMode = false;
var wishlistProductsIds = false;

</script>

<script src="{{url('des/site')}}/js/modernizr.custom.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/jquery/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.7/js/intlTelInput.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/jquery/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/jquery/plugins/jquery.easing.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/tools.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/global.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/module/banner/jquery.flexslider.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/10-bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/jquery/plugins/jquery.idTabs.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/jquery/plugins/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/module/blockcart/ajax-cart.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/jquery/plugins/jquery.scrollTo.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/jquery/plugins/jquery.serialScroll.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/product.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/jquery/plugins/jqzoom/jquery.jqzoom.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/module/productcomments/js/jquery.rating.pack.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/module/productcomments/js/productcomments.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/jquery/plugins/bxslider/jquery.bxslider.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/module/blocknewsletter/blocknewsletter.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/jquery/plugins/autocomplete/jquery.autocomplete.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/module/blockwishlist/js/ajax-wishlist.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/module/tmverticalmenu/views/js/doubletaptogo.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/module/tmverticalmenu/views/js/tmverticalmenu.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/module/ovicnewsletter/ovicnewsletter.js"></script>
<!-- ================ Additional SCRIPT By Tempaltemela : START  ============= -->
<script type="text/javascript" src="{{url('des/site')}}/js/megnor/owl.carousel.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/megnor/custom.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/megnor/lightbox-2.6.min.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/megnor/jquery.slimscroll.js"></script>
<script type="text/javascript" src="{{url('des/site')}}/js/megnor/doubletaptogo.js"></script>
<!-- ================ Additional SCRIPT By Tempaltemela : END  ============= -->
<script type="text/javascript">
	$(window).load(function() {
	  $('.flexslider').flexslider({
		pauseOnHover: true,
		slideshowSpeed: 5000,
	  });
	});
</script>
<style media="screen">
	#loading{
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	}
	#loading img{
	position: relative;
	{{app()->getLocale()=='ar'?'right':'left'}}: 50%;
	top: 50%;
	z-index: 9999;
	}

	#ratinglabel{
		position: relative;
		bottom: -45px;
	}
	.rating {
  display: inline-block;
  position: relative;
	bottom: -125px;
  height: 50px;
  line-height: 50px;
  font-size: 50px;
	}

	.rating label {
	  position: absolute;
	  top: 0;
	  left: 0;
	  height: 100%;
	  cursor: pointer;
	}

	.icon{
				font-size: 20px;
	}
	.rating label:last-child {
	  position: static;
	}

	.rating label:nth-child(1) {
	  z-index: 5;
	}

	.rating label:nth-child(2) {
	  z-index: 4;
	}

	.rating label:nth-child(3) {
	  z-index: 3;
	}

	.rating label:nth-child(4) {
	  z-index: 2;
	}

	.rating label:nth-child(5) {
	  z-index: 1;
	}

	.rating label input {
	  position: absolute;
	  top: 0;
	  left: 0;
	  opacity: 0;
	}

	.rating label .icon {
	  float: left;
	  color: transparent;
	}

	.rating label:last-child .icon {
	  color: #000;
	}

	.rating:not(:hover) label input:checked ~ .icon,
	.rating:hover label:hover input ~ .icon {
	  color: #09f;
	}

	.rating label input:focus:not(:checked) ~ .icon:last-child {
	  color: #000;
	  text-shadow: 0 0 5px #09f;
	}

</style>

</head>
	<body>
<div id="loading" class="hide"><img src='{{url("des/site/animated_spinner.gif")}}' width="50" height="50" /></div>
<div class="md-modal md-effect-1" id="modal-1">
  <div class="md-content">
    <div>
      <form action="{{route('login')}}" method="post" id="login_form">
				@csrf
        <h3 class="page-subheading"> تسجيل دخول <i class="fa fa-sign-in"></i></h3>
        <div class="form_content clearfix">
          <div class="form-group form-error">
            <input class="is_required validate account_input form-control" type="email" name="email" placeholder="البريد الإلكترونى">
          </div>
          <div class="form-group form-error">
            <input class="is_required validate account_input form-control" type="password" name="password" placeholder="كلمة المرور">
          </div>
					<div class="form-group form-error">
						<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

						<label class="form-check-label" for="remember">
								تذكرني
						</label>
					</div>
					@if (Route::has('password.request'))
							<a class="btn btn-link" href="{{ route('password.request') }}">
									هل نسيت كلمة المرور؟
							</a>
					@endif
          <p>
            <button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-info button-medium"> <span> <i class="icon-lock left"></i> دخول </span> </button>
          </p>
        </div>
      </form>
      <button class="md-close hidden">Close me!</button>
    </div>
  </div>
</div>
<div class="md-modal md-effect-1" id="modal-2">
  <div class="md-content">
    <div>
		@include('site.includes.register')
      <script type="text/javascript">
	$(document).ready(function() {
		$('#tmproduct-tabs li:first, #tmproductstab .tab-content div:first').addClass('active');
	});
</script>
    </div>
  </div>
</div>

<!-- ================  نهاية بداية فورم تسجيل الدخول  ============= -->
<!-- ================ بداية رسالة رقم 1 ============= -->
<div class="md-modal md-effect-3" id="modal-3">
  <div class="md-content">
    <div>
      <b>يرجى تسجيل الدخول اولأ</b>
      <p>
            <button type="submit" id="SubmitLogin" name="SubmitLogin" class="md-close md-trigger button btn btn-info button-medium" data-modal="modal-1"> <span> <i class="icon-lock left"></i> تسجيل الدخول </span> </button>
          </p>
      <button class="md-close hidden">Close me!</button>
    </div>
  </div>
</div>
<!-- ================  نهاية رسالة رقم 1  ============= -->
<!-- ================ بداية رسالة رقم 2 ============= -->
<div class="md-modal md-effect-4" id="modal-4">
  <div class="md-content">
    <div>
      <b>تم إضافة المنتج الى سلة المشتريات</b>
      <button class="md-close hidden">Close me!</button>
    </div>
  </div>
</div>
<!-- ================  نهاية رسالة رقم 2  ============= -->

		<div class="md-overlay"></div>
					<div id="page">
			<div class="header-container">
 <header id="header">
		<div class="nav">
        <div class="container">
          <div class="row">
            <nav>
						@if(auth()->user())
							@include('site.includes.dropdown_profile')
						@else
						<div class="header_user_info">
							<ul>
								<li class="style md-trigger" data-modal="modal-2"><a href="#"><i class="fa fa-user"></i>&nbsp;إنشاء حساب</a></li>
								<li class="style md-trigger" data-modal="modal-1"><a href="#"><i class="fa fa-user"></i>&nbsp;تسجيل دخول</a></li>
							</ul>
						</div>
						@endif
              <div id="currencies-block-top">
                <form id="setCurrency" action="#" method="post">
                  <div class="current">
                    <input type="hidden" name="id_currency" id="id_currency" value=""/>
                    <input type="hidden" name="SubmitCurrency" value="" />
                    <span class="cur-label">العمله :</span> <strong>{{getcurrency()->getabbreviation()}}</strong> <i class="fa fa-caret-down"></i></div>
	                  <ul id="first-currencies" class="currencies_ul toogle_content">
											@if(function_exists('currencies') && count(currencies())>0)
												@foreach(currencies() as $currency)
			                    <li > <a href="{{route('currencychange',$currency->id)}}"> {{$currency->getname()}} ({{$currency->getabbreviation()}}) </a> </li>
												@endforeach
											@endif
	                  </ul>
                </form>
              </div>
              <div id="languages-block-top" class="languages-block">
									@if(app()->getLocale()=='ar')
											<div class="current"> <span><img src="{{url('des/site')}}/images/ar.png"></span>
											<span class="cur-label">&nbsp; العربية</span>&nbsp; <i class="fa fa-caret-down"></i>  </div>
											<ul id="first-languages" class="languages-block_ul toogle_content">
											<li class="selected"> <span><img src="{{url('des/site')}}/images/ar.png"> العربية</span></li>
											<li><a href="{{route('lang','en')}}">  <span> <img src="{{url('des/site')}}/images/en.jpg"> English</span>  </a> </li>
									@else
											<div class="current"> <span><img src="{{url('des/site')}}/images/en.jpg"></span>
											<span class="cur-label">&nbsp; English</span>&nbsp; <i class="fa fa-caret-down"></i>  </div>
											<ul id="first-languages" class="languages-block_ul toogle_content">
											<li class="selected"> <span><img src="{{url('des/site')}}/images/en.jpg"> English</span></li>
											<li><a href="{{route('lang','ar')}}">  <span> <img src="{{url('des/site')}}/images/ar.png"> العربية</span>  </a> </li>
									@endif

                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
		<div class="headerdiv">
						<div class="container">
							<div class="row">
								<div id="header_logo"> <a href="{{route('index')}}"> <img class="logo img-responsive" src="{{url('storage/images/setting/'.setting()->logo)}}" alt="Logo" title="Logo"/> </a> </div>
<div id="tmcmsheaderblock">

					<div class="col-xs-12">
						@include('site.includes.bellandheart')
					</div>
		</div>
@include('site.includes.searchbar')
<div class="header_cart col-sm-4 clearfix padding-left  {{url()->current()==route('cart.index')?'hide':''}}">
              <div class="shopping_cart">
              <a href="#">
              <span class="ajax_cart_quantity style">@if(auth()->user())
							{{count(auth()->user()->carts)}}
							@endif</span>
              <span class="cart_block_total ajax_block_cart_total hidden-xs">الإجمالى : <span class="totalprice">{{auth()->user()?auth()->user()->totalcartprice()*getcurrency()->value.' '.getcurrency()->getabbreviation():0}}</span> </span>
              </a>

                <div class="cart_block block exclusive">
                  <div class="block_content">
                    <div class="cart_block_list">
                      <dl class="products">
												@if(auth()->user())
													@foreach(auth()->user()->carts as $cart)
														<dt data-id="cart_block_product_3_13_0" class="last_item"> <a class="cart-images" href="#"><img src="{{url('')}}/storage/images/products/{{$cart->product->image}}"/></a>
															 <div class="cart-info">
																 <div class="product-name"> <span class="quantity-formated">
																 </span> <a class="cart_block_product_name" href="{{url('')}}/products/{{$cart->product->getslug()}}">{{$cart->product->gettitle()}}</a> </div>
																 <small>{{$cart->getoptions()}}</small>
																 <div class="quantity"> الكمية : <span class="cartquantity">{{$cart->quantity}}</span></div>
																 <span>{{$cart->qprice()*getcurrency()->value.' '.getcurrency()->getabbreviation()}}</span>
																</div>
															<span class="remove_link" data-cartid={{$cart->id}}><a  href="#"> </a></span>
														</dt>
													@endforeach
												@endif
                      </dl>
                      <div class="cart-prices">
                        <div class="cart-prices-line last-line"> <span class="cart_block_total ajax_block_cart_total totalprice2">{{auth()->user()?auth()->user()->totalcartprice()*getcurrency()->value.' '.getcurrency()->getabbreviation():0}}</span> <span>الأجمالى</span> </div>
                      </div>
                      <p class="cart-buttons"> <a class="btn btn-info" href="{{route('cart.index')}}"><span><i class="fa fa-shopping-cart"></i> عرض السلة</span></a> </p>
                      <p class="cart-buttons"> <a class="btn btn-info" href="{{route('shippingaddress')}}"><span>اتمام الطلب</span></a> </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
						@include('site.includes.topmenu')
	<div id="tm_vertical_menu" class="tmvm-contener clearfix block">
               <div class="cat-title title_block">الأقسام والمناسبات</div>
              <div class="block_content">
                <ul class="tmvm-menu clearfix tmvmmenu-content">
									@if(function_exists('maincats') && count(maincats())>0)
											@foreach(maincats() as $maincat)
												<li class="tm-haschild"><a href="#" title="{{$maincat->getName()}}">{{$maincat->getName()}}</a>
													<div class="tmvm_menu_container">
														<div class="tmvm_menu_inner" style="width:388px;">
															<div class="tmvm_menu_col col2">
																<ul>
																	@foreach($maincat->subcats as $subcat)
																		<li class="tm-hassubchild"><a href="{{route('show.subcat',$subcat->getslug())}}" title="{{$subcat->getName()}}">{{$subcat->getName()}}</a>
																			<ul>
																				@foreach($subcat->types as $type)
																					<li class=""><a href="{{route('show.type',$type->getslug())}}" title="{{$type->getName()}}">{{$type->getName()}}</a></li>
																				@endforeach
																			</ul>
																		</li>
																	@endforeach
																	<li class="category-thumbnail">
																		<div><img src="{{url('des/site')}}/images/banner.jpg" alt="اعلان" title="اعلان" class="imgm" /></div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</li>
											@endforeach
									@endif
                </ul>
              </div>
            </div>
							</div>

						</div>
					</div>
				</header>
    <div class="fullbg"></div>
  </div>
