<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\Module;

class UserController extends Controller
{
    //
    public function index(){
        $userType = auth()->user()->user_type;
        $allUser = User::orderBy('created_at','desc')->get();
        if($userType == 2){
            $allUser = User::where('user_type','!=',1)->orderBy('created_at','desc')->get();
        }else if($userType == 3){
            $allUser = User::where('id','=',auth()->user()->id)->orderBy('created_at','desc')->get();
        }
        return view('user',['users'=>$allUser->toArray()]);
    }

    public function view($id){
        $user = User::where('id','=',$id)->first();
        if($user)
        return view('user-view',['user'=>$user]);
        else
        return redirect('/users');
    }

    public function edit($id){
        $user = User::find($id);
        if($user){
            $roles = Role::all()->except(1);
            $modules = Module::all();
            $modulePermissions = [];
            foreach ($user->Userroles as $key => $value) {
                $module                              = $value->module->toArray();
                $module_name                         = strtolower($module['name']);
                $modulePermissions[$module_name]     = $value->toArray();	
                $modulePermissions[$module_name]['module_name'] = $module['name'];
            }
          return view('edit-user',[
              'user'=>$user->toArray(),
              'roles'=>$roles->toArray(),
              'id'=>$id,
              'modules'=>$modules->toArray(),
              'modulePermissions'=>$modulePermissions
            ]);
        }else{
            return redirect('/users');
        }

    }

    public function update(Request $request){
        
        $rules = [
            'image' => 'image|mimes:jpeg,png,jpg|max:1028',
            'first_name' => 'required',
            'last_name' => 'required',
            'modules' =>'required|min:1'

        ];
    
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'image' => 'Please upload valid image (jpeg,jpg,png).',
            'mimes' => 'Supported image type are jpeg, jpg, png.',
            'email.max'  => '199 Maximum number of character is allowed for email id',
            'modules.min' => 'Role permission is required.'
        ];
    
        $this->validate($request, $rules, $customMessages);
        $allParams = $request->all();
        
        $user = User::find($allParams['id']);
        if($user){
            if ($image = $request->file('image')) {
                $destinationPath = 'images/admins/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $user->img = $profileImage;
            }
           $user->first_name = $allParams['first_name'];
           $user->last_name = $allParams['last_name'];
           if(isset($allParams['password']) && !empty($allParams['password'])){
            $user->password = bcrypt($allParams['password']);
           }
           if(isset($allParams['userRole']) && !empty($allParams['userRole'])){
             $user->user_type = (int)$allParams['userRole'];
             $userRoles = array();
            foreach($allParams['modules'] as $key => $module){
                $tmpArr = array(
                    'user_id'=>(int)$allParams['id'],
                    'role_id'=>(int)$allParams['userRole'],
                    'module_id'=>(int)$key,
                    'add'=> isset($module['add'])?(string)$module['add']:'0',
                    'edit'=>isset($module['edit'])?(string)$module['edit']:'0',
                    'view'=>isset($module['view'])?(string)$module['view']:'0',
                    'delete'=>isset($module['delete'])?(string)$module['delete']:'0',
                );
                array_push($userRoles , $tmpArr);
            }
            $this->performRoleAssignment($userRoles,$user->toArray(),0);
             $this->sendMail($allParams,0);
           }
           $user->save();
           return redirect()->route('users')
                        ->with('success','User has been updated successfully');
        }else{
            return redirect('/users');
        }
    }


    public function performRoleAssignment($userRoles,$user,$isAdd = 0){
        $data = $userRoles;
        if($isAdd == 0)
        UserRole::where('user_id',(int)$user['id'])->delete();
        if(!empty($data)){
          $roleCreated =  UserRole::insert($data);
        }
        return true;
    }


    public function add(){
          $roles = Role::all()->except(1);
          $modules = Module::all();
          return view('add-user',['roles'=>$roles->toArray(),'modules'=>$modules->toArray()]);
    }


    public function store(Request $request){
        $rules = [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1028',
            'first_name' => 'required',
            'last_name' => 'required',
            'email'=>'required|max:199|unique:users',
            'password'=>'required|max:15',
            'modules' =>'required|min:1'

        ];
    
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'image' => 'Please upload valid image (jpeg,jpg,png).',
            'mimes' => 'Supported image type are jpeg, jpg, png.',
            'email.max'  => '199 Maximum number of character is allowed for email id',
            'password.max'  => '15 Maximum number of character is allowed for email id',
            'modules.min' => 'Role permission is required.'
        ];
    
        $this->validate($request, $rules, $customMessages);
        $all = $request->all();
        
        $data = array(
            'first_name'=>$all['first_name'],
            'last_name'=>$all['last_name'],
            'email'=>$all['email'],
            'user_type'=>(string)$all['userRole'],
            'password'=>bcrypt($all['password']),
            'img'=>NULL
        );
        if ($image = $request->file('image')) {
            $destinationPath = 'images/admins/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['img'] = $profileImage;
        }
       
        $user = User::create($data);
        if($user){
            $user = $user->toArray();
            $allParams['userRole'] = $all['userRole'];
            $userRoles = array();
            foreach($all['modules'] as $key => $module){ //dd($module);
                $tmpArr = array(
                    'user_id'=>(int)$user['id'],
                    'role_id'=>(int)$allParams['userRole'],
                    'module_id'=>(int)$key,
                    'add'=> isset($module['add'])?(string)$module['add']:'0',
                    'edit'=>isset($module['edit'])?(string)$module['edit']:'0',
                    'view'=>isset($module['view'])?(string)$module['view']:'0',
                    'delete'=>isset($module['delete'])?(string)$module['delete']:'0',
                );
                array_push($userRoles , $tmpArr);
            }
           
            $this->performRoleAssignment($userRoles,$user,1);
            $this->sendMail($all);
        }  
        return redirect()->route('users')
                        ->with('success','User has been created successfully');
            

    }
    
    public function sendMail($data,$isAddUser = 1){
        unset($data['image']);
        dispatch(new \App\Jobs\SendEmailJob($data,$isAddUser));
        return true;
    }


    public function delete($id){
        $user = User::where('id','=',$id)->where('user_type','!=' ,1);
        if($user){
            $user->delete();
            return redirect()->route('users')->with('success',"User has been deleted successfully");
        }else{
            return redirect()->route('users')->with('error',"You are not authorised to perform this operation"); 
        }
    }


    public function exportUsers(){
        $fileName = 'users_'.time().'.csv';
        $users = User::where('user_type','!=',1)->get();
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('name','email','user_role');
        $callback = function() use($users, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);
        foreach ($users as $user) {
                $row['name']  = $user->first_name.' '.$user->last_name;
                $row['email']    = $user->email;
                $row['user_role']    = $user->user_type == 2?'Admin':'Sales Admin';
                fputcsv($file, array($row['name'], $row['email'],$row['user_role']));
        }
        fclose($file);
        };
         
        return response()->stream($callback, 200, $headers); exit;
    }
}
