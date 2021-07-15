<?php //echo "<pre>";
//print_r($allowedModules); die;
?> 
<x-admin-layout>

<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>{{__('Manage Users')}}</h1>
               @if(isset($allowedModules[strtolower(Route::current()->getName())]) && $allowedModules[strtolower(Route::current()->getName())]['add'] == 1)
               <div class="add-users">
                   <a href="{{url('users/add')}}"  title="Add Users"><i class="fa-solid fa-plus"></i> Add User</a>
               </div>
               @endif
               @if(count($users))
               <div class="add-users">
                   <a href="{{url('users/export-users')}}"  target="__blank" title="Export Users"><i class="fas fa-download"></i> Export Users</a>
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
                  <div class="dashboard-gray-strip">{{__('Users List')}}</div>
                  <div class="table-rwd-wrap">
                  <table class="table table-bordered m-0 table-rwd">
                     
                        <tr bgcolor="#e9e9e9">
                           <th>{{__('First Name')}}</th>
                           <th>{{__('Last Name')}}</th>
                           <th>{{__('Email')}}</th>
                           <th>{{__('Type')}}</th>
                           <th>{{__('Actions')}}</th>
                        </tr>
                       @foreach($users as $user)
                        <tr>
                           <td>{{$user['first_name']}}</td>
                           <td>{{$user['last_name']}}</td>
                           <td>{{$user['email']}}</td>
                           <td>
                               @if($user['user_type'] == 1)
                                Super Admin
                               @elseif($user['user_type'] == 2)
                                 Admin
                               @else
                                 Sales Admin;
                               @endif
                           </td>
                           <td class="table-action">
                           @if(isset($allowedModules[strtolower(Route::current()->getName())]) && $allowedModules[strtolower(Route::current()->getName())]['edit'] == 1)
                              <a href="{{url('users/edit/'.$user['id'])}}" title="Edit" class="edit"><i class="fas fa-edit"></i></a>
                            @endif 
                            @if(isset($allowedModules[strtolower(Route::current()->getName())]) && $allowedModules[strtolower(Route::current()->getName())]['view'] == 1)
                              <a href="{{'users/view/'.$user['id']}}" title="View User" id="viewUser" data-val="{{'users/view/'.$user['id']}}" class="view" ><i class="far fa-eye"></i></a>
                            @endif
                            @if(isset($allowedModules[strtolower(Route::current()->getName())]) && $allowedModules[strtolower(Route::current()->getName())]['delete'] == 1 && $user['user_type'] != 1)
                              <a href="javascript:void(0);" title="Delete" id="deleteUser" data-val="{{'users/delete/'.$user['id']}}" class="danger" onclick=" return deleteActione(event,'deleteUser')"><i class="fas fa-trash-alt"></i></a>
                            @endif
                           
                            </td>
                        </tr> 
                        @endforeach
                  </table>
                  </div>
               </div>
            </section>
            <!-- /.content -->
         </div>
</x-admin-layout>
