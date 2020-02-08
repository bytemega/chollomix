@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Productos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                     <table class="table-responsive table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Opciones</th>
                        </tr>
                        @foreach ($products as $product)
                            
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->title}}</td>
                                <td>{{$product->category_id}}</td>
                                <td width="130px">
                                    <button class="btn btn-primary"><i class="fa fa-eye"></i></button>
                                    <button class="btn btn-info"><i class="fa fa-edit"></i></button>
                                </td>
                            </tr>
                   
                        @endforeach
                        
                    </table>
                    {{ $products->links() }}
                    
                </div>
            </div>
        </div>
    </div>
    
    <br/>
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Importaciones</div>

                <div class="card-body">
                    
                     <table class=" table-condensed table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Página</th>
                            <th>Categoría</th>
                            <th>Productos</th>
                            <th>Opciones</th>
                        </tr>
                        @foreach ($imports as $import)
                            
                            <tr>
                                <td>{{$import->id}}</td>
                                <td>{{$import->name}}</td>
                                <td>{{$import->page}}</td>
                                <td>{{$import->category_id}}</td>
                                <td>{{count($import->products)}}</td>
                                <td>
                                    <a href="{{route('amazon.getProducts',$import->hash)}}">
                                        <button class="btn btn-success"><i class="fa fa-plus"></i> Importar SKU</button>
                                    </a>
                                </td>
                            </tr>
                   
                        @endforeach
                        
                    </table>
                    {{ $imports->links() }}
                    
                </div>
            </div>
        </div>
    </div>
    
    <br/>
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Importar productos</div>
                
                
                <div class="col-md-12">
                    <button type="button" class="btn btn-info" onclick="importProducts()">Importación automática</button>
                </div>

                <div class="card-body">
                    
                     <table class=" table table-striped table-condensed">
                        <tr>
                            <th>ID</th>
                            <th>Importación</th>
                            <th>Categoría</th>
                            <th>SKU</th>
                            <th>Actualizado</th>
                            <th>Link</th>
                            <th>Opciones</th>
                        </tr>
                        @foreach ($importsProducts as $importProduct)
                            <tr>
                                <td>{{$importProduct->id}}</td>
                                <td>{{$importProduct->import_id}}</td>
                                <td>{{$importProduct->category_id}}</td>
                                <td>{{$importProduct->sku}}</td>
                                <td>{{ date('d-m-Y H:i', strtotime($importProduct->updated_at)) }}</td>
                                <td>
                                    <a href="{{$importProduct->link}}" target="_blank"><i class="fa fa-external-link"></i></a>
                                </td>
                                <td>
                                    @if ($importProduct->active == 1)
                                    
                                    <a href="{{route('amazon.importProduct',$importProduct->hash)}}">
                                        <button class="btn btn-success"><i class="fa fa-save"></i> Importar </button>
                                    </a>
                                        
                                    @else 
                                    
                                        <button class="btn btn-warning"><i class="fa fa-money"></i> Actualizar precio</button>
                                    
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        
                    </table>
                    {{ $importsProducts->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function wait(ms){
   var start = new Date().getTime();
   var end = start;
   while(end < start + ms) {
     end = new Date().getTime();
  }
}

function importProducts(){
    console.log('demo');
    $.ajax({
        type: "GET",
        url: "{{route('amazon.getNextImport')}}",
        success: function(data){
            var data = JSON.parse(data);
            console.log(data);
            data.forEach(function(product){
                console.log(product.hash)
                var url = "http://192.168.64.2/affiliate-portal/public/amazon/getProductDetails/"+product.hash;
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data){
                        console.log('Importado');
                    },
                    error: console.log('error'),
                });
                wait(5000);  
            });
            
        },
    });
}


</script>
@endsection
