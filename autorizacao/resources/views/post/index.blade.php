<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Posts</title>
    </head>
<body>
    <ul>
        @foreach ($posts as $post)
            <li>
                {{ $post->title }} Author: {{ $post->user->name }} #{{ $post->user->id }} 
                @can ('update-post', $post)
                - <a class="btn btn-danger" href="#">Edit</a>
                @endcan
            </li>
        @endforeach
    </ul>
</body>
</html>