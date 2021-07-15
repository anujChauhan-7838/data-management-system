
<x-admin-layout>
<div class="content-wrapper">
<section class="content-header">
    <h1>{{__('View User')}}</h1>
</section>

<section class="container-fluid">
<div class="dispay-grid">
 <p><Strong>{{__('Profile Pic')}}</strong>:&nbsp; <img src="{{asset('images/admins/'.$user['img'])}}" class="image-display" /></p>
</div>
<div class="dispay-grid">
 <p><Strong>{{__('First Name')}}</strong>:&nbsp; {{$user['first_name']}}</p>
</div>
<div class="dispay-grid">
 <p><Strong>{{__('Last Name')}}</strong>:&nbsp; {{$user['last_name']}}</p>
</div>
<div class="dispay-grid">
 <p><Strong>{{__('User Role')}}</strong>:&nbsp;@if($user['user_type'] == 1) Super Admin
         @elseif($user['user_type'] == 2)
          Admin
        @elseif($user['user_type'] == 3)
          Sales Admin
          @endif 
</p>
</div>

<div class="back">
<a href="{{url('users')}}" title="back" class="back-a">{{__('Back')}}</a>
</div>
</section>
</x-admin-layout>