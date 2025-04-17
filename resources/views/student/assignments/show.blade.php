@extends('layouts.student')

@section('content')
    <h1>課題詳細：{{ $assignment->title }}</h1>

    @if(session('success'))
        <div style="color: green; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    <p><strong>説明:</strong> {{ $assignment->description }}</p>
    <p><strong>締切:</strong> {{ $assignment->deadline }}</p>
    <p><strong>満点:</strong> {{ $assignment->max_score }} 点</p>

    <hr>

    <h2>課題を提出する</h2>

    <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label>ファイル:</label>
        <input type="file" name="file" required>
    </div>

    <div>
        <label>コメント:</label>
        <textarea name="comment"></textarea>
    </div>

    <button type="submit">提出する</button>
</form>

@endsection
