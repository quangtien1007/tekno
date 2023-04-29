@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Cập nhật tài khoản</div>
            <div class="card-body">
            <div>
                <form action="{{ route('admin.quyen.add') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label>Quyền</label>
                        <input type="text" value="{{ old('display_name')}}" name="display_name"
                        class="form-control">
                        @error('display_name')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Tên</label>
                        <input type="text" value="{{ old('name') }}" name="name" class="form-control">
                        @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label name="group" class="ms-0">Nhóm quyền</label>
                        <select name="group" class="form-control">
                            <option value="Hệ thống">Hệ thống</option>
                            <option value="Khách hàng">Khách hàng</option>
                        </select>

                        @error('group')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="">Các loại quyền</label>
                        <div class="row">
                            @foreach ($permissions as $groupName => $permission)
                                <div class="col-3">
                                    <h4>{{ $groupName }}</h4>

                                    <div style="background:#198754;color:white;border-radius:20px;padding:10px 0">
                                        @foreach ($permission as $item)
                                            <div class="form-check">
                                                <input class="form-check-input" name="permission_ids[]" type="checkbox"
                                                    style="margin-left:10px"
                                                    value="{{ $item->id }}">
                                                <label style="margin-left:5px" class="custom-control-label"
                                                    for="customCheck1">{{ $item->display_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-success"><i class="fal fa-save"></i> Thêm mới</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

