<?php //echo "<pre>";
//print_r($modulePermissions); die;?>
<x-admin-layout>
<div class="content-wrapper">
<section class="content-header">
    <h1>{{__('Edit User')}}</h1>
</section>

@if ($errors->any())
<section class="content-header">
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
</section>

    @endif
<section class="container-fluid">
<form method="POST" action="/users/edit"  enctype='multipart/form-data'>
@csrf
<input type="hidden" class="form-control" id="exampleInputId" aria-describedby="idHelp" placeholder="id" value="{{$id}}" name="id">
<div class="form-group">
    <label for="exampleInputEmail1">{{__('User Image')}}</label>
    <div>
    @if($user['img'])
    <img src="{{asset('images/admins/'.$user['img'])}}" title="user-image" alt="user-image" id="userImg" width="100px" height="100px">
    @else
    <img src="{{asset('images/admin.png')}}" title="user-image" alt="user-image" id="userImg" width="100px" height="100px">
    @endif
    <input type="file" name="image" class="form-control" placeholder="image" id='imgInp'>
</div>
  </div>   
<div class="form-group">
    <label for="exampleInputEmail1">{{__('First Name')}}</label>
    <input type="text" class="form-control" id="exampleInputFirstName" aria-describedby="firstNameHelp" placeholder="First Name" value="{{$user['first_name']}}" name="first_name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">{{__('Last Name')}}</label>
    <input type="text" class="form-control" id="exampleInputLastName" aria-describedby="lastNameHelp" placeholder="last Name" value="{{$user['last_name']}}" name="last_name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">{{__('Email')}}</label>
    <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email Name" value="{{$user['email']}}" name="email" readonly="true">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">{{__('Password')}}</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="" name="password">
  </div>
  @if($user['user_type'] != 1)
  <div class="form-group">
    <label for="exampleFormControlSelect1">{{__('User Role')}}</label>
    <select class="form-control" id="exampleFormControlSelect1" name="userRole">
    @foreach($roles as $role)  
     @if($role['id'] == $user['user_type'])
    <option value="{{$role['id']}}"  selected="true">{{$role['display_name']}}</option>
    @else
    <option value="{{$role['id']}}" >{{$role['display_name']}}</option>
    @endif
    @endforeach
      
    </select>
  </div>
  @endif

  <div class="form-group">
   <div class="module-p-heading">{{__('Modules Permissions')}}</div>
   <div class="module-old module-p-heading module-table-sec">
    <table>
      <thead>
      
      <td>{{__('Module Name')}}</td>
      <td>{{__('Add')}}</td>
      <td>{{__('Edit')}}</td>
      <td>{{__('View')}}</td>
      <td>{{__('Delete')}}</td>
      
</thead>
<tbody>
   @foreach($modules as $module)
     <tr>
       <td>{{$module['name']}}</td>
       <td>
         <input type="checkbox" name="modules[{{$module['id']}}][add]" value="1"
         @if(isset($modulePermissions[strtolower($module['name'])]) && $modulePermissions[strtolower($module['name'])]['add'] == 1) checked="checked" @endif
         >
        </td>
       <td>
         <input type="checkbox" name="modules[{{$module['id']}}][edit]" value="1"
         @if(isset($modulePermissions[strtolower($module['name'])]) && $modulePermissions[strtolower($module['name'])]['edit'] == 1) checked="checked" @endif
         >
        </td>
       <td>
         <input type="checkbox" name="modules[{{$module['id']}}][view]" value="1"
         @if(isset($modulePermissions[strtolower($module['name'])]) && $modulePermissions[strtolower($module['name'])]['view'] == 1) checked="checked" @endif
         >
        </td>
       <td>
         <input type="checkbox" name="modules[{{$module['id']}}][delete]" value="1"
         @if(isset($modulePermissions[strtolower($module['name'])]) && $modulePermissions[strtolower($module['name'])]['delete'] == 1) checked="checked" @endif
         >
        </td>
    </tr>
   
   @endforeach
</tbody>
</table>
  </div>
  <button type="button" class="btn btn-secondary" name="back" onclick="window.location.href='/users'">{{__('Back')}}</button>
  <button type="submit" class="btn btn-primary" name="submit">{{__('Submit')}}</button>
</form>
</div>
</div>
</x-admin-layout>