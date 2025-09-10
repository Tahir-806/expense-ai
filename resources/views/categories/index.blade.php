@extends('layouts.app')
@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f4f7fd 0%, #e9eefb 100%);
        min-height: 100vh;
    }
    .categories-center-container {
        min-height: 80vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }
    .categories-card {
        width: 100%;
        max-width: 800px;
        border-radius: 2rem;
        background: #fff;
        box-shadow: 0 12px 32px 0 rgba(31, 38, 135, 0.12);
        padding: 2.5rem 2rem 2rem 2rem;
        margin-top: 2rem;
    }
    .categories-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 800px;
        width: 100%;
        margin: 0 auto 1.5rem auto;
    }
    .categories-header .title {
        font-weight: 700;
        font-size: 2rem;
        color: #2563eb;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .categories-header .title .bi {
        font-size: 2.1rem;
    }
    .categories-header .subtitle {
        font-size: 1rem;
        color: #6b7280;
        margin-bottom: 0;
    }
    .categories-header .btn {
        font-size: 1.07rem;
        font-weight: 500;
        padding: 0.75rem 2.2rem;
        border-radius: 2rem;
        background: linear-gradient(90deg, #38b6ff 0%, #2563eb 100%);
        color: #fff;
        box-shadow: 0 3px 12px rgba(56, 163, 220, 0.13);
        border: none;
        transition: transform 0.12s, box-shadow 0.16s;
    }
    .categories-header .btn:hover {
        transform: scale(1.04) translateY(-2px);
        box-shadow: 0 6px 24px rgba(56, 163, 220, 0.19);
        color: #fff;
    }
    @media (max-width: 800px) {
        .categories-card,
        .categories-header {
            max-width: 100vw;
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }
    }
    @media (max-width: 600px) {
        .categories-card {
            padding: 1.3rem 0.3rem;
        }
        .categories-header .title {
            font-size: 1.2rem;
        }
        .categories-header .btn {
            padding: 0.45rem 1.1rem;
            font-size: 0.98rem;
        }
        .categories-table thead th,
        .categories-table td {
            padding: 0.65rem 0.7rem;
            font-size: 0.97rem;
        }
    }
    .categories-table {
        width: 100%;
        margin-bottom: 0;
        border-radius: 1rem;
        overflow: hidden;
        background: #fff;
    }
    .categories-table thead th {
        background: #2563eb;
        color: #fff;
        font-weight: 600;
        padding: 1.1rem 1.3rem;
        font-size: 1.09rem;
        border: none;
        letter-spacing: 0.02em;
    }
    .categories-table tbody tr {
        transition: background 0.2s;
    }
    .categories-table tbody tr:hover {
        background: #f4f8ff;
    }
    .categories-table td {
        padding: 1.05rem 1.3rem;
        vertical-align: middle;
        font-size: 1.06rem;
        border: none;
    }
    .categories-table td .bi {
        font-size: 1.15rem;
        margin-right: 0.35rem;
        color: #2563eb;
    }
    .categories-table td.text-success {
        color: #1cb26c !important;
        font-weight: 700;
    }
    .categories-table td.text-muted {
        color: #6b7280 !important;
        font-size: 0.98rem;
    }
    .categories-table .no-categories {
        text-align: center;
        color: #a0aec0;
        padding: 2.5rem 0;
        font-size: 1.1rem;
    }
</style>

<div class="categories-center-container container py-5">
    <div class="categories-header">
        <div>
            <h2 class="title mb-1"><i class="bi bi-tags"></i> Categories </h2>
            <p class="subtitle mb-0">Manage and organize your categories for incomes and expenses</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn shadow-sm">
            <i class="bi bi-plus-lg"></i> Add New Category
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="categories-card">
        <div class="table-responsive">
            <table class="table categories-table align-middle mb-0">
                <thead>
                    <tr>
                        <th><i class="bi bi-tag"></i> Name</th>
                        <th><i class="bi bi-collection"></i> Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                <i class="bi bi-tag"></i> {{ $category->name }}
                            </td>
                            <td class="text-muted">
                                {{ ucfirst($category->type) }}
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="no-categories">
                                <i class="bi bi-emoji-frown fs-4"></i> No categories found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
