<?php

namespace App\Http\Controllers\Stores;
use App\Http\Controllers\Controller;

use Revolution\Amazon\ProductAdvertising\Facades\AmazonProduct;

use Goutte\Client;

use App\ImportProduct;
use App\Product;
use App\Import;
use App\ProductImage;
use App\ImportResponse;
use Illuminate\Support\Facades\Storage;

class AmazonController extends Controller
{
    public function __construct(){
        
    }
    
    
    public function getProducts($hash){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://www.amazon.es/s?rh=n%253A667049031%252Cn%253A%2521667050031%252Cn%253A938010031&page=4",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded"
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
            die;
        
        
        
            $import = new Import;
            $import = $import->getByHash($hash);
            
            $node = $import->node;
            $page = $import->page;
        
            $url = 'https://www.amazon.es/s?rh=n%3A667049031%2Cn%3A%21667050031%2Cn%3A';
            $web = $url.$node."&page=".$page; 
            $client = new Client();
            $client->setHeader('User-Agent', "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:57.0) Gecko/20100101 Firefox/57.0");
            $client->setHeader('Cache-Control:', 'no-cache');
            $client->setServerParameter('HTTP_USER_AGENT', "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:57.0) Gecko/20100101 Firefox/57.0");
            $crawler = $client->request('GET',"$web");
            
            dd($crawler);
            
            $importResponse = new ImportResponse;
            $importResponse->import_id = $import->id;
            $importResponse->response = json_encode($crawler);
            $importResponse->status = 1;
            $importResponse->hash = sha1($import->id.rand().date('dmYHis'));
            $importResponse->save();
            
            $crawler->filter('div.s-result-item')->each(function ($title) { 
                
                $importProductCheck = new ImportProduct;
                $importProductCheck = $importProductCheck->getBySKU($title->attr('data-asin'));
                
                echo 'producto: '.$title->attr('data-asin');
                
                if (empty($importProductCheck->id)){
                
                    $importProduct = new ImportProduct;

                    $importProduct->import_id = 1; 
                    $importProduct->category_id = 1; 
                    $importProduct->sku = $title->attr('data-asin'); 
                    $importProduct->link = 'https://www.amazon.es/dp/'.$importProduct->sku;
                    $importProduct->hash = sha1($importProduct->sku);

                    $importProduct->save();
                    
                    
                    
                }
                
                        

            });
            
            
            
            $importUpdate = new Import;
            $importUpdate->updatePageByImportHash($import->hash);
            
            return redirect('home');
        
    }
    
    public function getProductDetails($hash){
        
                    $importProduct = new ImportProduct;
                    $importProductData = $importProduct->getByHash($hash);
                    
                    $product = new Product;
                    $productData = $product->getBySKU($importProductData->sku);
                    
                    
                    if (empty($productData->id)){
                        
                        $web = 'https://www.amazon.es/dp/'.$importProductData->sku.'/';
                        $client = new Client();
                        $client->setHeader('User-Agent', "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36");
                        $crawler = $client->request('GET',"$web");

                        $productTitle = $crawler->filter('span#productTitle')->each(function ($title) { 

                                return array( 'title' => $title->text() );

                        });
                        
                        $productImg = $crawler->filter('img#landingImage')->each(function ($title) { 

                                return array( 'src' => $title->attr('src') );

                        });
                        
                        $productDescription = $crawler->filter('div#feature-bullets')->each(function ($title) { 

                                return array( 'text' => $title->text() );

                        });
                        
                        
                        
                        $product = new Product;
                        $product->sku = $importProductData->sku; 
                        $product->title = trim($productTitle[0]['title']);
                        $product->description = trim($productDescription[0]['text']); 
                        $product->category_id = $importProductData->category_id;
                        $product->hash = sha1($importProductData->sku);
                        
                        $product->save();
                        
                        $image = preg_replace('#data:image/[^;]+;base64,#', '', $productImg[0]['src']);
                        $file_path = 'products/'.$product->hash.'.jpg';
                        Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
                        
                        $image = new ProductImage;
                        $image->title = $productTitle[0]['title'];
                        $image->link = $file_path;
                        $image->product_id = $product->id;
                        $image->hash = sha1($image->link.$image->product_id);
                        $image->save();
                        
                        
                        $importProduct->desactivateByHash($hash);
                        
                        return redirect('home');
                    }
                    else {
                        $importProduct->desactivateByHash($hash);
                        return redirect('home');
                    }
            
    }
}

