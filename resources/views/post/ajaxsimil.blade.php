 @foreach($result as $results)
	<?php 
	 	$img = $results->postimagenes()->first(); 
	 	$imagen  = NULL;
	 	$storage = NULL;
	 	if ($img) {
	 		$imagen = $img->imagen;
	 		$storage = $img->storage;
	 	}
	?>
<a class="c-black" href="/vtucuman-{{$results->id}}/{{str_slug($results->name)}}/{{str_slug($results->title)}}/">
<div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:1.5rem!important;">
    <div class="col-item sinpadding col-md-12 col-xs-12 efectoproducto">
        <div class="photo sinpadding col-md-12 col-sm-2 col-xs-4 ">
            <img src="{{Voyager::get_image($imagen, 'medium', $storage)}}"  class="index-img img-responsive max-height-100 " alt="{{$results->title}}" />
        </div>
        <div class="info static_height sinpadding col-md-12 col-sm-10 col-xs-8">
            <div class="price col-md-12">
                <div class="col-md-12 titlehome">
                  <p class="visible-md visible-sm visible-lg">{{str_limit($results->title, 60)}}</p>
                  <p class="visible-xs">{{str_limit($results->title, 30)}}</p>
                </div>
                <div class="col-md-12 col-xs-12 ">
                    <span>ARS ${{$results->precios}}</span>
                </div>
            </div>
            <div class="clearfix">
            </div>
        </div>
    </div>
</div>
</a>

@endforeach 