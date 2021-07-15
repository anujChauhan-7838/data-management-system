<x-admin-layout>
<div class="content-wrapper">
<section class="content-header">
    <h1>{{__('Add User')}}</h1>
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
<form method="POST" action="/users/store" enctype='multipart/form-data'>
@csrf
<input type="hidden" class="form-control" id="exampleInputId" aria-describedby="idHelp" placeholder="id" value="" name="id">
<div class="form-group">
    <label for="exampleInputEmail1">{{__('User Image')}}</label>
    <div>
    <img src="{{asset('images/admin.png')}}" title="user-image" alt="user-image" id="userImg" width="100px" height="100px">
    <input type="file" name="image" class="form-control" placeholder="image" id='imgInp'>
</div>
  </div>  
<div class="form-group">
    <label for="exampleInputEmail1">{{__('First Name')}}</label>
    <input type="text" class="form-control" id="exampleInputFirstName" aria-describedby="firstNameHelp" placeholder="First Name" value="{{old('first_name','')}}" name="first_name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">{{__('Last Name')}}</label>
    <input type="text" class="form-control" id="exampleInputLastName" aria-describedby="lastNameHelp" placeholder="last Name" value="{{old('last_name','')}}" name="last_name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">{{__('Email')}}</label>
    <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email Name" value="{{old('email','')}}" name="email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">{{__('Password')}}</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="" name="password">
  </div>
 
  <div class="form-group">
    <label for="exampleFormControlSelect1">{{__('User Role')}}</label>
    <select class="form-control" id="exampleFormControlSelect1" name="userRole">
    @foreach($roles as $role)  
    <option value="{{$role['id']}}" >{{$role['display_name']}}</option>
    @endforeach
      
    </select>
  </div>
  <button type="button" class="btn btn-secondary" name="back" onclick="window.location.href='/users'">{{__('Back')}}</button>
  
  <button type="submit" class="btn btn-primary" name="submit">{{__('Submit')}}</button>
</form>
</div>
</div>


</x-admin-layout>