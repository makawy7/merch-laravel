<div id="search_block_top" class="clearfix">
              <form method="get" action="{{route('search')}}" id="searchbox">

              <div class="searchboxform-control">
                  <select name="maincatid" id="search_category">
                    <option value="0"  selected="selected">الكل</option>
                    @if(function_exists('maincats'))
                      @foreach(maincats() as $maincat)
                        <option value="{{$maincat->id}}" >{{$maincat->getname()}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <input class="search_query form-control" type="text" id="search_query_top" name="search" placeholder="ابحث عن المنتج" value="" />
                <button type="submit"  class="btn btn-default button-search"> </button>
              </form>
  </div>
