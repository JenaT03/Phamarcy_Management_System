@extends('admin.layouts.app-page')
@section('title', 'Quản lý website')
@section('content')

    <div class="row g-0 pt-3 bg-white">
        <a href="{{ route('website.banners.index') }}" class="col-4 text-center py-2 ">BANNER</a>
        <a href="{{ route('website.news.index') }}" class="col-4 text-center py-2 ">TIN TỨC</a>
        <a href="{{ route('website.introduce.index') }}" class="col-4 text-center py-2 border-cus fw-bold">GIỚI THIỆU</a>

    </div>
    <div class="container-fluid fruite ">
        <div class=" container my-5 bg-white p-5">
            <h3 class="text-center "> Chỉnh sửa giới thiệu</h3>
            <form action="{{ route('website.introduce.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-item pb-3 my-3">
                    <label class="form-label">Nội dung</label>
                    <textarea name="content" class="form-control editor" cols="40" rows="30" spellcheck="false">{{ old('content') ?? $introduce->content }}</textarea>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-center"><button type="submit" name="submit"
                        class="btn btn-primary text-white text-center" style="padding: 15px 45px; font-size: 1.25rem;">Cập
                        nhật</button></div>

            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

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
