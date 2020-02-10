<div class="row" style='background:#FFF;margin-top:50px;'>
    <div class='col-md-12 text-center pt-3'>
        
        <h1>Ofertas y chollos destacados</h1>
        <hr>
        
    </div>
@foreach ($products as $product)

        <div class="col-md-3 mt-5" id='products-list'>
            <div class="card pt-2 pb-2  card-products">
                <a href="{{route('product-view',$product->hash)}}" class="col-md-12 text-center" title="Más información de {{substr($product->title,0,80)}}" alt="Más información de {{substr($product->title,0,80)}}">
                    <h3 style="font-size:small">{{substr($product->title,0,150)}}</h3>
                </a>
                @foreach ($product->images as $image)
                    <img src="{{env('AWS_URL')}}{{$image->link}}" width="100%"  alt="{{substr($product->title,0,120)}}" title="{{ substr($product->title,0,120)}}">
                @endforeach
                    <a href="{{route('product-view',$product->hash)}}" class="col-md-12 text-center" title="Más información de {{substr($product->title,0,80)}}" alt="Más información de {{substr($product->title,0,80)}}">
                        Más información
                    </a>
                    @if (!empty($product->prices))
                        @foreach ($product->prices as $price)

                            @if ($price->price > 0.00)

                            <h2 class="text-center">{{$price->price}} €</h2>

                            @endif

                        @endforeach
                    @endif
                
                    <a alt="Comprar {{substr($product->title,0,120)}}" title=" Comprar {{ substr($product->title,0,120)}}" class="col-md-12 text-center" target="_blank" href="https://www.amazon.es/gp/product/{{$product->sku}}/ref=as_li_ss_tl?pf_rd_p=17a988a6-15ad-46df-8d9f-8365d36240ce&pf_rd_r=6XBGH18821MAEHEYZMCH&tag=lalupadesherlockcom-21&">
                        <button class="btn btn-success">Comprar</button>
                    </a>
                        @if (!empty($price))
                        <p class="text-center">Precio verificado el:<br> {{ date('d-m-Y H:i', strtotime($price->updated_at)) }}</p>
                        @endif
                
            </div>
        </div>
    
    
@endforeach
</div>
<div class="row text-center">
{{ $products->links() }}
</div>