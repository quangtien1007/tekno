@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Cập nhật tài khoản</div>
            <div class="card-body">
            <div>
                <form action="{{ route('admin.quyen.update', $role->id) }}" method="post">
                    @csrf
                    @method('PUT')


                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" value="{{ old('name') ?? $role->name }}" name="name" class="form-control">

                        @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Quyền</label>
                        <input type="text" value="{{ old('display_name') ?? $role->display_name }}" name="display_name"
                            class="form-control">
                        @error('display_name')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="    mb-3">
                        <label name="group" class="ms-0">Nhóm quyền</label>
                        <select name="group" class="form-control" value={{ $role->group }}>
                            <option value="system">System</option>
                            <option value="user">User</option>

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
                                                    {{-- {{ $role->permissions->contains('name', $item->name) ? 'checked' : '' }} --}}
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
                    <button type="submit" class="btn btn-success"><i class="fal fa-save"></i> Cập nhật</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

