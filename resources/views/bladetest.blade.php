@extends('layouts.master')

@section('title', 'Blade Syntax Test')

@section('content')
    <h2>Using Other Blade Files</h2>
    <p>This section demonstrates:</p>
    <pre>
@verbatim
@section, @include, @extends
@endverbatim
    </pre>

    <h2>Displaying Variables</h2>
    <p>Escaped Output: {{ $username }}</p>
    <p>Raw Output: {!! $rawHtml !!}</p>

    <h2>Loop and Control Syntax</h2>

    <h3>Conditional Statements</h3>
    @if($isLoggedIn)
        <p>Welcome back, {{ $username }}!</p>
    @else
        <p>Please log in.</p>
    @endif

    <h3>For Loop Example</h3>
    <ul>
        @for($i = 1; $i <= 3; $i++)
            <li>Item {{ $i }}</li>
        @endfor
    </ul>

    <h3>Foreach Loop Example</h3>
    <ul>
        @foreach($tasks as $task)
            <li>{{ $task }}</li>
        @endforeach
    </ul>
@endsection
