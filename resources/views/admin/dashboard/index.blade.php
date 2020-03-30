@extends('admin.admin')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="content">
    <ol>
    @foreach ($payments as $items)
       <li>{{ $items }}</li>

    @endforeach
    </ol>
</div>

@endsection
