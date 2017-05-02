@extends('layouts.master')

@section('title')
	Laravel Shopping Cart
@endsection


@section('content')

@foreach ($p as $product) 
 
 		<div class="row">
 		
   <div class="col-xs-4 item-photo">
                    <img src="{{$product->imagePath}}" alt="..." width="200" height="300">
                </div>
                <div class="col-xs-5" style="border:0px solid gray">
                    <!-- Datos del vendedor y titulo del producto -->
                    <h3>{{$product->title}}</h3>    
                    <!-- <h5 style="color:#337ab7">vendido por <a href="#">Samsung</a> · <small style="color:#337ab7">(5054 ventas)</small></h5> -->

                    <!-- Precios -->
                    <!-- <h6 class="title-price"><small></small></h6> -->
                    <h3 style="margin-top:0px;">₹{{$product->price}}</h3>

                    <!-- Detalles especificos del producto -->
                    <div class="section">
                        <h6 class="title-attr" style="margin-top:15px;" ><small></small></h6>                    
                        <div>
                            <div class="attr" style="width:25px;background:#5a5a5a;"></div>
                            <div class="attr" style="width:25px;background:white;"></div>
                        </div>
                    </div>
                    <div class="section" style="padding-bottom:5px;">
                        <h6 class="title-attr"><small></small></h6>                    
                        <div>
                            <div class="attr2">{{$product->description}}</div>
                            
                        </div>
                    </div>   
                    <div class="section" style="padding-bottom:20px;">
                       <!--  <h6 class="title-attr"><small></small></h6>  -->                   
                        <!-- <div>
                            <div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
                            <input value="1" />
                            <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
                        </div> -->
                    </div>                

                    <!-- Botones de compra -->
                    <div class="section" style="padding-bottom:20px;">
                     
                        <h6> <a href="{{route('product.addToCart',['id' => $product->id])}}" class="btn btn-success pull-right" role="button">Add to Cart</a></h6>
                    </div>                                        
                </div>                              
 @endforeach
                <div class="col-xs-9">
                    <div style="width:100%;border-top:0px solid silver">
                            <p style="padding:15px;">
                        <div class="container pb-cmnt-container">
                             <div class="row">
                                <div class="col-md-6 col-md-offset-3">
             
                                     <div class="panel panel-info">
                                        <div class="panel-body">
                                            <form class="form-horizontal" role="form" method="post" action="{{ url('/createseller') }}">
                                                {{ csrf_field() }}
                                            <textarea placeholder="Write your comment here!" class="pb-cmnt-textarea" rows="5" cols="60" name="com" id="com" style="resize: none;"></textarea>
                                    <button class="btn btn-primary pull-bottom" >Comments</button>
                             </form>
                             </div>
                             </div>
                             </div>
                             </div>
                             </div>
                        </div>
                </div>		
	</div>
@endsection



