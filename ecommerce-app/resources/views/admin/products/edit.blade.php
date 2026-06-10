@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
@include('admin.partials.page-header', ['title' => 'Edit Product', 'breadcrumb' => 'Edit'])

<div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.products._form', ['product' => $product, 'categories' => $categories])
    </form>
</div>
@endsection
