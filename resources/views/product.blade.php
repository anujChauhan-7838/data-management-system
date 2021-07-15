<?php //echo "<pre>";
//print_r($allowedModules); die;
?> 
<x-admin-layout>

<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>{{__('Manage Products')}}</h1>
               @if(isset($allowedModules[strtolower(Route::current()->getName())]) && $allowedModules[strtolower(Route::current()->getName())]['add'] == 1)
               <div class="add-users">
                   <a href="{{url('products/add')}}"  title="Add Product"><i class="fa-solid fa-plus"></i> Add Product</a>
               </div>
               @endif
            </section>
            @if ($message = Session::get('success'))
            <section class="content-header">
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            </section>
            @endif
            @if ($message = Session::get('error'))
            <section class="content-header">
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            </section>
            @endif
            <!-- Main content -->
            <section class="container-fluid">
               <div class="content">
                  <div class="dashboard-gray-strip">{{__('Product List')}}</div>
                  @if(count($products))
                  <div class="table-rwd-wrap">
                  <table class="table table-bordered m-0 table-rwd">
                     
                        <tr bgcolor="#e9e9e9">
                        <th>{{__('Image')}}</th>
                           <th>{{__('Name')}}</th>
                           <th>{{__('Cat Name')}}</th>
                           <th>{{__('Price')}}</th>
                           <th>{{__('Description')}}</th>
                           <th>{{__('Actions')}}</th>
                        </tr>
                       @foreach($products as $product)
                        <tr>
                        <td class="big"><img src="{{asset('images/products/'.$product['img'])}}" alt="productImg"  width="100px" height ="100px"/></td>
                           <td>{{$product['name']}}</td>
                           <td>{{$product->categories->name}}</td>
                           <td>₹{{$product->price}}</td>
                           <td class="big">{{$product->desc}}</td>
                            <td class="table-action small">
                           @if(isset($allowedModules[strtolower(Route::current()->getName())]) && $allowedModules[strtolower(Route::current()->getName())]['edit'] == 1)
                              <a href="{{url('products/edit/'.$product->id)}}" title="Edit" class="edit"><i class="fas fa-edit"></i></a>
                            @endif 
                            @if(isset($allowedModules[strtolower(Route::current()->getName())]) && $allowedModules[strtolower(Route::current()->getName())]['delete'] == 1)
                              <!-- <a href="{{url('products/delete/'.$product->id)}}" title="Delete" class="danger"><i class="fas fa-trash-alt"></i></a> -->
                              <a href="javascript:void(0);" title="Delete" id="deleteProduct" data-val="{{'products/delete/'.$product->id}}" class="danger" onclick=" return deleteActione(event,'deleteProduct')"><i class="fas fa-trash-alt"></i></a>
                              @endif
                            </td>
                        </tr> 
                        @endforeach
                  </table>
                  </div>
                  @else
                  <div class="table-rwd-wrap not-found-section" >
                     <img src="{{asset('images/not-found.png')}}" title="No Image Found" />
                    <div>{{__('No Product Found')}}</div>
                  </div>
                  @endif
               </div>
            </section>
            <!-- /.content -->
         </div>
</x-admin-layout>
