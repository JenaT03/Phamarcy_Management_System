@extends('admin.layouts.app-page')
@section('title', 'Quản lý website')
@section('content')
    <div class="row g-0 pt-3 bg-white">
        @can('banner_website')
            <a href="{{ route('website.banners.index') }}" class="col-4 text-center py-2 ">BANNER</a>
        @endcan
        @can('news_website')
            <a href="{{ route('website.news.index') }}" class="col-4 text-center py-2 border-cus fw-bold">TIN TỨC</a>
        @endcan
        @can('introduce_website')
            <a href="{{ route('website.introduce.index') }}" class="col-4 text-center py-2 ">GIỚI THIỆU</a>
        @endcan

    </div>
    <div class="container-fluid fruite ">

        <div class="container py-5">
            <div class="bg-white mt-2 rounded py-3">
                <h3 class="text-center my-5"> Thêm tin tức mới</h3>
                <form action="{{ route('website.news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                        <label class="form-label">Hình ảnh </label>
                        <input type="file" accept="image/*" id="image-input" class="form-control bg-white"
                            name = "img">
                        <div class="mt-2">
                            <img src="" id="show-image" width="300px">
                        </div>
                        @error('img')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" name = "title" value="{{ old('title') }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                        <label class="form-label">Phần giới thiệu</label>
                        <textarea name="abstract" class="form-control editor" cols="30" rows="40" spellcheck="false">{{ old('abstract') }}</textarea>
                        @error('abstract')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                        <label class="form-label">Nội dung</label>
                        <textarea name="content" class="form-control editor" cols="30" rows="40" spellcheck="false">{{ old('content') }}</textarea>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                        <label class="form-label">Tác giả</label>
                        <input type="text" class="form-control" name = "author" value="{{ old('author') }}">
                        @error('author')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                        <label for="highlight">Nổi bật</label>
                        <input type="checkbox" id="highlight" name="highlight" value="1"
                            class="form-check-input border-1">
                    </div>
                    <input type="text" name="staff_id" value="{{ $staff->id }}" hidden>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                            style="padding: 15px 45px; font-size: 1.25rem;">Tạo</button>
                    </div>

                </form>
            </div>
        </div>
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
            if (window.location.protocol === 'file:') {}
        };
    </script>



@endsection
