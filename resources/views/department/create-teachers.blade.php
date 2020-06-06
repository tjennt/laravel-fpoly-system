
<h2 class="text-center alert alert-success">Tạo giáo viên </h2>
<form method="POST" action="{{ route('create-teachers-excel') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group col-lg-8 mx-auto">
        <label for="excelTeachers">Excel File</label>
        <input id="excelTeachers" class="form-control" type="file" name="excelTeachers">
    </div>
    {{-- EXCEL FILE<input type="file" name="excel"> --}}
    <div class="form-group col-lg-8 mx-auto">
        <button id="BtcreateTeachers" class="btn btn-primary" type="button">Lưu</button>
    </div>
</form>

<script>
    $('#BtcreateTeachers').click( () => {
        let  _tokenTeacher = '{{ csrf_token() }}';
        let excel        = $("#excelTeachers");
        let messSuccess = $("#resultAjaxSuccess");
        let messError   = $("#resultAjaxError");
        let formData = new FormData();
        // console.log(excel[0].value);
        formData.append('excel', excel[0].files[0]);
        // console.log(formData.get('excel'));
        $.ajax({
            type:'POST',
            data: formData,
            url:'{{ route('create-teachers-excel') }}',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': _tokenTeacher,
            },
            success:function(data) {
                if(data.Status == 200){
                    messSuccess.html(data.Message).removeClass('d-none');
                    setTimeout( () => { messSuccess.addClass('d-none').html('')  }, 5000);
                    console.log(data);
                }else{
                    messError.removeClass('d-none');
                    if(typeof data.Message == 'object'){
                        $.each(data.Message, function(key, value){
                            messError.append(this + '<br>');
                        });
                    }else{
                        messError.html(data.Message);
                    }
                    setTimeout( () => { messError.addClass('d-none').html('')  }, 5000);
                    console.log(data);
                }
            },
            error: function(data) {
                messError.html(data).removeClass('d-none');
                setTimeout( () => { messError.addClass('d-none').html('')  }, 5000);
                console.log(data.Message);
            }
        });
    });
</script>