@if($sliders->count() > 0)
<div class="col-md-12 sinpadding">
  <div id="myCarousel" class="carousel slide bottom_10" data-ride="carousel">


    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        @foreach($sliders as $showSlider)
          <div class="item itemcarrouselHome" id="{{$showSlider->id}}">
            <img src="storage/{{$showSlider->image}}" alt="{{$showSlider->tittle}}" style="width: 100%;">
            <div class="carousel-caption d-none d-md-block">
              <!--<h3>{{$showSlider->tittle}}</h3> -->
            </div>
          </div>
        @endforeach
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
  </div>
</div>
@endif

<?php /*<div class="col-md-3">
    <!--Star hight line-->
  @if($getdestacado->count() > 0)
      <div class="col-md-12 col-sm-12 sinpadding ">
   
        <div class="col-md-12 sinpadding ">
          @foreach($getdestacado as $getdestacados)
            <?php 
                $pu_hight_line = $getdestacados->post; 
                $imgdestacada =  $pu_hight_line->postimagenes()->take(1)->first(); 
            ?>
            <a class="c-black" href="/publicacion-{{str_slug($getdestacados->title)}}/{{$getdestacados->id}}">
              <div class="col-md-14   col-sm-4 col-xs-12" style="margin-bottom:1rem!important;">
                  <div class="col-item sinpadding col-md-12 col-xs-12 efectoproducto">
                      
                      <div class="photo sinpadding col-md-3 col-sm-12 col-xs-4 height_239px-table">
                          <img src="{{Voyager::get_image($imgdestacada->imagen, 'medium', $imgdestacada->storage)}}"  class="img-responsive max-height-100 " alt="{{$getdestacados->title}}" />
                      </div>

                      <div class="col-md-9 col-sm-9 sinpadding">
                        <div class="col-md-12 col-sm-12 sinpadding ">
                            <div class="col-md-12 col-sm-12 sinpadding ">
                              <div class="col-md-12">
                                <h5 class="c-black">{{$getdestacados->title}}</h5>
                              </div>
                              @if($getdestacados->descuentos)
                                <div class="col-md-4 sinpadding c-black">
                                  Antes <del><h6>$ {{$getdestacados->precios}}</h6></del>
                                </div>
                                <div class="col-md-6 sinpadding">
                                  <h5 style="color: #ff6a00;font-size: 15px!important;">Ahora ${{$pu_hight_line->returnDescuento($pu_hight_line->precios, $getdestacados->descuentos)}} <small> % {{$getdestacados->descuentos}} OFF</small></h5>
                                </div>
                              @else
                                <div class="col-md-6 sinpadding">
                                  <h5 style="color: #ff6a00;font-size: 15px!important;"> ${{$getdestacados->precios}}</h5>
                                </div>                        
                              @endif
                            </div>
                          
                        </div>
                  </div>
              </div>
            </a>
            </div>
           <!-- <a  href="/publicacion-{{str_slug($getdestacados->title)}}/{{$getdestacados->id}}">
              <div class="col-md-12 col-sm-4 col-xs-12   borderproductos sinpadding">
                <div class="col-md-3 col-sm-12 col-xs-3" style="padding: 4px;">
                  <img src="{{Voyager::get_image($imgdestacada->imagen, 'medium',$imgdestacada->storage)}}" alt="{{$getdestacados->title}}" class="img-responsive">
                </div>  
                <div class="col-md-9 col-sm-9 sinpadding">
                  <div class="col-md-12 col-sm-12 sinpadding ">
                      <div class="col-md-12 col-sm-12 sinpadding ">
                        <div class="col-md-12">
                          <h5 class="c-black">{{$getdestacados->title}}</h5>
                        </div>
                        @if($getdestacados->descuentos)
                          <div class="col-md-4 sinpadding c-black">
                            Antes <del><h6>$ {{$getdestacados->precios}}</h6></del>
                          </div>
                          <div class="col-md-6 sinpadding">
                            <h5 style="color: #ff6a00;font-size: 15px!important;">Ahora ${{$pu_hight_line->returnDescuento($pu_hight_line->precios, $getdestacados->descuentos)}} <small> % {{$getdestacados->descuentos}} OFF</small></h5>
                          </div>
                        @else
                          <div class="col-md-6 sinpadding">
                            <h5 style="color: #ff6a00;font-size: 15px!important;"> ${{$getdestacados->precios}}</h5>
                          </div>                        
                        @endif
                      </div>
                    
                  </div>
                </div>
              </div>
            </a> -->

          @endforeach
        </div>
      </div>
    @endif
    <!--End hightline-->
</div> */ ?>

@if($sliders->count() > 0)
@section('jsfooter')
<script type="text/javascript">
  $(function () {
        $("#{{$showSlider->id}}").addClass('active');
     });

</script>
@append
@endif
