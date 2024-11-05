@extends('admin.layouts.app-page')
@section('title', 'quản lý vai trò')
@section('content')

    <div class=" container">
        <h3 class="text-center my-5"> Chỉnh sửa vai trò</h3>
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Tên</label>
                <input name="name" type="text" value="{{ old('name') ?? $role->name }}" class="form-control">

                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Tên hiển thị</label>
                <input name="display_name" type="text" value="{{ old('display_name') ?? $role->display_name }}"
                    class="form-control">


                @error('display_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Nhóm</label>
                <select name="group" id="" class="form-control bg-white" value={{ $role->group }}>
                    <option value="user">Người dùng</option>
                    <option value="system">Hệ thống</option>
                </select>

                @error('group')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item offset-md-2 pb-3 my-3 ">
                <label class="form-label">Quyền hạn</label>
                @error('permission_ids')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="row">
                    @foreach ($permissions as $groupName => $permission)
                        <div class="col-md-6">
                            <h6 class="mb-0 text-dark py-4">{{ $groupName }}</h6>
                            @foreach ($permission as $item)
                                <div class="form-check text-start">
                                    <input type="checkbox" id="{{ $item->id }}" class="form-check-input border-1"
                                        name="permission_ids[]" value="{{ $item->id }}"
                                        {{ $role->permissions->contains('name', $item->name) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="{{ $item->id }}">{{ $item->display_name }}</label>
                                </div>
                            @endforeach


                        </div>
                    @endforeach

                </div>

            </div>
            </tbody>

            <div class="my-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary text-white text-center"
                    style="padding: 15px 45px; font-size: 1.25rem;">Cập nhật</button>
            </div>

        </form>
    </div>

@endsection
