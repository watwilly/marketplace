@extends('layouts.app')
<?php 
   $url = url()->full();
?>

@section('meta')
    <meta  name="title" content="{{$category->name}}" >
    <meta  name="description" content="@if($category->descripcion) {{$category->descripcion}} @else Publicaciones de {{$category->name}}  entra tenemos de todo @endif">
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:description content="@if($category->descripcion) {{$category->descripcion}} @else Publicaciones de {{$category->name}}  entra tenemos de todo @endif" >
    <meta  property=og:site_name content="{{$category->name}}" >
    <meta  name=keywords content="@if(is_null($category->parent_id)) @if($categorias)  @foreach($categorias as $keycat) {{$keycat["name"]}}, @endforeach @endif @else  {{$category->name}}, compra y vende, compras online, saldeello.com, usados Santo domingo @endif">
    <meta  name="author" content="saldeello.com">
    <meta  property=og:image content=" @if($category->imagenceo) https://www.saldeello.com/storage/{{$category->imagenceo}} @else  https://www.saldeello.com/storage/{{Voyager::setting('site.ogimage')}} @endif" >
    <title>{{$category->name}}</title>
@stop

@section('content')
<section class="min-height">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-3 p-0">
                @include("category.filter")
            </div>
            <div class="col-12 col-lg-8 col-xl-9 py-5">
                <div class="row gy-3 gx-2 justify-content-center">
                    <div class="col-12">
				  	@if(is_null($category->parent_id))
				  		<?php $prdcatname = $category->name; ?>
				  	@else
				  		<?php $cat_parent =  $category->get_parent()->first(); ?>
				  		<?php $prdcatname = $cat_parent->name; ?>
				  	@endif

                        <h2 class="text-center">{{$category->name}}</h2>
                    </div>
                    <?php $n1=1; ?>
					@foreach ($productos as  $post)
               	 		{{Voyager::h_listview($post["title"], $post["id"], $post["imagen"], $post["storage"], $post["precios"], 'small', $prdcatname, $post["condicion"])}}
                        @if($n1==4 && $h1)
                            <div class="col-11 col-sm-12 col-md-12 col-lg-12">
                                <a href="{{$h1->link}}" target="_blank"><img src="{{Voyager::get_image($h1->banner, null, 'storage')}}" class="img-fluid w-100"></a>
                            </div>
                        @endif
                        @if($n1==12 && $h2)
                            <div class="col-11 col-sm-12 col-md-12 col-lg-12">
                                <a href="{{$h2->link}}" target="_blank"><img src="{{Voyager::get_image($h2->banner, null, 'storage')}}" class="img-fluid w-100"></a>
                            </div>
                        @endif
                        <?php $n1++; ?>
                   @endforeach
                   <div class="col-12">
					<nav aria-label="Page navigation">
					  <ul class="pagination">
						    {{$render->render()}}
					  </ul>
					</nav>
                   </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('jsfooter')

<script>
    let priceShow = document.getElementById("price-show")
    let priceChange = document.getElementById("price-change")
    let filterContainer = document.getElementById("filter-container")

    priceShow.innerHTML = priceChange.value
    priceChange.oninput = function() {
        priceShow.innerHTML = this.value
    }

    window.onload = () => {
        if(window.innerWidth >= 992){
            filterContainer.classList.add("show")
        }
    }

	$('#price-change').change(function() {
		var xhttp = new XMLHttpRequest();
		var price = $(this).val();
		
		xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
	        	window.location = "";
		    }
		};
		xhttp.open("GET", "/filtro-category?argument=price_rangue&max_price="+price, true);
		xhttp.send();
	});

    function orderatribute(o) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
	        	window.location = "";
		    }
		};
		xhttp.open("GET", "/filtro-category?argument=catOrden&atribute="+o, true);
		xhttp.send();
    }

</script>
@append

@endsection