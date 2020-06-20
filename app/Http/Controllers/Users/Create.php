<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Json;
use App\Http\Controllers\Core\Core;
use App\Http\Controllers\Core\View;
use App\Http\Controllers\Users\CoreUsers;
use Auth;
use App\User;
use App\Model\Role;
use App\Model\UserRole;
use Validator;

class Create extends Controller
{
    public function createUserView(){
        $roles = Role::whereNotIn('code', ['admin'])->get();

        return view(View::admin('create-user'),[
            'roles'=>$roles
        ]);
    }
    public function createUserPost(Request $req){
        $validator = Validator::make($req->all(), [
            'user_name'         => 'required | min:1 | max:255',
            'password'          => 'required | min:1 | max:255',
            'full_name'         => 'required | min:1 | max:255',
            'phone_number'      => 'required | min:1 | max:255',
            'email'             => 'required | min:1 | max:255',
            'role'              => 'required | min:1 | max:255'
        ]);
        if ($validator->fails()) {
            return Json::getMess($validator->errors(), 422);
        }
        $userNameCheck = User::where('user_name', $req->user_name)->first();

        if($userNameCheck){
            // return Core::toBack($this->danger, 'Tên tài khoản đã tồn tại');
            return Json::getMess('Tên tài khoản đã tồn tại', 422);
        }
        
        $data = (object) [
            'user_name'         => $req->user_name,
            'user_parent_uuid'  => Core::parent(),
            'password'          =>$req->password,
            'full_name'         =>$req->full_name,
            'phone_number'      =>$req->phone_number,
            'email'             =>$req->email,
            'avatar_img_path'   => 'images/users/user.png',
            'soft_deleted'      => Core::false()
        ];
        $user = CoreUsers::create($data);
        $user = User::where('user_name', $user->user_name)->first();
        
        // for($i = 1; $i <= $req->role; $i++){
        $userRole = new UserRole;
        $userRole->user_uuid = $user->uuid;
        $userRole->role_id = $req->role;
        $userRole->save();
        // }
        Core::pushRealTime('collaboration-component-count-all');
        // return Core::toBack($this->success, "Tạo tài khoản thành công");
        return Json::getMess('Tạo tài khoản thành công', 200);
    }
}
