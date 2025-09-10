@extends('layouts.app')
@section('content')
<style>
    .budgets-center-container {
        min-height: 80vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }
    .budgets-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 800px;
        width: 100%;
        margin: 0 auto 1.5rem auto;
    }
    .budgets-header .title {
        font-weight: 700;
        font-size: 2rem;
        color: #2563eb;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .budgets-header .title .bi {
        font-size: 2.1rem;
    }
    .budgets-header .btn {
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
    .budgets-header .btn:hover {
        transform: scale(1.04) translateY(-2px);
        box-shadow: 0 6px 24px rgba(56, 163, 220, 0.19);
        color: #fff;
    }
    .budgets-card {
        width: 100%;
        max-width: 800px;
        border-radius: 2rem;
        background: #fff;
        box-shadow: 0 12px 32px 0 rgba(31, 38, 135, 0.12);
        padding: 2.5rem 2rem 2rem 2rem;
        margin-top: 2rem;
    }
    .budgets-table {
        width: 100%;
        margin-bottom: 0;
        border-radius: 1rem;
        overflow: hidden;
        background: #fff;
    }
    .budgets-table thead th {
        background: #2563eb;
        color: #fff;
        font-weight: 600;
        padding: 1.1rem 1.3rem;
        font-size: 1.09rem;
        border: none;
        letter-spacing: 0.02em;
    }
    .budgets-table tbody tr:hover {
        background: #fef9e7;
    }
    .budgets-table td {
        padding: 1.05rem 1.3rem;
        vertical-align: middle;
        font-size: 1.06rem;
        border: none;
    }
    .budgets-table td.text-success {
        color: #1cb26c !important;
        font-weight: 700;
    }
    .budgets-table .no-budgets {
        text-align: center;
        color: #a0aec0;
        padding: 2.5rem 0;
        font-size: 1.1rem;
    }
</style>
<div class="budgets-center-container container py-5">
    <div class="budgets-header">
        <div>
            <h2 class="title mb-1"><i class="bi bi-pie-chart"></i> Budgets </h2>
            <p class="subtitle mb-0">Set and review your budgets</p>
        </div>
        <a href="{{ route('budgets.create') }}" class="btn shadow-sm">
            <i class="bi bi-plus-lg"></i> Add Budget
        </a>
    </div>
    <div class="budgets-card">
        <div class="table-responsive">
            <table class="table budgets-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Period</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($budgets as $budget)
                        <tr>
                            <td>{{ $budget->category ?? '-' }}</td>
                            <td class="text-success">{{ number_format($budget->amount, 2) }}</td>
                            <td>{{ ucfirst($budget->period) }}</td>
                            <td>{{ $budget->month ?? '-' }}</td>
                            <td>{{ $budget->year ?? '-' }}</td>
                            <td>
                                <a href="{{ route('budgets.edit', $budget->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this budget?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="no-budgets">
                                <i class="bi bi-emoji-frown fs-4"></i> No budgets found
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
