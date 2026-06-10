@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
@include('admin.partials.page-header', ['title' => 'Edit Category', 'breadcrumb' => 'Edit'])

<div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.categories._form')
    </form>
</div>
@endsection
