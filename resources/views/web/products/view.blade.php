@extends('layouts.web')

@section('title',"$product->title")
@section('description',"Comprar $product->title")

@section('content')
<div class="row mt-5">
    <div class="col-md-12">
    <h1 style="font-size:large">{{$product->title}}</h1>
    </div>
</div>
<div class="row">
    <div class='col-md-6'>
        @foreach ($product->images as $image)
            <img src="{{env('AWS_URL')}}{{$image->link}}" width="100%"  alt="Ofertas {{substr($product->title,0,120)}}" title="Ofertas {{ substr($product->title,0,120)}}">
        @endforeach
    </div>
    <div class='col-md-6'>
        <div class="text-center mt-5 mb-5">
            @foreach ($product->prices as $price)

                @if ($price->price > 0.00)

                <h2 class="text-center mt-3 mb-3">{{$price->price}} €</h2>
                <p class="text-center">Precio verificado el: {{date('d-m-Y H:i', strtotime($price->updated_at))}}</p>

                @endif

            @endforeach
             <a class="col-md-12 text-center" target="_blank" href="https://www.amazon.es/gp/product/{{$product->sku}}/ref=as_li_ss_tl?pf_rd_p=17a988a6-15ad-46df-8d9f-8365d36240ce&pf_rd_r=6XBGH18821MAEHEYZMCH&tag=lalupadesherlockcom-21&">
                <button class="btn btn-success btn-lg btn-block"  alt="Comprar {{substr($product->title,0,120)}}" title="Comprar {{ substr($product->title,0,120)}}">Comprar</button>
            </a>
        </div>
        <p style="text-align:justify">{{$product->description}}</p>
    </div>
</div>

<div class="row">
    <h3>Otros productos relacionados</h3>
    @foreach ($similarProducts as $similarProduct)
    
    <div class="col-md-12 mt-5">
        
                    <h3 style="font-size:medium">{{substr($product->title,0,150)}}</h3>
    </div>
                <div class="col-md-3">
                @foreach ($similarProduct->images as $image)
                    <img src="{{env('AWS_URL')}}{{$image->link}}" width="100%">
                @endforeach
                </div>
                <div class="col-md-9 text-center">
                    <a href="{{route('product-view',$product->hash)}}" class="col-md-12 text-center">
                        Más información
                    </a>
                    <p>{{ substr($similarProduct->description,300,600)}}</p>
                        @foreach ($similarProduct->prices as $price)

                            @if ($price->price > 0.00)

                            <h2 class="text-center">{{$price->price}} €</h2>

                            @endif

                        @endforeach

                        <a class="col-md-12 text-center" target="_blank" href="https://www.amazon.es/gp/product/{{$product->sku}}/ref=as_li_ss_tl?pf_rd_p=17a988a6-15ad-46df-8d9f-8365d36240ce&pf_rd_r=6XBGH18821MAEHEYZMCH&tag=lalupadesherlockcom-21&">
                            <button class="btn btn-success btn-lg">Comprar</button>
                        </a>
                        <p class="text-center">Precio verificado el:<br> {{ date('d-m-Y H:i', strtotime($price->updated_at)) }}</p>
                </div>
                
    
    @endforeach
</div>


@endsection