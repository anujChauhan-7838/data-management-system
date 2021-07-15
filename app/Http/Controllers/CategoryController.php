<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    //
    public function index(){
        $allCat = Category::orderBy('created_at','desc')->get();
        return view('category',['allCat'=>$allCat->toArray()]);
    }
    public function edit($id){
        $category = Category::find($id);
        if($category){
            
          return view('edit-category',['category'=>$category->toArray(),'id'=>$id]);
        }else{
            return redirect('/categories');
        }

    }

    public function view($id){
        $cat = Category::where('id','=',$id)->first();
        if($cat)
        return view('category-view',['cat'=>$cat]);
        else
        return redirect('/categories');
    }

    public function update(Request $request){
        $allParams = $request->all();
        $request->validate([
            'name' => 'required|unique:categories,name,'.$allParams['id'].',id,deleted_at,NULL',
            'desc' => 'required'
            
        ]);
        $category = Category::find($allParams['id']);
        if($category){
           $category->name = $allParams['name'];
           $category->desc = $allParams['desc'];
           $category->save();
           return redirect()->route('categories')
                        ->with('success','Category has been updated successfully');
        }else{
            return redirect('/categories');
        }
    }


    


    public function add(){
          return view('add-category');
    }


    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories,name,NULL,id,deleted_at,NULL',
            'desc' => 'required'
        ]); 
        $all = $request->all();
      
        $data = array(
            'name'=>$all['name'],
            'desc'=>$all['desc']
        );
       
        $category = Category::create($data);
        return redirect()->route('categories')
                        ->with('success','Category has been created successfully');
            

    } 


    public function delete($id){
        $cat = Category::where('id','=',$id);
        if($cat){
            Product::where('cat_id','=',$id)->delete();
            $cat->delete();
            return redirect()->route('categories')->with('success',"Category has been deleted successfully");
        }else{
            return redirect()->route('categories')->with('error',"You are not authorised to perform this operation"); 
        }
    }
}
