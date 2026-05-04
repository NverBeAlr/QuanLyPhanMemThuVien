@extends('layouts.layout_student')

@section('title', 'Mượn sách')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .student-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .book-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .book-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
            background-color: #fafafa;
        }
        .book-item h3 {
            margin-top: 0;
            color: #555;
        }
        .book-item p {
            margin: 5px 0;
        }
        .borrow-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .borrow-btn:hover {
            background-color: #218838;
        }
        .borrow-btn:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }
        .selected {
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .submit-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
        @media (max-width: 768px) {
            .book-item {
                width: calc(50% - 20px);
            }
        }
        @media (max-width: 480px) {
            .book-item {
                width: 100%;
            }
        }
    </style>

    <div class="student-container">
        <h1>Mượn Sách</h1>

        @if(session('success'))
            <p style="color: green; text-align: center;">{{ session('success') }}</p>
        @endif

        @if($errors->any())
            <div style="color: red; text-align: center;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="borrowForm" method="POST" action="{{ route('student.borrow.submit') }}">
            @csrf

            <div class="form-group">
                <label for="return_date">Ngày Trả Dự Kiến:</label>
                <input type="date" id="return_date" name="return_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
            </div>

            <h2>Sách Có Sẵn</h2>
            <div class="book-list" id="bookList">
                @foreach($books as $book)
                    <div class="book-item" data-id="{{ $book->id }}">
                        <h3>{{ $book->title }}</h3>
                        <p><strong>Tác Giả:</strong> {{ $book->author->name ?? 'Không rõ' }}</p>
                        <p><strong>Thể Loại:</strong> {{ $book->category->name ?? 'Không rõ' }}</p>
                        <p><strong>Số Bản Sao Có Sẵn:</strong> {{ $book->available_copies ?? 0 }}</p>
                        <button type="button" class="borrow-btn" onclick="selectBook({{ $book->id }}, this)" {{ $book->available_copies < 1 ? 'disabled' : '' }}>
                            {{ $book->available_copies < 1 ? 'Không Có Sẵn' : 'Chọn Để Mượn' }}
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <h2>Sách Đã Chọn</h2>
                <ul id="selectedBooks"></ul>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn" disabled>Mượn Sách Đã Chọn</button>
        </form>
    </div>

    <script>
        let selectedBooks = [];

        function selectBook(bookId, button) {
            const bookItem = button.parentElement;
            const index = selectedBooks.indexOf(bookId);

            if (index > -1) {
                selectedBooks.splice(index, 1);
                bookItem.classList.remove('selected');
                button.textContent = 'Chọn Để Mượn';
            } else {
                selectedBooks.push(bookId);
                bookItem.classList.add('selected');
                button.textContent = 'Bỏ Chọn';
            }

            updateSelectedList();
            updateSubmitButton();
        }

        function updateSelectedList() {
            const list = document.getElementById('selectedBooks');
            list.innerHTML = '';
            selectedBooks.forEach(id => {
                const li = document.createElement('li');
                li.textContent = `ID Sách: ${id}`;
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'book_ids[]';
                hiddenInput.value = id;
                li.appendChild(hiddenInput);
                list.appendChild(li);
            });
        }

        function updateSubmitButton() {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = selectedBooks.length === 0;
        }
    </script>
@endsection
