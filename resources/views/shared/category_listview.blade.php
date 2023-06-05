<a class="c-black" href="/vtucuman-{{$id}}/{{str_slug($prd_catname, '-')}}/{{str_slug($title)}}">
    <div class="col-md-3 col-sm-6 col-xs-12" style="margin-bottom:1.5rem!important;">
      <div class="col-item sinpadding col-md-12 col-xs-12 efectoproducto">
          <div class="photo sinpadding col-md-12 col-sm-12 col-xs-3 height_239px">
              <img 
              data-src-load="{{Voyager::get_image($imagen, $cropp_type, $storage)}}"
              class="index-img img-responsive max-height-100 " alt="{{$title}}" title="{{$title}}" />
              
          </div>
        <div class="sinpadding col-md-12 col-sm-12 col-xs-9">
          <div class=" col-md-12">
            <div class="col-md-12 titlehome">
              <p class="visible-md visible-sm visible-lg">{{str_limit($title, 40)}} </p>
              <p class="visible-xs">{{str_limit($title, 35)}} </p>
            </div>
             <div class="col-md-12 col-xs-12">
                <span class="precioSindescuento"> @if($precios == 1) Precio a acordar con el vendedor @else RD ${{$precios}} @endif</span>
             </div>
          </div>
          <div class="clearfix">
          </div>
        </div>
      </div>
    </div>
</a>