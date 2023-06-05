<div class="col-11 col-sm-6 col-md-4 col-lg-3">
    <div class="card card-hover mx-2">
        <img src="{{Voyager::get_image($imagen, $cropp_type, $storage)}}" class="card-img-top" alt="{{$title}}" title="{{$title}}">
        <div class="card-body d-flex flex-column justify-content-between">
            <h5 class="card-title m-0 text-truncate h6">{{str_limit($title, 50)}}</h5>
                <p class="card-text m-0 section__title fw-bold">
                 @if($precios == 1) Precio a acordar con el vendedor @else RD ${{$precios}} @endif
                </p>
        </div>
        <a href="/rd-{{$id}}/{{str_slug($prd_catname, '-')}}/{{str_slug($condicion)}}/{{str_slug($title)}}" class="stretched-link"></a>
    </div>
</div>