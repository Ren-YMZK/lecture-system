@extends('layouts.student')

@section('content')
    <h1>講義一覧（教授）</h1>

    @if($courses->isEmpty())
        <p>まだ講義はありません。</p>
    @else
        <ul>
            @foreach($courses as $course)
                <li style="margin-bottom: 10px;">
                    <strong>{{ $course->title }}</strong><br>
                    {{ $course->description }}

                    <!-- 編集ボタン -->
                    <a href="{{ route('professor.courses.edit', $course->id) }}"
                       style="display:inline-block; padding: 6px 12px; background-color: #4A90E2; color: white; border: none; border-radius: 4px; text-decoration: none; margin-right: 10px;">
                        編集
                    </a>

                    <!-- 削除ボタン -->
                    <form action="{{ route('professor.courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('本当に削除しますか？')"
                                style="padding: 6px 12px; background-color: #E24A4A; color: white; border: none; border-radius: 4px;">
                            削除
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
