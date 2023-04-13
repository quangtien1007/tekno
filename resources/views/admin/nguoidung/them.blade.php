@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Thêm tài khoản</div>
            <div class="card-body">
                <form action="{{ route('admin.nguoidung.add') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="name">Họ và tên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required />
                        @error('name')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Địa chỉ email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required />
                        @error('email')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="role">Quyền hạn</label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="is_admin" required>
                            <option value="">-- Chọn --</option>
                            <option value="1">Quản trị viên</option>
                            <option value="0" selected>Khách hàng</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">Mật khẩu</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required />
                        @error('password')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password_confirmation">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required />
                        @error('password_confirmation')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success"><i class="fal fa-user-plus"></i> Thêm người dùng</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
