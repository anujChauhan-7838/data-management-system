<?php //echo "<pre>";
//print_r($allowedModules); die;
?> 
<x-admin-layout>

<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>{{__('Manage Categories')}}</h1>
               @if(isset($allowedModules[strtolower(Route::current()->getName())]) && $allowedModules[strtolower(Route::current()->getName())]['add'] == 1)
               <div class="add-users">
                   <a href="{{url('categories/add')}}"  title="Add Users"><i class="fa-solid fa-plus"></i> Add Categories</a>
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
                  <div class="dashboard-gray-strip">{{__('Category List')}}</div>
                  @if(count($allCat))
                  <div class="table-rwd-wrap">
                  <table class="table table-bordered m-0 table-rwd">
                     
                        <tr bgcolor="#e9e9e9">
                           <th>{{__('Cat Name')}}</th>
                           <th>{{__('Actions')}}</th>
                        </tr>
                       @foreach($allCat as $cat)
                        <tr>
                           <td>{{$cat['name']}}</td>
                           <td class="table-action">
                           @if(isset($allowedModules[strtolower(Route::current()->getName())]) && $allowedModules[strtolower(Route::current()->getName())]['edit'] == 1)
                              <a href="{{url('categories/edit/'.$cat['id'])}}" title="Edit" class="edit"><i class="fas fa-edit"></i></a>
                            @endif 
                            @if(isset($allowedModules[strtolower(Route::current()->getName())]) && $allowedModules[strtolower(Route::current()->getName())]['view'] == 1)
                              <a href="{{'categories/view/'.$cat['id']}}" title="View Category" id="viewCategory" data-val="{{'categories/view/'.$cat['id']}}" class="view" ><i class="far fa-eye"></i></a>
                            @endif
                            @if(isset($allowedModules[strtolower(Route::current()->getName())]) && $allowedModules[strtolower(Route::current()->getName())]['delete'] == 1)
                              <!-- <a href="{{url('categories/delete/'.$cat['id'])}}" title="Delete" class="danger"><i class="fas fa-trash-alt"></i></a> -->
                              <a href="javascript:void(0);" title="Delete" id="deleteCat" data-val="{{url('categories/delete/'.$cat['id'])}}" class="danger" onclick=" return deleteActione(event,'deleteCat')"><i class="fas fa-trash-alt"></i></a>
                              
                              @endif
                            </td>
                        </tr> 
                        @endforeach
                  </table>
                  </div>
                  @else
                  <div class="table-rwd-wrap not-found-section" >
                     <img src="{{asset('images/not-found.png')}}" title="No Image Found" />
                    <div>{{__('No Category Found')}}</div>
                  </div>
                  @endif
               </div>
            </section>
            <!-- /.content -->
         </div>
</x-admin-layout>
