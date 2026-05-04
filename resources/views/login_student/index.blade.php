@extends('layouts.frontpage')

@section('title', 'Mượn sách')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">Mượn sách</h1>
            <p class="text-secondary mb-0">Chào mừng, {{ auth('student')->user()->name ?? 'Sinh viên' }}.</p>
        </div>
        <form method="POST" action="{{ route('student.logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Đăng xuất</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="borrowForm" method="POST" action="{{ route('student.borrow.submit') }}">
        @csrf

        <div class="card mb-4">
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="return_date" class="col-sm-3 col-form-label fw-semibold">Ngày trả dự kiến</label>
                    <div class="col-sm-5">
                        <input type="date" id="return_date" name="return_date" class="form-control" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Danh sách sách có sẵn</h5>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-2 g-3" id="bookList">
                            @foreach($books as $book)
                                <div class="col">
                                    <div class="card h-100 book-item" data-id="{{ $book->id }}">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $book->title }}</h6>
                                            <p class="mb-1"><strong>Tác giả:</strong> {{ $book->author->name ?? 'Không rõ' }}</p>
                                            <p class="mb-1"><strong>Thể loại:</strong> {{ $book->category->name ?? 'Không rõ' }}</p>
                                            <p class="mb-2"><strong>Số bản:</strong> {{ $book->available_copies ?? 0 }}</p>
                                            <button type="button" class="btn btn-sm btn-success w-100 borrow-btn" onclick="selectBook({{ $book->id }}, this)" {{ $book->available_copies < 1 ? 'disabled' : '' }}>
                                                {{ $book->available_copies < 1 ? 'Không có sẵn' : 'Chọn để mượn' }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Sách đã chọn</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group mb-3" id="selectedBooks"></ul>
                        <button type="submit" class="btn btn-primary w-100" id="submitBtn" disabled>Mượn sách đã chọn</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    let selectedBooks = [];

    function selectBook(bookId, button) {
        const bookItem = button.closest('.book-item');
        const index = selectedBooks.indexOf(bookId);

        if (index > -1) {
            selectedBooks.splice(index, 1);
            bookItem.classList.remove('border-success');
            button.textContent = 'Chọn để mượn';
            button.classList.remove('btn-danger');
            button.classList.add('btn-success');
        } else {
            selectedBooks.push(bookId);
            bookItem.classList.add('border', 'border-success');
            button.textContent = 'Bỏ chọn';
            button.classList.remove('btn-success');
            button.classList.add('btn-danger');
        }

        updateSelectedList();
        updateSubmitButton();
    }

    function updateSelectedList() {
        const list = document.getElementById('selectedBooks');
        list.innerHTML = '';

        selectedBooks.forEach(id => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.textContent = `Sách ID: ${id}`;

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'book_ids[]';
            hiddenInput.value = id;
            li.appendChild(hiddenInput);
            list.appendChild(li);
        });
    }

    function updateSubmitButton() {
        document.getElementById('submitBtn').disabled = selectedBooks.length === 0;
    }
</script>
@endsection
