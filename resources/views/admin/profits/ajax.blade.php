<div class="box statistics">
  <div class="box-header">
    <h3 class="box-title">{{__('admindash.profits.profits_')}} {{currentyear()}}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="main-table" class="table direction table-bordered table-striped">
      <thead>
      <tr>
        <th>{{__('admindash.profits.month')}}</th>
        <th>{{__('admindash.profits.sales')}}</th>
        <th>{{__('admindash.profits.storeprofit')}}</th>
        <th>{{__('admindash.profits.webcommission')}}</th>
        <th>{{__('admindash.profits.netprofit')}}</th>
      </tr>
      </thead>
      <tbody>
        @for($i=1;$i<=12;$i++)
        <tr class="{{currentmonth()==$i?'bg-olive':''}}">
          <td>{{__('admindash.months.'.$i)}}</td>
          <td>{{storeprofit(currentyear(),$storeid,$i)['sales']}}</td>
          <td>{{storeprofit(currentyear(),$storeid,$i)['storeprofit']}} {{__('admindash.constants.usd')}}</td>
          <td>{{storeprofit(currentyear(),$storeid,$i)['webcommission']}} {{__('admindash.constants.usd')}}</td>
          <td>{{storeprofit(currentyear(),$storeid,$i)['storeprofit']-storeprofit(currentyear(),$storeid,$i)['webcommission']}} {{__('admindash.constants.usd')}}</td>
        </tr>
        @endfor
        <tr>
          <th>{{__('admindash.profits.yeartotal')}}</th>
          <th>{{storeprofit(currentyear(),$storeid)['sales']}}</th>
          <th>{{storeprofit(currentyear(),$storeid)['storeprofit']}} {{__('admindash.constants.usd')}}</th>
          <th>{{storeprofit(currentyear(),$storeid)['webcommission']}} {{__('admindash.constants.usd')}}</th>
          <th>{{storeprofit(currentyear(),$storeid)['storeprofit']-storeprofit(currentyear(),$storeid)['webcommission']}} {{__('admindash.constants.usd')}}</th>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>



<div class="box statistics">
  <div class="box-header">
    <h3 class="box-title">{{__('admindash.profits.profits_')}} {{previousyear()}}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="main-table" class="table direction table-bordered table-striped">
      <thead>
      <tr>
        <th>{{__('admindash.profits.month')}}</th>
        <th>{{__('admindash.profits.sales')}}</th>
        <th>{{__('admindash.profits.storeprofit')}}</th>
        <th>{{__('admindash.profits.webcommission')}}</th>
        <th>{{__('admindash.profits.netprofit')}}</th>
      </tr>
      </thead>
      <tbody>
        @for($i=1;$i<=12;$i++)
        <tr>
          <td>{{__('admindash.months.'.$i)}}</td>
          <td>{{storeprofit(previousyear(),$storeid,$i)['sales']}}</td>
          <td>{{storeprofit(previousyear(),$storeid,$i)['storeprofit']}} {{__('admindash.constants.usd')}}</td>
          <td>{{storeprofit(previousyear(),$storeid,$i)['webcommission']}} {{__('admindash.constants.usd')}}</td>
          <td>{{storeprofit(previousyear(),$storeid,$i)['storeprofit']-storeprofit(previousyear(),$storeid,$i)['webcommission']}} {{__('admindash.constants.usd')}}</td>
        </tr>
        @endfor
        <tr>
          <th>{{__('admindash.profits.yeartotal')}}</th>
          <th>{{storeprofit(previousyear(),$storeid)['sales']}}</th>
          <th>{{storeprofit(previousyear(),$storeid)['storeprofit']}} {{__('admindash.constants.usd')}}</th>
          <th>{{storeprofit(previousyear(),$storeid)['webcommission']}} {{__('admindash.constants.usd')}}</th>
          <th>{{storeprofit(previousyear(),$storeid)['storeprofit']-storeprofit(previousyear(),$storeid)['webcommission']}} {{__('admindash.constants.usd')}}</th>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
