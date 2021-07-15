<x-admin-layout>

<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>{{__('Dashboard')}}</h1>
            </section>
            <!-- Main content -->
            <section class="container-fluid">
               <div class="row">
                  <div class="col-lg-4 col-md-4  col-xs-12">
                     <!-- small box -->
                     <div class="small-box bg-yellow">
                        <div class="small-box-inner">
                           <div class="icon">
                              <i class="appyicon-onetouch"></i>
                           </div>
                           <div class="inner">
                              <h3>{{$totalUsers}}</h3>
                              <p>{{__('Total User(s)')}}</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-4 col-md-4  col-xs-12">
                     <!-- small box -->
                     <div class="small-box bg-aqua">
                        <div class="small-box-inner">
                           <div class="icon">
                              <i class="appyslim-ui-confirm"></i>
                           </div>
                           <div class="inner">
                              <h3>{{$totalCategory}}</h3>
                              <p>{{__('Total Category(s)')}}</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-4 col-md-4  col-xs-12">
                     <!-- small box -->
                     <div class="small-box bg-purple">
                        <div class="small-box-inner">
                           <div class="icon">
                              <i class="appyslim-gambling-dollar-tips-2"></i>
                           </div>
                           <div class="inner">
                              <h3>{{$totalProduct}}</h3>
                              <p>{{__('Total Product(s)')}}</p>
                           </div>
                        </div>
                        <!-- <div class="small-box-footer clearfix">
                           <a href="#" class="pull-left">Online $50</a>
                           <a href="#" class="pull-right">Cash $51</a>
                        </div> -->
                     </div>
                  </div>
                  <!-- ./col -->                   
               </div>
               
            </section>
            <!-- /.content -->
         </div>
</x-admin-layout>
