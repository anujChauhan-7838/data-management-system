<x-admin-layout>
<div class="content-wrapper">
<section class="content-header">
    <h1>{{__('Edit Product')}}</h1>
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
<form method="POST" action="/products/edit"  enctype='multipart/form-data'>
@csrf
<input type="hidden" class="form-control" id="exampleInputId" aria-describedby="idHelp" placeholder="id" value="{{$id}}" name="id">
<div class="form-group">
    <label for="exampleInputEmail1">{{__('Product Image')}}</label>
    <div>
    @if($product['img'])
    <img src="{{asset('images/products/'.$product['img'])}}" title="user-image" alt="user-image" id="userImg" width="100px" height="100px">
    @else
    <img src="{{asset('images/admin.png')}}" title="user-image" alt="user-image" id="userImg" width="100px" height="100px">
    @endif
    <input type="file" name="image" class="form-control" placeholder="image" id='imgInp'>
</div>
  </div>   
  <div class="form-group">
    <label for="exampleFormControlSelect1">{{__('Category')}}</label>
    <select class="form-control" id="exampleFormControlSelect1" name="cat_id">
    @foreach($category as $cat)  
     @if($cat['id'] == $product['cat_id'])
    <option value="{{$cat['id']}}"  selected="true">{{$cat['name']}}</option>
    @else
    <option value="{{$cat['id']}}" >{{$cat['name']}}</option>
    @endif
    @endforeach
      
    </select>
  </div>
<div class="form-group">
    <label for="exampleInputEmail1">{{__('Name')}}</label>
    <input type="text" class="form-control" id="exampleInputFirstName" aria-describedby="firstNameHelp" placeholder="Name" value="{{$product['name']}}" name="name">
  </div>
 
  
  <div class="form-group">
    <label for="exampleInputPrice">{{__('Price')}}</label>
    <input type="number" class="form-control" id="exampleInputPrice" aria-describedby="nameHelp" placeholder="10" value="{{old('price',$product['price'])}}" name="price">
  </div>
  <div class="form-group">
    <label for="exampleInputDesc">{{__('Description')}}</label>
    <textarea class="form-control" id="exampleInputDesc" rows="3" name="desc">{{old('desc',$product['desc'])}}</textarea>
  
  </div>
  
 
  
  <button type="button" class="btn btn-secondary" name="back" onclick="window.location.href='/products'">{{__('Back')}}</button>
  <button type="submit" class="btn btn-primary" name="submit">{{__('Submit')}}</button>
</form>
</div>
</div>
</x-admin-layout>