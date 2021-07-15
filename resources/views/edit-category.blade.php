<x-admin-layout>
<div class="content-wrapper">
<section class="content-header">
    <h1>{{__('Edit Category')}}</h1>
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
<form method="POST" action="/categories/edit">
@csrf
<input type="hidden" class="form-control" id="exampleInputId" aria-describedby="idHelp" placeholder="id" value="{{$id}}" name="id">
  <div class="form-group">
    <label for="exampleInputEmail1">{{__('Name')}}</label>
    <input type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" placeholder="Name" value="{{$category['name']}}" name="name">
  </div>
  <div class="form-group">
    <label for="exampleInputDesc">{{__('Description')}}</label>
    <textarea class="form-control" id="exampleInputDesc" rows="3" name="desc">{{$category['desc']}}</textarea>
  
  </div>
  <button type="button" class="btn btn-secondary" name="back" onclick="window.location.href='/categories'">{{__('Back')}}</button>
  <button type="submit" class="btn btn-primary" name="submit">{{__('Submit')}}</button>
</form>
</div>
</div>
</x-admin-layout>