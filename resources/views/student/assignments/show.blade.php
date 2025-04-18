@extends('layouts.student')

@section('content')
    <h1 class="text-2xl font-bold mb-4">課題詳細：{{ $assignment->title }}</h1>

    @if(session('success'))
        <div class="text-green-600 font-semibold mb-4">
            {{ session('success') }}
        </div>
    @endif

    <p><strong>説明:</strong> {{ $assignment->description }}</p>
    <p><strong>締切:</strong> {{ $assignment->deadline }}</p>
    <p><strong>満点:</strong> {{ $assignment->max_score }} 点</p>

    @if(isset($submission) && $submission)
        <p><strong>あなたの得点：</strong>
            @if($submission->score !== null)
                {{ $submission->score }} 点
            @else
                未採点
            @endif
        </p>
    @endif

    <hr class="my-4">

    <h2 class="text-lg font-semibold mb-2">課題を提出する</h2>

    <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold mb-1">ファイル:</label>
            <input type="file" name="file" required class="w-full border border-gray-300 rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">コメント:</label>
            <textarea name="comment" class="w-full border border-gray-300 rounded p-2"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            提出する
        </button>
    </form>
@endsection
