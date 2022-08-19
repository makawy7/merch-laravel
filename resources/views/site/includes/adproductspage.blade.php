@foreach(ads(1) as $ad)
<div class="content_scene_cat">
  <div class="align_center"> <img src="{{url('storage/images/ads/'.$ad->image)}}" width="100%"/> </div>
</div>
@endforeach
