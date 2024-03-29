<?php

namespace App\Http\Controllers\ClassSubject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Core;
use App\Http\Controllers\Core\View;
use App\Http\Controllers\Core\Json;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use App\Model\Students;
use App\User;
use App\Model\ClassSubject;
use App\Model\ClassM;
use App\Model\StudyTime;
use App\Model\Subjects;
use App\Model\DaysClassSubject;
use DB;

class Get extends Controller
{
    // GET ALL CLASS SUBJECTS
    public function classSubjects(){
        $classSubjects = Get::dbClassSubject()
                            ->orderBy('c.code', 'asc')
                            ->get();
        // return $classSubjects;
        return view(View::department('get-class-subjects'), [
            'classSubjects' => $classSubjects,
            'Core'          => new Core
        ]);
    }
    // GET DAYS CLASS SUBJECT
    public function classSubjectDetail(Request $req, $id){
        $classSubjects = Get::dbClassSubject()->where('cs.id', $id)->first();

        $daysClassSubject = DB::table('days_class_subject as dcs')
                            ->where('class_subject_id', $id)
                            ->join('users as us' , 'dcs.user_manager_uuid', '=', 'us.uuid')
                            ->select(
                                'dcs.id as id',
                                'us.user_name as user_name',
                                'us.full_name as user_full_name',
                                'dcs.date'
                            )
                            ->orderBy('dcs.date', 'asc')
                            ->get();
        if($req->get_json){
            // return $daysClassSubject;
            return view('department.get-ajax-days-class-subject', [
                'Carbon'          => new Carbon,
                'daysClassSubject'=> $daysClassSubject
            ]);
        }
        return view(View::department('get-detail-class-subject'), [
            'cLassSubject'=> $classSubjects,
            'Carbon'          => new Carbon,
            'Core'          => new Core,
        ]);
    }
    // GET CLASS SUBJECT TEACHER
    public function classSubjectTeacher(){
        $classSubjects = Get::dbClassSubject()
                            ->where('user_manager_uuid', Auth::id())
                            ->whereDate('datetime_end', '>', Carbon::now()->toDateString())
                            ->get();
        return view(View::teacher('get-class-subjects'), [
            'classSubjects' => $classSubjects,
            'Carbon'        => new Carbon,
            'Core'          => new Core
        ]);
    }
    // GET DETAIL SUBJECT TEACHER
     public function detaiClassSubjectTeacher($id){
        
        $classSubject = Get::dbClassSubject()
                        ->where('cs.id', $id)
                        ->where('cs.user_manager_uuid', Auth::id())
                        ->first();

        if(!$classSubject){
            return Core::notFound();
        }
        $daysClassSubject = DB::table('days_class_subject as dcs')
                            ->join('class_subject as cs', 'dcs.class_subject_id', '=', 'cs.id')
                            ->join('users as us' , 'dcs.user_manager_uuid', '=', 'us.uuid')
                            ->where('class_subject_id', $id)
                            ->where('cs.user_manager_uuid', Auth::id())
                            ->select(
                                'dcs.id as id',
                                'dcs.class_subject_id',
                                'us.user_name as user_name',
                                'us.full_name as user_full_name',
                                'dcs.date',
                                'dcs.checked'
                            )
                            ->get();
        
        return view(View::teacher('get-detail-class-subject'), [
            'cLassSubject'      => $classSubject,
            'daysClassSubject'  => $daysClassSubject,
            'Core'              => new Core,
            'Carbon'            => new Carbon
        ]);
    }
    // GET CLASS SUBJECT TODAY
    public function classSubjectTeacherToday(){
        $classSubjects = Get::dbClassSubject()
                            ->where('user_manager_uuid', Auth::id())
                            ->whereDate('datetime_end', '>', Carbon::now()->toDateString())
                            ->get();

        $arrayClassSubjects = [];
        foreach($classSubjects as $detailCs){
            $arrayDays = [];
            $daysCheck = DB::table('days_class_subject as dcs')
                        ->join('users as us', 'dcs.user_manager_uuid', 'us.uuid')
                        ->where('dcs.class_subject_id', $detailCs->id)
                        ->whereDate('dcs.date',  Carbon::now()->toDateString())
                        ->where('dcs.user_manager_uuid', Auth::id())
                        ->first();
            if($daysCheck){
                $detailCs->day_study_id = $daysCheck->id;
                $detailCs->user_manager_study_uuid = $daysCheck->user_manager_uuid;
                $detailCs->user_manager_study_full_name = $daysCheck->full_name;
                $detailCs->date_study = $daysCheck->date;
                $detailCs->checked = $daysCheck->checked;
                $arrayClassSubjects[] = $detailCs;
            }
        }
        $daysClassSubject = Get::dbClassSubject()
                                            ->join('days_class_subject as dcs', 'cs.id', '=', 'dcs.class_subject_id')
                                            ->join('users as us_day', 'dcs.user_manager_uuid', 'us_day.uuid')
                                            ->where('dcs.user_manager_uuid', Auth::id())
                                            ->whereDate('date', Carbon::now()->toDateString())
                                            ->select(
                                                'cs.id',
                                                'c.name as class_name',
                                                'c.code as class_code',
                                                'sj.name as subject_name',
                                                'sj.code as subject_code',
                                                'st.name as study_time_name',
                                                'cs.datetime_start',
                                                'cs.datetime_end',
                                                'cs.days_week',
                                                'st.time_start as study_time_start',
                                                'st.time_end as study_time_end',
                                                'us.user_name as user_name',
                                                'us.full_name as user_full_name',
                                                'dcs.id as day_study_id',
                                                'dcs.user_manager_uuid as user_manager_study_uuid',
                                                'us_day.full_name as user_manager_study_full_name',
                                                'dcs.date as date_study',
                                                'dcs.checked as checked'
                                            )
                                            ->get()
                                            ->toArray();
        // return $daysClassSubject + $arrayClassSubjects;
        // return $arrayClassSubjects;
        return view(View::teacher('get-class-subjects-today'), [
            'classSubjects' => $arrayClassSubjects + $daysClassSubject,
            'Carbon'        => new Carbon
        ]);
    }



    // ================PROTECTED FUNCTION================
    
    // GET CLASS SUBJECT
    protected static function dbClassSubject(){
        $classSubjects = DB::table('class_subject as cs')
                ->join('class as c', 'cs.class_id' , '=', 'c.id')
                ->join('subjects as sj', 'cs.subject_id' , '=', 'sj.id')
                ->join('study_time as st', 'cs.study_time_id', '=', 'st.id')
                ->join('users as us', 'cs.user_manager_uuid', 'us.uuid')
                ->where('cs.soft_deleted', Core::false())
                ->select(
                    'cs.id',
                    'c.name as class_name',
                    'c.code as class_code',
                    'sj.name as subject_name',
                    'sj.code as subject_code',
                    'st.name as study_time_name',
                    'cs.datetime_start',
                    'cs.datetime_end',
                    'cs.days_week',
                    'st.time_start as study_time_start',
                    'st.time_end as study_time_end',
                    'us.user_name as user_name',
                    'us.full_name as user_full_name'
                );
        return $classSubjects;
    }
}
