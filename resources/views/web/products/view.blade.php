@extends('layouts.web')

@section('title',"$product->title")
@section('description',"Comprar $product->title")

@section('content')

        <div class='col-md-6 pt-5' style="background:#FFF">
            @foreach ($product->images as $image)
                <img src="{{env('AWS_URL')}}{{$image->link}}" width="100%"  alt="Ofertas {{substr($product->title,0,120)}}" title="Ofertas {{ substr($product->title,0,120)}}">
            @endforeach
        </div>

        <div class="col-md-6 pt-5" style="background:#FFF">
            <h1 style="font-size:large">{{$product->title}}</h1>
            <div class="text-center mt-5 mb-5">
                @foreach ($product->prices as $price)

                    @if ($price->price > 0.00)

                    <h2 class="text-center mt-3 mb-3">{{$price->price}} €</h2>
                    <p class="text-center">Precio verificado el: {{date('d-m-Y H:i', strtotime($price->updated_at))}}</p>
                    
                    <a class="col-md-12 text-center" target="_blank" href="https://www.amazon.es/gp/product/{{$product->sku}}/ref=as_li_ss_tl?pf_rd_p=17a988a6-15ad-46df-8d9f-8365d36240ce&pf_rd_r=6XBGH18821MAEHEYZMCH&tag=lalupadesherlockcom-21&">
                        <button class="btn btn-success btn-lg btn-block"  alt="Comprar {{substr($product->title,0,120)}}" title="Comprar {{ substr($product->title,0,120)}}">Comprar en Amazon</button>
                    </a>

                    @else 
                        <h2 class="text-center">Consultar precio</h2>   
                        <a class="col-md-12 text-center" target="_blank" href="https://www.amazon.es/gp/product/{{$product->sku}}/ref=as_li_ss_tl?pf_rd_p=17a988a6-15ad-46df-8d9f-8365d36240ce&pf_rd_r=6XBGH18821MAEHEYZMCH&tag=lalupadesherlockcom-21&">
                            <button class="btn btn-success btn-lg btn-block"  alt="Comprar {{substr($product->title,0,120)}}" title="Comprar {{ substr($product->title,0,120)}}">Ver precio en Amazon</button>
                        </a>
                    @endif

                @endforeach
                 
            </div>
            <p style="text-align:justify">{{ str_replace('P.when("ReplacementPartsBulletLoader").execute(function(module){ module.initializeDPX(); })',"",$product->description) }}</p>
        </div>

    <div class='col-md-12 pl-5 pr-5' style='background:#fff;margin-top:50px;'>
        <h3 class=" text-center pt-5">Histórico de precios</h3>
        <hr>
        <table class="table table-bordered table-striped table-lg">
            <thead>
                <th>Fecha</th>
                <th>Precio</th>
            </thead>
            <tbody>
            @foreach ($product->prices as $price)
                <tr>
                    @if ($price->price > 0.00)

                    <td>{{date('d-m-Y H:i', strtotime($price->updated_at))}}</td> 
                    <td>{{$price->price}} € </td>

                    @else 
                    <td> No hay histórico de precios para este producto</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <div class="row p-5" style='background:#FFF;margin-top:50px;'>
        <div class='text-center col-md-12'>
            <h3 class='text-center'>Otros productos relacionados</h3>
            <hr>
        </div>
        @foreach ($similarProducts as $similarProduct)

        <div class="col-md-12 mt-5">

            <h3 style="font-size:medium"><b>{{substr($similarProduct->title,0,150)}}</b></h3>
            
        </div>
        
        <div class="col-md-3">
        @foreach ($similarProduct->images as $image)
            <img src="{{env('AWS_URL')}}{{$image->link}}" width="100%">
        @endforeach
        </div>
        <div class="col-md-9 text-center">
            <p style='font-size:small'>{{ substr($similarProduct->description,300,600)}}</p>
                @foreach ($similarProduct->prices as $price)

                    @if ($price->price > 0.00)

                        <h2 class="text-center text-orange">{{$price->price}} €</h2>
                    
                        <p class="text-center" style='font-size:small'>Precio verificado el: {{ date('d-m-Y H:i', strtotime($similarProduct->updated_at)) }}</p>
                    
                    @else 
                    
                        <h2 class="text-center text-orange">Consultar precio</h2>

                    @endif
                    

                @endforeach
                
                
                <a href="{{route('product-view',$similarProduct->hash)}}" class="col-md-12 text-center" title="Más información de {{substr($similarProduct->title,0,80)}}" alt="Más información de {{substr($similarProduct->title,0,80)}}">
                    <button class="btn btn-info btn-lg" title='Más información {{substr($similarProduct->title,0,90)}}' alt='Más información {{substr($similarProduct->title,0,90)}}'>Más información</button>
                </a>
                <a class="col-md-12 text-center" target="_blank" href="https://www.amazon.es/gp/product/{{$similarProduct->sku}}/ref=as_li_ss_tl?pf_rd_p=17a988a6-15ad-46df-8d9f-8365d36240ce&pf_rd_r=6XBGH18821MAEHEYZMCH&tag=lalupadesherlockcom-21&">
                    <button class="btn btn-success btn-lg" title='Comprar {{substr($similarProduct->title,0,80)}}' alt='Comprar {{substr($similarProduct->title,0,80)}}'>Comprar</button>
                </a>
        </div>


        @endforeach
    </div>


@endsection