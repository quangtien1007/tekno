@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Cập nhật tài khoản</div>
            <div class="card-body">
                <form action="{{ route('admin.nguoidung.update', ['id' => $nguoidung->id]) }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="name">Họ và tên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $nguoidung->name }}" required />
                        @error('name')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Địa chỉ email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $nguoidung->email }}" required />
                        @error('email')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    {{-- {{dd($nguoidung->is_admin)}} --}}
                    <div class="mb-3">
                        <label class="form-label" for="role">Quyền hạn</label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="is_admin" required>
                            <option value="">-- Chọn --</option>
                            <option value="1" {{ ($nguoidung->is_admin == 1) ? 'selected' : '' }}>Quản trị viên</option>
                            <option value="0" {{ ($nguoidung->is_admin == 0) ? 'selected' : '' }}>Khách hàng</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="">Quyền</label>
                        <div class="row">
                            @foreach ($roles as $groupName => $role)
                                <div class="col-5">
                                    <div>
                                        @foreach ($role as $item)
                                        <div class="form-check">
                                                <input id="role_ids{{$loop->iteration}}" class="form-check-input @error('role_ids') is-invalid @enderror" name="role_ids[]" type="checkbox"
                                                    value="{{ $item->id }}">
                                                <label class="custom-control-label"
                                                    for="role_ids{{$loop->iteration}}">{{ $item->display_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('role_ids')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <label class="form-label" for="role">Đổi mật khẩu</label>
                    <div class="mb-3 form-check">
                        <label class="form-label" for="change_password_checkbox">Đổi mật khẩu</label>
                        <input class="form-check-input" type="checkbox" id="change_password_checkbox" name="change_password_checkbox" />
                    </div>

                    <div id="change_password_group">
                        <div class="mb-3">
                            <label class="form-label" for="password">Mật khẩu mới</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" />
                            @error('password')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" />
                            @error('password_confirmation')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success"><i class="fal fa-save"></i> Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#change_password_group").hide();
			$("#change_password_checkbox").change(function() {
				if($(this).is(":checked"))
				{
					$("#change_password_group").show();
					$("#change_password_group :input").attr("required", "required");
				}
				else
				{
					$("#change_password_group").hide();
					$("#change_password_group :input").removeAttr("required");
				}
			});
		});
	</script>
@endsection
