<div id="tmproductstab" class=" products_block clearfix">
  <div class="tab-main-title">
    <ul id="tmproduct-tabs" class="nav nav-tabs clearfix">
      <li class="first_item"> <a href="#in_addition_inquisition" data-toggle="tab">مستخدم جديد</a> </li>
    </ul>
  </div>
  <div class="tab-content">
    <div id="in_addition_inquisition" class="tab_content tab-pane">
      <div class="block_content row">
        <form action="{{route('register')}}" method="post" id="registerform">
          @csrf
          <div class="form_content clearfix">
            <div class="form-group form-error">
              <input class="is_required validate account_input form-control" value="{{old('name')}}" type="name" name="name" placeholder="الاسم بالكامل">
              <small id="nameerror" style="color:red;font-size:10px">من فضلك ادخل الاسم</small>
            </div>
            <div class="form-group form-error">
              <select name="code" class="form-control">
                @foreach(countries() as $country)
                  <option {{old('code')==$country->code?'selected':''}} value="{{$country->code}}">{{$country->code}}</option>
                @endforeach
              </select>
              <input class="is_required validate account_input form-control" id="regphonenumber" type="tel" name="phone" placeholder="رقم الجوال">
              <small id="phoneerror" style="color:red;font-size:10px">من فضلك ادخل رقم الهاتف</small>
            </div>
            <div class="form-group form-error">
              <input class="is_required validate account_input form-control" type="email" value="{{old('email')}}" name="email" placeholder="البريد الإلكترونى">
              <small id="emailerror" style="color:red;font-size:10px">من فضلك ادخل البريد الالكتروني</small>
            </div>
            <div class="form-group form-error">
              <input class="is_required validate account_input form-control" type="password" name="password" placeholder="كلمة المرور">
              <small id="passerror" style="color:red;font-size:10px">من فضلك ادخل الرقم السري</small>
            </div>
            <div class="form-group form-error">
              <input class="is_required validate account_input form-control" type="password" name="password_confirmation" placeholder="إعادة كلمة المرور">
              <small id="passcerror" style="color:red;font-size:10px">من فضلك ادخل تأكيد الرقم السري</small>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 padding-left padding-right">
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding-right">
                <label> الجنس :</label>
              </div>
              <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 padding-right padding-left">
                <div class="form-group form-error">
                  <select name="gender" id="gender" class="form-control">
                    <option {{old('gender')=='male'?'selected':''}} value="male" selected="selected">ذكر</option>
                    <option {{old('gender')=='female'?'selected':''}} value="female">أنثى</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 padding-left">
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding-right padding-left">
                <label> تاريخ الميلاد :</label>
              </div>
              <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 padding-left">
                <div class="form-group form-error">
                  <input class="is_required validate account_input form-control" name="birthday" {{old('birthday')}} type="date" placeholder="تاريخ الميلاد">
                  <small id="birthdayerror" style="color:red;font-size:10px">من فضلك ادخل تاريخ الميلاد</small>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 padding-left padding-right">
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding-right">
                <label> الدولة :</label>
              </div>
              <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 padding-right padding-left">
                <div class="form-group form-error">
                  <select name="country" id="countryinput" class="form-control">
                    @foreach(countries() as $country)
                      <option {{old('country')==$country->id?'selected':''}} value="{{$country->id}}">{{$country->getname()}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 padding-left">
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding-right padding-left">
                <label> المدينة :</label>
              </div>
              <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 padding-right padding-left">
                <div class="form-group form-error">
                  <select name="city" id="cityinput"class="form-control">
                  </select>
                </div>
              </div>
            </div>
            <p>
              <button type="submit" id="register" name="SubmitLogin" class="button btn btn-info button-medium"> <span>تسجيل <i class="fa fa-sign-in"></i></span> </button>
            </p>
          </div>
        </form>
        <button class="md-close hidden"></button>
      </div>
    </div>
      @foreach(countries() as $country)
      <span id="c_{{$country->id}}" class="hide">
        @foreach($country->cities as $city)
          <option {{old('city')==$city->id?'selected':''}} value="{{$city->id}}">{{$city->getname()}}</option>
        @endforeach
      </span>
      @endforeach
  </div>
</div>
