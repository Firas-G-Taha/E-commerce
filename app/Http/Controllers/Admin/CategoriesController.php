<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class CategoriesController extends Controller
{

    public function index(){
    //    dd(1);
    
        $categories = Category::all();
        return view('admin/categories.index',[
            'categories' => $categories,
        ]);
    }
    public function redirectToIndex(){
        return redirect('admin/categories');
    }


    public function create()
    {
        return view('admin/categories.create');
    }



    public function store(Request $request){
        $request->validate([
           // 'name' => new Uppercase,
           'description' => 'required',
           'title' => 'required|unique:categories|alpha',
           'image' => 'required|mimes:png,jpg,jpeg|max:5048',
       ]);
       $newImageName = time() . '-' . $request->title . '.' .
       $request->image->extension();

       $request->image->move(public_path('storage\images\categories'),$newImageName);
       $category = Category::create([
           'description' => $request->input('description'),
           'title' => $request->input('title'),
           'important' => $request->has('important'),
           'image' => $newImageName,
       ]);
       return redirect('admin/categories');
   }

   public function show($id){
       $category = Category::find($id);
       $subcategories = $category->subCategories;
       return view('categories.show' , [
           'category' => $category,
            'subcategories' => $subcategories,
       ]);
   }
   public function edit($id)
   {

    // ************************ //
       $category = Category::find($id);
       return view('admin/categories.edit',[
           'category' => $category,
       ]);
   }

   public function update(Request $request, $id){
    $request->validate([
       // 'name' => new Uppercase,
       'title' => 'required|alpha',
       'image' => 'required|mimes:png,jpg,jpeg|max:5048',
   ]);

   $newImageName = time() . '-' . $request->input('title') . '.' .
   $request->image->extension();

   $request->image->move(public_path('storage/images/categories/'),$newImageName);
   $category = Category::where('id',$id)->update([
       'title' => $request->input('title'),
       'image' => $newImageName,
       'important' => $request->has('important'),
   ]);
   return redirect('/admin/categories');
    }
    public function destroy($id)
    {
         Category::where('id',$id)->first()->delete() ;
      return redirect('/admin/categories');
    }
}