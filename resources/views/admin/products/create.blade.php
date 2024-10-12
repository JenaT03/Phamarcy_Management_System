@extends('admin.layouts.app-page')
@section('title', 'Sản phẩm')
@section('content')

    <div class=" container">
        <h3 class="text-center my-5"> Thêm sản phẩm mới</h3>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Hình ảnh </label>
                <input type="file" accept="image/*" id="image-input" class="form-control bg-white" name = "img">
                <div class="mt-2">
                    <img src="" id="show-image" width="300px">
                </div>
                @error('img')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Mã số</label>
                <input type="text" class="form-control" name = "code" value="{{ $productCode }}" readonly>
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Tên sản phẩm </label>
                <input type="text" class="form-control" name = "name" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Mô tả </label>
                <textarea name="description" class="form-control editor" cols="30" rows="10" spellcheck="false">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Thành phần </label>
                <textarea name="ingredient" class="form-control editor" cols="30" rows="10" spellcheck="false">{{ old('ingredient') }}</textarea>
                @error('ingredient')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Hướng dẫn sử dụng </label>
                <textarea name="intruction" class="form-control editor" cols="30" rows="10" spellcheck="false">{{ old('intruction') }}</textarea>

            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Phân loại </label>
                @foreach ($categories as $item)
                    <div class="form-check text-start">
                        <input type="checkbox" id="{{ $item->id }}" class="form-check-input border-1"
                            name="category_ids[]" value="{{ $item->id }}"
                            {{ is_array(old('category_ids')) && in_array($item->id, old('category_ids')) ? 'checked' : '' }}>

                        <label class="form-check-label" for="{{ $item->id }}">{{ $item->name }}</label>
                    </div>
                @endforeach

                @error('category_ids')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Đơn vị sản phẩm </label>
                <select name="unit" class="form-control bg-white">
                    <option value="">Chọn</option>
                    <option value="Hộp">Hộp</option>
                    <option value="Chai">Chai</option>
                    <option value="Túi">Túi</option>
                    <option value="Tuýt">Tuýt</option>
                    <option value="Que">Que</option>
                    <option value="Miếng">Miếng</option>
                    <option value="Thỏi">Thỏi</option>
                    <option value="Lọ">Lọ</option>
                    <option value="Thỏi">Lon</option>

                </select>
            </div>


            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Nhãn hàng </label>
                <select name="brand_id" class="form-control bg-white">
                    <option value="">Chọn</option>
                    @foreach ($brands as $item)
                        <option value="{{ $item->id }}" {{ old('brand_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>



            <div class="my-3 mt-5 d-flex justify-content-between">

                <a href="{{ route('products.index') }}" class="btn btn-primary text-white text-center"
                    style="padding: 15px 30px; font-size: 1.25rem;">Quay lại</a>

                <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                    style="padding: 15px 45px; font-size: 1.25rem;">Thêm</button>

            </div>

        </form>
    </div>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(() => {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#show-image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image-input").change(function() {
                readURL(this);
            });



        });
    </script>

    <script type="importmap">
			{
				"imports": {
					"ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js",
					"ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.2.0/"
				}
			}
	</script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font
        } from 'ckeditor5';

        // Tìm tất cả các phần tử có class 'editor'
        document.querySelectorAll('.editor').forEach(editorElement => {
            ClassicEditor
                .create(editorElement, {
                    plugins: [Essentials, Paragraph, Bold, Italic, Font],
                    toolbar: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                })
                .then(editor => {
                    window.editor = editor;
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>

    <!-- A friendly reminder to run on a server, remove this during the integration. -->
    <script>
        window.onload = function() {
            if (window.location.protocol === 'file:') {
                alert('This sample requires an HTTP server. Please serve this file with a web server.');
            }
        };
    </script>



@endsection
