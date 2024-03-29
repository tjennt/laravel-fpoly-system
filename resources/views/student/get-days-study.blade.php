@extends('student.home')
@section('content-student')

    <div class="container-fluid  p-4">
      <div class="box p-4">
        <div class="title p-2 mb-5 alert-primary-neo text-center">Lịch học</div>
        <div class="px-lg-5 table-responsive ">
              <table class="stripe text-center" id="datatable" >
                  <thead>
                      <tr>
                          <th>#</th>
                          <th class="row-width-200">Ngày học</th>
                          <th class="row-width-200">Môn học</th>
                          <th class="row-width-300">Ca học</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($classSubjectDays as $key => $detail)
                          <tr style="{{ $detail->day_checked=='true'? 'background-color: lightcyan;':'' }}">
                              <td>{{ ++$key }}</td>
                              <td> ({{ $detail->day_name }})  {{ $detail->date }}</td>
                              <td>{{ $detail->subject_name }}</td>
                              <td >{{ $detail->study_time_name }} ({{ $detail->study_time_start }} - {{ $detail->study_time_end }})</td>
                              <td>
                                  <button class="btn btn-link" data-toggle="modal" data-target="#exampleModalCenter"> Chi tiết</button>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
                  

              </table>
              <!-- (Chi tiết môn học (ẩn)) -->
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Nội dung bài học </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <p> 1. Bài Giới thiệu </p>
                          <p> 2. Bài tập về nhà </p>
                      </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
