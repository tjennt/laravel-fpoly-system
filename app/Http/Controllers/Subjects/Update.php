<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Core;
use App\Http\Controllers\Core\View;
use App\Http\Controllers\Core\Json;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use Auth;
use App\User;
use App\Model\Subjects;


class Update extends Controller
{
    public function subjectView($id){
        $subject = Subjects::findOrFail($id);
        return view(View::department('update-subject'), [
            'subject' => $subject
        ]);
    }
    public function subject(Request $req){
        $validator = Validator::make($req->all(), [
            'id'        => 'required | min:1 | max:255',
            'name'      => 'required | min:5 | max:255',
            'code'      => 'required | min:5 | max:255',
            'days_fail' => 'required | min:1 | max:255'
        ], [
            'name.required' => 'Tên môn học không được bỏ trống',
            'name.min' => 'Tên môn học phải lớn hơn năm kí tự',
            'code.required' => 'Mã môn học không được bỏ trống',
            'code.min' => 'Mã môn học phải lớn hơn năm kí tự',
            'day_fail.required' => 'Ngày vắng tối đa không được bỏ trống',
            'day_fail.min' => 'Ngày vắng tối đa phải lớn hơn 1 kí tự'
        ]);
        if ($validator->fails()) {
            return Json::getMess($validator->errors(), 422);
        }
        $subject = Subjects::find($req->id);
        if(!$subject){
            return Json::getMess('Không tìm thấy môn học cần xóa', 422);
        }
        $checkCode = Subjects::where('code', $req->code)
                            ->whereNotIn('id', [$req->id])
                            ->first();
        if($checkCode){
            return Json::getMess('Mã môn đã tồn tại', 422);
        }
        $code = $req->code?$req->code:$subject->code;
        $subject->name = $req->name?$req->name:$subject->name;
        $subject->code = Str::lower(preg_replace('/\s+/', '_', Core::vnToEn($code)));
        $subject->days_fail = $req->days_fail?$req->days_fail:$subject->days_fail;
        $subject->save();
        return Json::getMess('Cập nhật môn học thành công', 200);
    }
}
