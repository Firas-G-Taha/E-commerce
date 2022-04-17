<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\SubCategory;

class ProductController extends Controller
{
    
    public function index(){
        //    dd(1);
            $products = Product::all();
            return view('admin/products.index',[
                'products' => $products,
            ]);

        }
    
    
        public function create()
        {
            $categories = Category::all();
            $subCategories = $categories[0]->subcategories;     
            return view('admin/products.create',[
                'categories' => $categories,
                'subCategories' => $subCategories,
            ]);
        }
        public function passingSubCategoriesToCreate(){
            
            $subCategories = SubCategory::where('category_id' ,Request()->post('category_id'))->get();
            $output ='';
            foreach($subCategories as $subcategory){
                $output .= "<option value=$subcategory->id> $subcategory->title</option>";
            }
            return $output;
        }
        

    
        public function store(Request $request){
            $request->validate([
               // 'name' => new Uppercase,
               'category_id' => 'required|integer',
               'sub_category_id' => 'required|integer',
               'name' => 'required|unique:products|regex:/^[a-zA-Z0-9\s]+$/',
               'description' => 'required',
               'price' => 'required|integer',
               'quantity' => 'required|integer',
               'image' => 'required|mimes:png,jpg,jpeg|max:5048',
           ]);
           $newImageName = time() . '-' . $request->title . '.' .
           $request->image->extension();
           $request->image->move(public_path('storage\images\products'),$newImageName);
           $product = Product::create([
               'name' => $request->input('name'),
               'description' => $request->input('description'),
               'available' => $request->has('available'),
               'featured' => $request->has('featured'),
               'price' => $request->input('price'),
               'quantity' => $request->input('quantity'),
               'sub_category_id' => $request->input('sub_category_id'),
               'category_id' => $request->input('category_id'),
               'image' => $newImageName,
           ]);
           return redirect('admin/products');
       }
    
       public function show($id){
           $product = Product::find($id);

           return view('/products.show',[
               'adminproduct' => $product
           ]);
       }
       public function edit($id)
       {
        // ************************ //
        $product = Product::find($id);
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin/products.edit',[
            'product' => $product,
            'categories' => $categories,
            'subCategories' => $subCategories,
        ]);
       }
    
       public function update(Request $request, $id){
           $request->validate([
            // 'name' => new Uppercase,
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'available' => '',
            'image' => 'required|image|max:5048',
        ]);
        
        $newImageName = time() . '-' . $request->name . '.' .
        $request->image->extension();
        $request->image->move(public_path('storage\images\products'),$newImageName);
        $product = Product::where('id',$id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'available' => $request->has('available'),
               'featured' => $request->has('featured'),
               'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'sub_category_id' => $request->input('sub_category_id'),
            'category_id' => $request->input('category_id'),
            'image' => $newImageName,
        ]);
        if($request->images!=null){
            ProductImage::where('product_id',$id)->delete();
            foreach($request->images as $img){
                $newImageName = time() . rand(1,99999).'-' . $request->name . '.' .
                $img->extension();
                $img->move(public_path('storage\images\products'),$newImageName);
                ProductImage::create([
                    "product_id" => $id,
                    "image" => $newImageName
                ]);
            }
        }
        return redirect('admin/products');
        }
        

        public function destroy($id)
        {
            Product::where('id',$id)->first()->delete() ;
          return redirect('admin/products');
        }

        public function storeProductImage(Request $request,$id){
            $request->validate([
                // 'name' => new Uppercase,
                'image' => 'required|mimes:png,jpg,jpeg|max:5048',
            ]);
            $newImageName = time() . '-' . $request->title . '.' .
            $request->image->extension();
            $request->image->move(public_path('storage\images\products'),$newImageName);
            $product = ProductImage::create([
                'product_id' => $id,
                'image' => $newImageName,
            ]);
            return redirect('admin/products/'.$id);
        }

        public function deleteProductimage($id){
            ProductImage::where('id',$id)->first()->delete();
            return redirect('admin/products/'.$id);
        }
}
