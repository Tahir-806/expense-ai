@extends('layouts.app')
@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f4f7fd 0%, #e9eefb 100%);
        min-height: 100vh;
    }
    .categories-edit-container {
        min-height: 70vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }
    .categories-edit-card {
        width: 100%;
        max-width: 420px;
        border-radius: 2rem;
        background: #fff;
        box-shadow: 0 12px 32px 0 rgba(31, 38, 135, 0.12);
        padding: 2.2rem 2rem 2rem 2rem;
        margin-top: 2.5rem;
    }
    .categories-edit-header {
        font-weight: 700;
        font-size: 1.75rem;
        color: #2563eb;
        text-align: center;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
    }
    .categories-edit-header .bi {
        font-size: 2rem;
    }
    .categories-edit-form .form-group {
        margin-bottom: 1.2rem;
        display: flex;
        flex-direction: column;
    }
    .categories-edit-form .form-label {
        font-weight: 600;
        color: #2563eb;
        font-size: 1rem;
        margin-bottom: 0.25rem;
        margin-left: 2px;
    }
    .categories-edit-form .form-control,
    .categories-edit-form .form-select {
        border-radius: 1rem;
        font-size: 1.06rem;
        padding: 0.7rem 1rem;
    }
    .categories-edit-form .btn-primary {
        background: linear-gradient(90deg, #38b6ff 0%, #2563eb 100%);
        border: none;
        font-weight: 600;
        padding: 0.65rem 2.1rem;
        border-radius: 2rem;
        box-shadow: 0 3px 12px rgba(56, 163, 220, 0.13);
        transition: transform 0.14s, box-shadow 0.16s;
        width: 100%;
        font-size: 1.07rem;
        margin-top: 0.7rem;
        color: #fff;
    }
    .categories-edit-form .btn-primary:hover {
        transform: scale(1.04) translateY(-2px);
        box-shadow: 0 6px 24px rgba(56, 163, 220, 0.19);
        color: #fff;
    }
    .categories-edit-form .btn-secondary {
        border-radius: 2rem;
        font-weight: 500;
        margin-bottom: 1.2rem;
        background: #f4f7fd;
        color: #2563eb;
        border: 1px solid #2563eb;
        transition: background 0.13s, color 0.13s;
        width: 100%;
        margin-top: -0.5rem;
        margin-bottom: 1.2rem;
    }
    .categories-edit-form .btn-secondary:hover {
        background: #2563eb;
        color: #fff;
    }
</style>
<div class="categories-edit-container container py-5">
    <div class="categories-edit-card">
        <div class="categories-edit-header">
            <i class="bi bi-pencil-square"></i> Edit Category
        </div>
        {{-- Back Button --}}
        <a href="{{ route('categories.index') }}" class="btn btn-secondary categories-edit-form mb-3">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
        {{-- Edit Category Form --}}
        <form method="POST" action="{{ route('categories.update', $category->id) }}" class="categories-edit-form mt-2">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label" for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $category->name) }}">
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="type">Type</label>
                <select name="type" id="type" class="form-select">
                    <option value="">Select Type</option>
                    <option value="income" {{ old('type', $category->type) == 'income' ? 'selected' : '' }}>Income</option>
                    <option value="expense" {{ old('type', $category->type) == 'expense' ? 'selected' : '' }}>Expense</option>
                </select>
                @error('type') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-save"></i> Update Category
            </button>
        </form>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
