@extends('layouts.professor')

@section('content')
    <h1 class="text-2xl font-bold mb-4">講義一覧（教授）</h1>

    @if($courses->isEmpty())
        <p>まだ講義はありません。</p>
    @else
        <ul class="space-y-4">
            @foreach($courses as $course)
                <li class="border rounded p-4 bg-white shadow">
                    <strong class="text-lg">{{ $course->title }}</strong><br>
                    {{ $course->description }}

                    <div class="mt-2 space-x-2">
                        <!-- 編集ボタン -->
                        <a href="{{ route('professor.courses.edit', $course->id) }}"
                           class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                            編集
                        </a>

                        <!-- 削除ボタン -->
                        <form action="{{ route('professor.courses.destroy', $course->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('本当に削除しますか？')"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                削除
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
