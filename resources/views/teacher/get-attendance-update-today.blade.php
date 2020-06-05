@extends('teacher.home')
@section('content-teacher')

<div class="container box p-lg-5 p-3 ">
    <div class="nut-up">
        <i class="fas fa-chevron-circle-up    "></i>
    </div>
    <div class=""><h3 class="text-center">CẬP NHẬT ĐIỂM DANH</h3></div>
    <div class="p-4">
        <!-- ERROR -->
        <div>
            @if($errors->any())
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            @endif
        </div>
        {{-- DANGER --}}
        @if(session('Danger'))
        <div class="alert alert-danger font-weight-bold text-center">
            {{ session('Danger') }}
        </div>
        @endif
        <!-- END ERROR  -->
        <!-- SUCCESSFULLY   -->
        @if(session('Success'))
        <div class="alert alert-success font-weight-bold text-center">
            {{ session('Success') }}
        </div>
        @endif
        <!-- END SUCCESSFULLY   -->
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Mã Sinh viên</th>
                    <th class="row-width-200">Họ và Tên</th>
                    <th class="text-center">Hình</th>
                    <th class="text-center">
                        <button class="btn " id="kiem-tra-vang">Vắng</button>
                        <button class="btn btn-primary-neo" id="kiem-tra-tong">Tổng</button>
                    </th>
                </tr>
    
                <form method="post" action="{{ route('attendance-students-update-post') }}">
                    @csrf
                        
                        @foreach ($students as $key => $student)
                            <tr class="row-center">
                                <td>{{ ++$key }}</td>
                                <td>{{ $student->student_code }}</td>
                                <td class="row-width-200">{{ $student->full_name }}</td>
                                <th class="text-center">
                                    <img src="{{ $student->avatar_img_path }}" alt="{{ $student->avatar_img_path }}"   width="100px">
                                </th>
                                <td class="text-center">
                                    <div class="confirm-switch mx-auto">
                                        <input class='{{ $student->checked == 'true'?'checked':'' }}' type="checkbox" id="default-switch{{ $student->id }}" value="{{ $student->id }}" name="attendance[]"
                                            {{ $student->checked == 'true'?'checked':'' }}>
                                        <label for="default-switch{{ $student->id }}"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </div>
                    <input type="hidden" name="days_class_subject_id" value="{{ $classSubject->dcs_id }}">
                    <input type="hidden" name="class_id" value="{{ $classSubject->class_id }}">
                    <input type="hidden" name="study_time_id" value="{{ $classSubject->study_time_id }}">
                    <tr class="row-center">
                        <td colspan="4" class="text-secondary font-italic small"> 
                            <textarea type="text" class="form-control" name="note" placeholder="Ghi chú..."></textarea>
                        </td>
                        <td class="text-center">
                            <button type="submit" class="btn btn-success " id="luu" {{ $timeOut=='false'?'':'disabled' }}>Lưu lại</button>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
</div>

@endsection