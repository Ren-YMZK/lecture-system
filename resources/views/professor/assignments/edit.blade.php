@extends('layouts.professor')

@section('content')
    <h1 class="text-2xl font-bold mb-4">課題編集</h1>

    <form action="{{ route('professor.assignments.update', $assignment->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">タイトル:</label>
            <input type="text" name="title" value="{{ old('title', $assignment->title) }}" required class="w-full border border-gray-300 rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">説明:</label>
            <textarea name="description" class="w-full border border-gray-300 rounded p-2">{{ old('description', $assignment->description) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">締切:</label>
            <input type="datetime-local" name="deadline" value="{{ old('deadline', \Carbon\Carbon::parse($assignment->deadline)->format('Y-m-d\TH:i')) }}" required class="border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">満点:</label>
            <input type="number" name="max_score" value="{{ old('max_score', $assignment->max_score) }}" required class="border rounded p-2 w-24">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            更新する
        </button>
    </form>
@endsection
