@extends('layouts.student')

@section('content')
    <h1>{{ $assignment->title }} の提出一覧</h1>

    @if($submissions->isEmpty())
        <p>まだ提出はありません。</p>
    @else
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>学生名</th>
                    <th>コメント</th>
                    <th>提出日時</th>
                    <th>ファイル</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $submission)
                    <tr>
                        <td>{{ $submission->user->name }}</td>
                        <td>{{ $submission->comment }}</td>
                        <td>{{ $submission->submitted_at }}</td>
                        <td>
                            @if(Storage::exists('public/' . $submission->file_path))
                                <a href="{{ route('files.show', basename($submission->file_path)) }}" target="_blank">ファイルを見る</a>
                            @else
                                <span style="color:red;">ファイルが存在しません</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
