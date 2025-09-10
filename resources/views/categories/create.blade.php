@extends('layouts.app')
@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f4f7fd 0%, #e9eefb 100%);
        min-height: 100vh;
    }
    .category-create-container {
        min-height: 70vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }
    .category-create-card {
        width: 100%;
        max-width: 420px;
        border-radius: 2rem;
        background: #fff;
        box-shadow: 0 12px 32px 0 rgba(31, 38, 135, 0.12);
        padding: 2.2rem 2rem 2rem 2rem;
        margin-top: 2.5rem;
    }
    .category-create-header {
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
    .category-create-header .bi {
        font-size: 2rem;
    }
    .category-create-form .form-group {
        margin-bottom: 1.2rem;
        display: flex;
        flex-direction: column;
    }
    .category-create-form .form-label {
        font-weight: 600;
        color: #2563eb;
        font-size: 1rem;
        margin-bottom: 0.25rem;
        margin-left: 2px;
    }
    .category-create-form .form-control,
    .category-create-form .form-select {
        border-radius: 1rem;
        font-size: 1.06rem;
        padding: 0.7rem 1rem;
    }
    .category-create-form .btn-success {
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
    .category-create-form .btn-success:hover {
        transform: scale(1.04) translateY(-2px);
        box-shadow: 0 6px 24px rgba(56, 163, 220, 0.19);
        color: #fff;
    }
    .category-create-form .btn-secondary {
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
    .category-create-form .btn-secondary:hover {
        background: #2563eb;
        color: #fff;
    }
</style>

<div class="category-create-container container py-5">
    <div class="category-create-card">
        <div class="category-create-header">
            <i class="bi bi-tags"></i> Add Category
        </div>
        {{-- Back Button --}}
        <a href="{{ route('categories.index') }}" class="btn btn-secondary category-create-form">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
        {{-- Category Form --}}
        <form method="POST" action="{{ route('categories.store') }}" class="category-create-form mt-2">
            @csrf
            <div class="form-group">
                <label class="form-label" for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="type">Type</label>
                <select name="type" id="type" class="form-select">
                    <option value="">Select Type</option>
                    <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
                    <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Expense</option>
                </select>
                @error('type') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <button class="btn btn-success" type="submit">
                <i class="bi bi-plus-lg"></i> Add Category
            </button>
        </form>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
