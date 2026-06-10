@extends('admin.layouts.app')

@section('title', 'Add Category')

@section('content')
@include('admin.partials.page-header', ['title' => 'Add Category', 'breadcrumb' => 'Create'])

<div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.categories._form', ['category' => null, 'parentOptions' => $parentOptions])
    </form>
</div>
@endsection
