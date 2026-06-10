@extends('admin.layouts.app')

@section('title', 'Add Product')

@section('content')
@include('admin.partials.page-header', ['title' => 'Add Product', 'breadcrumb' => 'Create'])

<div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.products._form', ['product' => null, 'categories' => $categories])
    </form>
</div>
@endsection
