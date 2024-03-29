<button id="open-modal-update-subject" type="button" style="display:none;" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:100% !important">
        <div class="modal-content">
            <div class="container-fluid py-3">
                <form id="form-update-users" enctype="multipart/form-data">
                    <div class="box cong-cu-phan-lop p-4">
                        <h3 class="alert-primary-neo mx-lg-4 p-3 text-center">CẬP NHẬT THÔNG TIN GIẢNG VIÊN</h3> 
                        <div class="py-lg-5  px-lg-5">
                            <div class="row">
                                <div class="col-lg-4 text-center">
                                    <div id="avatar" style="background-image:url({{ $user->avatar_img_path }})"></div>
                                    <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" id="close-modal">
                                        <span style="font-size: 33pt" aria-hidden="true"><i class="fas fa-sign-out-alt"></i></span>
                                    </button>
                                    {{-- <img src="{{ $users->avatar_img_path }}" alt="{{ $users->avatar_img_path }}" style="width:100%"> --}}
                                </div>
                                <div class="col-lg-8 ">
                                    <div class="row">
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <label for=""> Tên đăng nhập:   </label> 
                                            <input type="hidden" value="{{ $user->uuid }}" name="uuid">
                                            <input class="form-control" disabled value="{{ $user->user_name }}"/>
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <label for="full_name"> Họ và Tên: </label>
                                            <input type="text" id="full_name" name="full_name" value="{{ $user->full_name }}" class="form-control ">
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <label for="sex"> Giới tính: </label>
                                            <select name="sex" id="sex" class="form-control">
                                                <option value="Nam" {{ $user->sex == 'Nam'?'selected':'' }}>Nam</option>
                                                <option value="Nữ" {{ $user->sex == 'Nữ'?'selected':'' }}>Nữ</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <label for="phone_number">Số điện thoại:</label>
                                            <input type="text" name="phone_number" id="phone_number"  value="{{ $user->phone_number }}" class="form-control">
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <label for="email">Email:</label>
                                            <input type="text" id="email" name="email" value="{{ $user->email }}" class="form-control">
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <label for="address"> Địa chỉ</label>
                                            <input type="text" id="address" name="address" value="{{ $user->address }}" class="form-control">
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2" style="overflow:hidden">
                                            <label for=""> Hình đại diện</label>
                                            <input type="file" name="avatar_img_path" value="{{ $user->avatar_img_path }}" class="form-control" >
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <label for=" ">  &nbsp; </label>
                                            <button type="button" id="buttonUpdate" class="btn btn-success-neo btn-block">Cập nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(()=> {
        $('#open-modal-update-subject').click();
        $('#buttonUpdate').click(function(){
            var formData = new FormData();
            var formUpdate      = $('#form-update-users')
            var uuid              = formUpdate.find('input[name="uuid"]')
            var fullName        = formUpdate.find('input[name="full_name"]')
            var phoneNumber     = formUpdate.find('input[name="phone_number"]')
            var email           = formUpdate.find('input[name="email"]')
            var sex             = formUpdate.find('select[name="sex"]')
            var address         = formUpdate.find('input[name="address"]')
            var avatarImgPath   = formUpdate.find('input[name="avatar_img_path"]')
            var _tokenStudent = '{{ csrf_token() }}'

            var fileAvatar = avatarImgPath[0].files[0]?avatarImgPath[0].files[0]:null;

            formData.append('_method', 'PUT');
            formData.append('uuid', uuid.val());
            formData.append('full_name', fullName.val());
            formData.append('phone_number', phoneNumber.val());
            formData.append('email', email.val());
            formData.append('sex', sex.val());
            formData.append('address', address.val());
            formData.append('avatar_img_path', fileAvatar);
            // console.log(fileAvatar)
            $.ajax({
                type: 'POST',
                data: formData,
                url: '{{ route('update-user-put') }}',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': _tokenStudent,
                },
                success(data){
                    // console.log(data)
                    if(data.Status !=200){
                        if(typeof data.Message == 'object'){
                            $.each(data.Message, function(key, value){
                                toastMess (this, 5000,'error');
                            })
                        }else{
                            toastMess (data.Message,5000, 'error')
                        }
                    }else{
                        toastMess (data.Message,5000)
                        $('#close-modal').click()
                        $("#load-com-users").html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>')
                        .attr('style', 'position: fixed; top: 50%; z-index: 2; left: 50%;');
                        loadAjax($("#load-com-users"), '{{ route('com-users') }}');
                        $("#load-com-users").attr('style', '')
                    }
                },
                error(data){
                    console.log(data)
                }
            })
        })
    })
    function loadAjax(component, route){
        component.load(route);
    };
</script>