<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::with('categories')->get();
        return view('product',['products'=>$products]);
    }
    public function edit($id){
        $product = Product::find($id);
        if($product){
            $category = Category::all();
            if( $category->count()){
                return view('edit-products',['product'=>$product->toArray(),'category'=>$category->toArray(),'id'=>$id]);
            }else{
                return redirect()->route('categories')
                        ->with('error','Add category to use in products page');
            }
          
        }else{
            return redirect('/products');
        }

    }

    public function update(Request $request){
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:1028',
            'name' => 'required',
            'cat_id' => 'required',
            'price' => 'required',
            'desc' => 'required',
        ]);
        $allParams = $request->all();
        
        $product = Product::find($allParams['id']);
        if($product){
            if ($image = $request->file('image')) {
                $destinationPath = 'images/products/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $product->img = $profileImage;
            }
           $product->name = $allParams['name'];
           $product->cat_id = $allParams['cat_id'];
           $product->price = $allParams['price'];
           $product->desc = $allParams['desc'];
           $product->save();
           return redirect()->route('products')
                        ->with('success','Products has been updated successfully');
        }else{
            return redirect('/products');
        }
    }


    


    public function add(){ 
          $category = Category::all();
          if($category->count()){
            return view('add-product',['category'=>$category->toArray()]);
          }else{
            return redirect()->route('categories')
            ->with('error','Add category to use in products page');
          }
          
    }


    public function store(Request $request){
      
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1028',
            'name' => 'required',
            'cat_id' => 'required',
            'price'=>'required',
            'desc'=>'required'

        ]); 
        $all = $request->all();
        
        $data = array(
            'name'=>$all['name'],
            'cat_id'=>$all['cat_id'],
            'img'=>NULL,
            'price'=>$all['price'],
            'desc'=>$all['desc']

        );
        if ($image = $request->file('image')) {
            $destinationPath = 'images/products/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['img'] = $profileImage;
        }
        $product = Product::create($data);
        return redirect()->route('products')
                        ->with('success','Product has been created successfully');
            

    } 


    public function delete($id){
        $product = Product::where('id','=',$id);
        if($product){
            $product->delete();
            return redirect()->route('products')->with('success',"Product has been deleted successfully");
        }else{
            return redirect()->route('products')->with('error',"You are not authorised to perform this operation"); 
        }
    }
}
