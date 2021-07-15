
<x-admin-layout>
<div class="content-wrapper">
<section class="content-header">
    <h1>{{__('View Category')}}</h1>
</section>

<section class="container-fluid">

<div class="dispay-grid">
 <p><Strong>{{__('Name')}}</strong>:&nbsp; {{$cat['name']}}</p>
</div>
<div class="dispay-grid">
 <p><Strong>{{__('Desscription')}}</strong>:&nbsp; {{$cat['desc']}}</p>
</div>
<div class="back">
<a href="{{url('categories')}}" title="back" class="back-a">{{__('Back')}}</a>
</div>
</section>
</x-admin-layout>