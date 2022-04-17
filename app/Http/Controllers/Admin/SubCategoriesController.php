<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoriesController extends Controller
{
   

    public function index(){
        $subcategories = SubCategory::all();
     return view('admin/subcategories.index',[
         'subcategories' => $subcategories,
     ]);
    }

    public function create(){
        $categories = Category::all();
        return view('admin/subcategories.create',[
            'categories' => $categories,
        ]);
    }

    public function store(Request $request){
        $request->validate([
           'category_id' => 'required|integer',
           'title' => 'required|unique:sub_categories|alpha',
           'image' => 'required|mimes:png,jpg,jpeg|max:5048',
       ]);
       $newImageName = time() . '-' . $request->name . '.' .
       $request->image->extension();

       $request->image->move(public_path('storage/images/subcategories'),$newImageName);
       $category = SubCategory::create([
           'category_id' => $request->input('category_id'),
           'title' => $request->input('title'),
           'image' => $newImageName,
       ]);
       return redirect('admin/subcategories');


   }

   public function edit($id){
       $subcategory = SubCategory::find($id);
       $categories = Category::all();
       return view('admin/subcategories.edit',[
           'subcategory' => $subcategory,
           'categories' => $categories,
       ]);
   }
    public function update(Request $request , $id){
        $request->validate([
           'category_id' => 'required|integer',
           'title' => 'required|alpha',
           'image' => 'required|mimes:png,jpg,jpeg|max:5048',
       ]);
       $newImageName = time() . '-' . $request->name . '.' .
       $request->image->extension();
       $request->image->move(public_path('storage/images/subcategories'),$newImageName);
       $subcategory = SubCategory::where('id',$id)->update([
           'category_id' => $request->input('category_id'),
           'title' => $request->input('title'),
           'image' => $newImageName,
       ]);
       return redirect('/admin/subcategories');
   }
   public function destroy($id){
       SubCategory::where('id',$id)->first()->delete();
       return redirect('admin/subcategories');
   }
   
}
