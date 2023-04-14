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
