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

@if(app()->getLocale()=='ar')
<link rel="stylesheet" href="{{url('des/site')}}/css/style.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{url('des/site')}}/css/custom.css" />
<link rel="stylesheet" href="{{url('des/site')}}/css/product_list.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/tmverticalmenu.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/blockcart.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/module/banner/flexslider.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/module/ovicnewsletter/ovicnewsletter.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{url('des/site')}}/css/font-awesome.min.css" />
<link rel="stylesheet" href="{{url('des/site')}}/css/rtl.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/bootstrap-rtl.css" type="text/css" media="all" />
@else
<link rel="stylesheet" type="text/css" href="{{url('des/site')}}/css/custom.css" />
<link rel="stylesheet" href="{{url('des/site')}}/css/product_list.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/tmverticalmenu.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/css/blockcart.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/module/banner/flexslider.css" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('des/site')}}/module/ovicnewsletter/ovicnewsletter.css" type="text/css" media="all" />
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
var priceDisplayMethod = 1;
var priceDisplayPrecision = 2;
var productAvailableForOrder = true;
var productBasePriceTaxExcl = 240;
var productBasePriceTaxExcluded = 240;
var productBasePriceTaxIncl = 240;
var productHasAttributes = true;
var productPrice = 240;
var productPriceTaxExcluded = 240;
var productPriceTaxIncluded = 240;
var productPriceWithoutReduction = 240;
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
</head>
<body id="index" class="index hide-left-column hide-right-column lang_ar">
<!-- ================ بداية فورم تسجيل الدخول ============= -->
<div class="md-modal md-effect-1" id="modal-1">
  <div class="md-content">
    <div>
      <form action="{{route('login')}}" method="post" id="login_form">
				@csrf
        <h3 class="page-subheading"> تسجيل دخول <i class="fa fa-sign-in"></i></h3>
        <div class="form_content clearfix">
          <!-- <div class="form-group form-error">
            <input class="is_required validate account_input form-control" type="text" placeholder="إسم المستخدم">
          </div>
          <div class="form-group form-error">
            <input class="is_required validate account_input form-control" type="tel" placeholder="رقم الجوال">
          </div> -->
          <div class="form-group form-error">
            <input class="is_required validate account_input form-control" type="email" name="email" placeholder="البريد الإلكترونى">
          </div>
          <div class="form-group form-error">
            <input class="is_required validate account_input form-control" type="password" name="password"  placeholder="كلمة المرور">
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
<!-- ================  نهاية بداية فورم تسجيل الدخول  ============= -->
<!-- ================ بداية فورم تسجيل جديد ============= -->
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
<div class="md-overlay"></div>
<!-- ================  نهاية فورم تسجيل جديد  ============= -->
<div id="page">
