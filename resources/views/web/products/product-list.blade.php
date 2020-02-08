<div class="row">
@foreach ($products as $product)
        <div class="col-md-4 mt-5">
            <div class="card p-5 card-products">
                <h3 style="font-size:medium">{{substr($product->title,0,150)}}</h3>
                @foreach ($product->images as $image)
                    <img src="{{env('AWS_URL')}}{{$image->link}}" width="100%"  alt="{{substr($product->title,0,120)}}" title="{{ substr($product->title,0,120)}}">
                @endforeach
                    <a href="{{route('product-view',$product->hash)}}" class="col-md-12 text-center">
                        Más información
                    </a>
                    @if (!empty($product->prices)
                        @foreach ($product->prices as $price)

                            @if ($price->price > 0.00)

                            <h2 class="text-center">{{$price->price}} €</h2>

                            @endif

                        @endforeach
                    @endif
                
                    <a alt="Comprar {{substr($product->title,0,120)}}" title=" Comprar {{ substr($product->title,0,120)}}" class="col-md-12 text-center" target="_blank" href="https://www.amazon.es/gp/product/{{$product->sku}}/ref=as_li_ss_tl?pf_rd_p=17a988a6-15ad-46df-8d9f-8365d36240ce&pf_rd_r=6XBGH18821MAEHEYZMCH&tag=lalupadesherlockcom-21&">
                        <button class="btn btn-success btn-lg">Comprar</button>
                    </a>
                        <p class="text-center">Precio verificado el:<br> {{ date('d-m-Y H:i', strtotime($price->updated_at)) }}</p>
                
            </div>
        </div>
@endforeach
</div>
<div class="row text-center">
{{ $products->links() }}
</div>