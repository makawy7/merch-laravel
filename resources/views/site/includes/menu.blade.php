<!-- Menu -->
<div class="container vertical">
  <div id="tm_vertical_menu_top" class="tmvm-contener clearfix col-lg-12">
    <div class="block-title">
      <div class="cat-title">جميع الأقسام والمناسبات</div>
      <div class="title-arrow"></div>
    </div>
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
                  @foreach(ads(1) as $ad)
                   <li class="category-thumbnail">
                     <div><img src="{{url('storage/images/ads/'.$ad->image)}}" alt="{{$ad->gettitle()}}" title="{{$ad->gettitle()}}" class="imgm" /></div>
                   </li>
                 @endforeach


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
