@extends('layouts.app')

@section('meta')
    <title>Carrito de Compras</title>
@stop

@section('content')
<section class="min-height">
    <div class="container mt-4">
        <h2 class="text-center mb-5">Carrito de compras</h2>

        @if($carrito&&$carrito["carrito"])  
            @if($carrito["items"]->count()>0)
                <?php 
                    $total=0;
                ?>
                @foreach($carrito["items"] as $items)
                    <?php 
                        $item=$items->postId()->select("posts.id","title","precios","categories.name")
                        ->join('categories', 'posts.category_id', '=', 'categories.id')->where("status","PUBLISHED")->first();
                    ?>

                    @if($item)
                        <?php 
                            $img = $item->postimagenes()->limit(1)->first();
                            $subtotal = $item->precios * $items->cantidad;
                        ?>
                        <div class="card mb-3 shadow-sm">
                            <div class="container-fluid">
                                <div class="row gy-3 gy-lg-0 align-items-center justify-content-center">
                                    <div class="col-2 col-lg-1 p-1 p-lg-3 d-flex justify-content-center align-items-start">
                                        <a href="/vtucuman-{{$item->id}}/{{str_slug($item->name,'-')}}/{{str_slug($item->title)}}">
                                            <img src="{{voyager::get_image($img->imagen,'small',$img->storage)}}" class="rounded-circle img-fluid" alt="...">
                                        </a>
                                    </div>
                                    <div class="col-10 col-lg-5">
                                        <a href="posts.show.php" class="link-dark">
                                            <h5 class="card-title text-truncate">{{str_limit($item->title,57)}}</h5>
                                        </a>
                                    </div>
                                    <div class="col-9 col-md-4 col-lg-2">
                                        
                                            <?php /* <h6 class="text-success section__title fw-bold">
                                                <?php echo $disccount ?>% OFF
                                                <small class="text-decoration-line-through text-muted">$<?php echo $price ?></small>
                                            </h6>
                                            <h6 class="section__title fw-bold">
                                                ARS $<?php echo $final ?>
                                            </h6> */ ?>
                                     
                                            <h6 class="section__title fw-bold">
                                                ARS ${{$item->precios}}
                                            </h6>
                                        
                                    </div>
                                    <div class="col-3 col-md-2 col-lg-1">
                                        <select id="cantidad{{$items->id}}" class="form-control" onchange="updateQuantiti({{$items->id}});" >
                                            <option value="1"  @if($items->cantidad==1) selected @endif>1</option>
                                            <option value="2" @if($items->cantidad==2) selected @endif>2</option>
                                            <option value="3" @if($items->cantidad==3) selected @endif>3</option>
                                            <option value="4" @if($items->cantidad==4) selected @endif>4</option>
                                            <option value="5" @if($items->cantidad==5) selected @endif>5</option>
                                            <option value="6" @if($items->cantidad==6) selected @endif>6</option>
                                            <option value="7" @if($items->cantidad==7) selected @endif>7</option>
                                            <option value="8" @if($items->cantidad==8) selected @endif>8</option>
                                        </select>
                                         
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="d-flex align-items-center">
                                            <h6>Sub-total:</h6>
                                            <h5 class="section__title ms-auto fw-bold text-center">
                                                ARS ${{$subtotal}}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md- col-lg-12 p-0">
                                        <div class="card-footer d-flex justify-content-end border-0">
                                            <a href="/checkout/{{$items->id}}/pre-payment" class="my-0 ms-0 me-4 section__link section__link--primary">Comprar</a>
                                            <a href="/carrito-items-{{$items->id}}-delete" class="my-0 section__link section__link--danger">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $total+=$subtotal; ?>
                    @endif
                @endforeach
        

                <hr class="my-4">

                <div class="p-3 mb-4 bg-dark rounded text-light">
                    <div class="container-fluid">
                        <div class="row g-2 justify-content-end align-items-center">
                            <?php /*<div class="col-3 offset-md-6 offset-lg-7">
                                <h6 class="text-end mx-2">Envío</h6>
                            </div>
                            <div class="col-9 col-md-3 col-lg-2">
                                <h5 class="section__title fw-bold">
                                    ARS $<?php echo $ship = 250; ?>
                                </h5>
                            </div> */ ?>
                            <div class="col-3 offset-md-6 offset-lg-7">
                                <h6 class="text-end mx-2">Total</h6>
                            </div>
                            <div class="col-9 col-md-3 col-lg-2">
                                <h5 class="section__title fw-bold">
                                    ARS ${{$total}}
                                </h5>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-6">
                                <a href="#" class="w-100 mx-auto btn btn-primary">
                                    Haga click en comprar para pagar cada producto
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                        <div class="alert alert-success text-center">
                <p>No agregaste producto a tu carrito de compras</p> 
                <a href="/" class="btn btn-success">Ir de compras</a></div>
            @endif
        @else
            <div class="alert alert-success text-center">
                <p>No agregaste producto a tu carrito de compras</p> 
                <a href="/" class="btn btn-success">Ir de compras</a></div>
        @endif
    </div>
</section>

@endsection

@section('jsheader')
 

@append

@section('jsfooter')
<script>

    function updateQuantiti(item_id) {
        cantidad=$("#cantidad"+item_id).val();
       
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response["response"]==true){
                    location.reload();
                }
            }
        };
        xhttp.open("GET", "/carrito-update-quantity/"+cantidad+"/"+item_id, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
    }


              
    
</script>
@append

