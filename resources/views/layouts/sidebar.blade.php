<?php //echo "<pre>";
//print_r($allowedModules); die;
//echo Route::current()->getName(); die;

?>
<aside class="main-sidebar" ng-if="sidebar.length > 0">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
               <!-- Sidebar Menu -->
               <ul class="sidebar-menu m-t-20 p-t-20" data-widget="tree">
                  @foreach($allowedModules as $module)
                  <li class="treeview" ng-class="treeview">
                     @if(Route::current()->getName() == strtolower($module['module_name']))
                     <a href="{{url(strtolower($module['module_name']))}}" class="sidebar-tab active">
                     @else
                     <a href="{{url(strtolower($module['module_name']))}}" class="sidebar-tab">
                     @endif
                     
                     <i class="icon {{$module['module']['icon']}}"></i>
                        <span>{{__($module['module_name'])}}</span>
                     <!-- <span class="pull-right-container" ng-if="nav.subTab.length > 0">
                     <i class="icon icon-angle-left pull-right"></i>
                     </span> -->
                     </a>
                     <!-- <ul class="treeview-menu">
                        <li ng-repeat = "subTab in nav.subTab">
                           <a href="javascript:void(0);" ng-click="sidebarFunctionCall(subTab.clickEvent,1,nav.clickEvent)"><span ng-bind="subTab.tabName"></span></a>
                        </li>
                        
                     </ul> -->
                  </li>
                  @endforeach
                  
               <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
         </aside>