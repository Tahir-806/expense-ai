@extends('layouts.app')
@section('content')
<style>
    /* Reuse same CSS as create page for consistency */
    .budget-create-container {
        min-height: 70vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }
    .budget-create-card {
        width: 100%;
        max-width: 420px;
        border-radius: 2rem;
        background: #fff;
        box-shadow: 0 12px 32px 0 rgba(31, 38, 135, 0.12);
        padding: 2.2rem 2rem 2rem 2rem;
        margin-top: 2.5rem;
    }
    .budget-create-header {
        font-weight: 700;
        font-size: 1.75rem;
        color: #fbbf24;
        text-align: center;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
    }
    .budget-create-header .bi {
        font-size: 2rem;
    }
    .budget-create-form .form-group {
        margin-bottom: 1.2rem;
        display: flex;
        flex-direction: column;
    }
    .budget-create-form .form-label {
        font-weight: 600;
        color: #fbbf24;
        font-size: 1rem;
        margin-bottom: 0.25rem;
        margin-left: 2px;
    }
    .budget-create-form .form-control,
    .budget-create-form .form-select {
        border-radius: 1rem;
        font-size: 1.06rem;
        padding: 0.7rem 1rem;
    }
    .budget-create-form .btn-primary {
        background: linear-gradient(90deg, #fbbf24 0%, #2563eb 100%);
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
    .budget-create-form .btn-primary:hover {
        transform: scale(1.04) translateY(-2px);
        box-shadow: 0 6px 24px rgba(56, 163, 220, 0.19);
        color: #fff;
    }
    .budget-create-form .btn-secondary {
        border-radius: 2rem;
        font-weight: 500;
        margin-bottom: 1.2rem;
        background: #f4f7fd;
        color: #fbbf24;
        border: 1px solid #fbbf24;
        transition: background 0.13s, color 0.13s;
        width: 100%;
        margin-top: -0.5rem;
        margin-bottom: 1.2rem;
    }
    .budget-create-form .btn-secondary:hover {
        background: #fbbf24;
        color: #fff;
    }
</style>
<div class="budget-create-container container py-5">
    <div class="budget-create-card">
        <div class="budget-create-header">
            <i class="bi bi-pie-chart"></i> Edit Budget
        </div>
        {{-- Back Button --}}
        <a href="{{ route('budgets.index') }}" class="btn btn-secondary budget-create-form mb-3">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
        {{-- Edit Budget Form --}}
        <form method="POST" action="{{ route('budgets.update', $budget->id) }}" class="budget-create-form mt-2">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label" for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $budget->category) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="amount">Amount</label>
                <input type="number" step="0.01" name="amount" id="amount" class="form-control" value="{{ old('amount', $budget->amount) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="period">Period</label>
                <select name="period" id="period" class="form-select" required>
                    <option value="monthly" {{ $budget->period == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="yearly" {{ $budget->period == 'yearly' ? 'selected' : '' }}>Yearly</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="month">Month (1-12, optional)</label>
                <input type="number" name="month" id="month" class="form-control" min="1" max="12" value="{{ old('month', $budget->month) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="year">Year (optional)</label>
                <input type="number" name="year" id="year" class="form-control" min="2000" max="{{ now()->year }}" value="{{ old('year', $budget->year) }}">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Update Budget
            </button>
        </form>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
