<form method="GET" class="d-flex col-md-8 offset-md-2 pb-3 my-3" role="search">
    <input id="searchInput" class="form-control me-2 rounded-pill" type="search" placeholder="Tìm kiếm"
        aria-label="Search" />
    <button type="button" id="searchBtn" class="btn btn-primary border-0 border-secondary rounded-pill text-white">
        <i class="icon_search fa-solid fa-magnifying-glass"></i>
    </button>
</form>

<!-- Kết quả tìm kiếm -->
<div id="searchResults" class="search-results d-none col-md-8 offset-md-2">
    <button class="close-btn" onclick="closeResults()"><i class="fa-solid fa-circle-xmark"></i></button>
    <ul id="resultsList">
        <!-- Kết quả tìm kiếm sẽ được thêm vào đây -->
    </ul>
</div>

@section('script')
    <script>
        document.getElementById('searchBtn').addEventListener('click', showResults);
        document.getElementById('searchInput').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                showResults();
            }
        });

        function showResults() {
            const query = document.getElementById('searchInput').value;
            fetch('{{ route('products.searchProduct') }}', {
                    method: 'POST', // Đặt phương thức là POST
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Thêm CSRF token
                    },
                    body: JSON.stringify({
                        query: query
                    }) // Gửi dữ liệu dưới dạng JSON
                })
                .then(response => response.json())
                .then(products => {
                    const resultsList = document.getElementById('resultsList');
                    resultsList.innerHTML = '';
                    if (products.length === 0) {
                        const li = document.createElement('li');
                        li.textContent = `Không có sản phẩm nào có tên ${query}`;
                        resultsList.appendChild(li);
                    } else {
                        products.forEach(product => {
                            const li = document.createElement('li');
                            li.innerHTML = `<strong>${product.code}</strong> -  ${product.name}`;
                            resultsList.appendChild(li);
                        });
                    }
                    document.getElementById('searchResults').classList.remove('d-none');
                });
        }


        function closeResults() {
            document.getElementById('searchResults').classList.add('d-none');
        }
    </script>
@endsection
