@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    	.select-multiple {
    		min-height: 180px;
    	}

    	.talles option {
    		padding: 5px;
    		margin: 0;
    		border-bottom: 1px solid #ddd;
    	}
    	.colores option {
    		width: 100%; 
    		height: 25px; 
    		display: block;
    		padding: 5px;
    		margin: 2px 0;
    		border: 1px solid #eee;
    	}
        .atributos  ul {
            list-style: none;
            border: 1px solid #ddd;
            padding: 0;
            margin: 0;
        }
        .atributos  ul .talles, .atributos  ul .colores {
            padding: 0;
            margin: 0;
        }
        .atributos  ul li {
            border-bottom: 1px solid #ddd;
            padding: 7px 10px;
            display: flex;
        }
        .atributos  ul li:last-child {
            border-bottom: 0;
        }
        .atributos  ul .talles li {
            border-right: 1px solid #ddd;
        }
        .atributos  ul li span {
            display: block;
            width: 90%
        }
        .atributos  ul li a {
            display: block;
            width: 10%;
            text-align: center;
        }
        .atributos  ul li a i {
            display: inline-flex;
            width: 15px;
            height: 15px;
            justify-content: center;
            align-items: center;
            color: #fff;
            background: #c90404;
            border-radius: 50%;
        }
        .atributos  ul li.small {
            font-weight: 600;
            color: #444;
        }
    </style>
@stop



@section('content')

<h1 class="page-title">Atributos de la Publicacion</h1>
<div class="page-content container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-bordered">
				<form role="form"
                            class="form-edit-add"
                            action="/admin/posts/setAtributo"
                            method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}


					<div class="panel-body">
						<div class="row">
                        <input type="hidden" name="posts_id" value="{{$post->id}}">
							<div class="col-md-6">
								<div class="panel-heading">
									<h3 class="panel-title">Talles</h3>
								</div>
								<select name="talle_id" id="talle_id" class="form-control talles">
                                    <option value="" selected>Seleccione un Talle</option>

                                    @foreach($talles as $talle)
                                        <option value="{{$talle->id}}">{{$talle->talle}}</option>
                                    @endforeach
								</select>
							</div>

							<div class="col-md-6">
								<div class="panel-heading">
									<h3 class="panel-title">Colores</h3>
								</div>
								<select  name="colores_id" id="colores_id" class="form-control colores">
                                    <option value="" selected>Seleccione un Color</option>
									@foreach($colores as $color)
                                    <option value="{{$color->id}}" style="background-color: {{$color->color}};"></option>
                                    @endforeach
								</select>
							</div>
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary save">Guardar</button>
							</div>
						</div>
					</div>
				</form>

                <div class="atributos">
                    <div class="panel-body">
                        <div class="panel-heading">
                            <h3 class="panel-title">Atributos Seleccionados</h3>
                            <ul class="tabla-atributos row">
                               
                                <div class="col-md-6 talles">
                                    <li class="small">Talles</li>
                                    @foreach($post->poststalles()->get() as $p_talle)
                                        <?php
                                            $get_pTalle = $p_talle->talles()->first();
                                        ?>
                                        <li><span>{{$get_pTalle->talle}}</span><a href="/admin/atributo-delete/{{$p_talle->id}}/talle/{{$post->id}}"><i class="voyager-x"></i></a></li>
                                    @endforeach
                                </div>

                                <div class="col-md-6 colores">
                                    <li class="small">Colores</li>
                                    @foreach($post->postscolores()->get() as $p_color )
                                        <?php
                                            $get_pColor = $p_color->colores()->first();
                                        ?>
                                         <li><span id="{{$color->id}}" style="background-color: {{$get_pColor->color}}; color:white"></span><a href="/admin/atributo-delete/{{$p_color->id}}/color/{{$post->id}}"><i class="voyager-x"></i></a></li>
                                    @endforeach
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
@stop

@section('javascript')
    <script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
    <script src="{{ voyager_asset('lib/js/ace/ace.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_ace_editor.js') }}"></script>
    <script src="{{ voyager_asset('js/slugify.js') }}"></script>


@stop
