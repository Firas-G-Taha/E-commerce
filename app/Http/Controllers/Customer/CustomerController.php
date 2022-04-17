<?php

namespace App\Http\Controllers\Customer;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Collection\updateExistingPivot;
use Illuminate\Support\Facades\DB;


use App\Models\ProductUser;
class CustomerController extends Controller
{

    
    public function index(){
        Auth::check() 
        ?$productsInCart = ProductUser::where('user_id',Auth::user()->id)->count()
        :$productsInCart = 0;

        $categories = Category::where('important',1)->get();
        $products = Product::where('featured',1)->get();
        $importantCategories = Category::where('important',1)->get();
        return view('/customers/index',[
            'productsInCart' => $productsInCart, 
            'importantCategories' => $importantCategories,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
    public function showCategories(){
        
        Auth::check() 
            ?$productsInCart = ProductUser::where('user_id',Auth::user()->id)->count()
            :$productsInCart = 0;

        $importantCategories = Category::where('important',1)->get();
        $categories = Category::all();
        
        return view('/customers/showcategories',[
            'productsInCart' => $productsInCart, 
            'importantCategories' => $importantCategories,
            'categories' => $categories
        ]);
    }
    public function showcategory($id){
        Auth::check() 
        ?$productsInCart = ProductUser::where('user_id',Auth::user()->id)->count()
        :$productsInCart = 0;

        $importantCategories = Category::where('important',1)->get();
        
        $category = Category::findOrFail($id);
        // dd($category->allProducts);
        return view('/customers/category',[
            'productsInCart' => $productsInCart, 
            'importantCategories' => $importantCategories,
            'category' => $category,    
            'products' => $category->products->where('available',1),    
        ]);

    }
    public function showSubCategoryProducts(){
        $subcategory_titel =  request()->post('subcategory_title');
        
        if($subcategory_titel == 'all'){
            // dd(Request()->post('cat'));
           $products = Product::where('category_id',Request()->post('category_id'))->where('available',1)->get(); 
        // = $subcategory->get()->first()->category->first();
        }
        else{
            // $products = SubCategory::where('title', $subcategory_titel)
            $products = SubCategory::where('title', $subcategory_titel)->
            first()->products->where('available',1) ;
        }
        $output ='';
        foreach($products as $product){
            $output .= "
                    <div class='product-container'>
                        <a href='/product/$product->id'>
                            <img src=". asset("/storage/images/products/$product->image")." '   alt='product image'>
                        </a>
                        <div class='product-text'>
                            <h1>$product->name</h1>
                            <div class='flex-row gap25px'>
                                <p>price: $product->price$</p>
                                <p>quantity: $product->quantity</p>
                            </div>
                        </div>
                        <form action='/addToCart/".$product->id."' method='post' class='input-button width100'>
                            <input type='number'  value=$product->price  name='price' hidden>
                            <input type='number'  value=1 name='quantity' min=0 max=$product->quantity class='text-input width100px'>
                            <button type='submit' class='form-btn'>Add To Cart</button>
                        </form>
                     </div>";
        }
        return $output;
    
    
    }
       
    public function showProduct($id){
        Auth::check() 
        ?$productsInCart = ProductUser::where('user_id',Auth::user()->id)->count()
        :$productsInCart = 0;

        $importantCategories = Category::where('important',1)->get();
        $product = Product::find($id);        
        
        return view('/customers/product',[
            'productsInCart' => $productsInCart, 
            'importantCategories' => $importantCategories,
            'product' => $product,
        ]);
    }
 public function addToCart(Request $request , $id){
    //  dd(10);
    $product = Product ::find($id);
    $incart = $product->users()->where('id', Auth::user()->id)->exists();
    
   
    $productQuantity = Product::find($id)->quantity;
    $request->validate([
        // 'name' => new Uppercase,
          'quantity' => 'required|numeric|max:{$productQuantity}|min:1',
    ]);
    
    if($incart){
        
        Auth::user()->products->find($id)->pivot->update(
        [
            'quantity' => $request->input('quantity'),
        ]
        );
        
    }else{
        $product_user = ProductUser::create([
           'user_id' => Auth::user()->id,
           'product_id' => $id,
           'quantity' => $request->input('quantity'),
           'price' => $request->input('price'),
        ]);
    }

    return redirect('category/'.Product::find($id)->category->id);
}
public function search(){
    $importantCategories = Category::where('important',1)->get();
    Auth::check() 
        ?$productsInCart = ProductUser::where('user_id',Auth::user()->id)->count()
        :$productsInCart = 0;

    $search = Request()->get('search');
    $search = trim($search);
    $search = str_replace('%20','%',$search);
    // $products = Product::where('name','LIKE','%'.$search."%")->orWhere('description','LIKE','%'.$search."%")->orderBy('id','DESC')->get();
    $products = Product::where('available',1)->where(function($query) use($search){
        $query->where('name','LIKE','%' . $search.'%')->orWhere('description','LIKE','%'.$search."%");
    })->orderBy('id','DESC')->get(); 
    return view('customers/search',[
        'productsInCart' => $productsInCart, 
        'products' => $products,
        'importantCategories' => $importantCategories,
    ]);
 }
 public function updateQuantity(){
            
    $cart = ProductUser::where('user_id',request()->post('user_id'))->where('product_id',request()->post('product_id'));
   
        $cart->update([
            'quantity' => request()->post('quantity'),
        ]);
        return  request()->post('user_id');
    
        }
 public function showCart(){ 
    Auth::check() 
    ?$productsInCart = ProductUser::where('user_id',Auth::user()->id)->count()
    :$productsInCart = 0;

    $importantCategories = Category::where('important',1)->get();
    $products = Auth::user()->products;
    $cartproducts = Auth::user()->cartProducts;
    foreach($cartproducts as $index => $cartproduct){
        $products[$index]->cartQuantity = $cartproduct->quantity;
    }    
    
    return view('/customers/showcart' , [
        'productsInCart' => $productsInCart, 
        'importantCategories' => $importantCategories,
        'products' => $products,

    ]);
 }
 

 public function deleteFromCart($id){

    Auth::user()->products->find($id)->pivot->delete();
    return redirect('customers/Cart');
 }

 public function checkOut(Request $request){
    
    $cartproducts = Auth::user()->cartProducts->sortBy('product_id'); // cart quantity
     $products = Auth::user()->products; //stock
   
    foreach($products as $index => $product){     
        $product->update([
            'quantity' => $product->quantity - $cartproducts[$index]->quantity,
        ]);
    }
   
    // dd(ProductUser::where('user_id',Auth::user()->id));
    ProductUser::where('user_id',Auth::user()->id)->delete();
    return redirect('/');
    
 }


}
