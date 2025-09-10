@extends('layouts.app')
@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #f4f7fd 0%, #e9eefb 100%);
            min-height: 100vh;
        }

        .incomes-center-container {
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .incomes-card {
            width: 100%;
            max-width: 800px;
            border-radius: 2rem;
            background: #fff;
            box-shadow: 0 12px 32px 0 rgba(31, 38, 135, 0.12);
            padding: 2.5rem 2rem 2rem 2rem;
            margin-top: 2rem;
        }

        .incomes-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 800px;
            width: 100%;
            margin: 0 auto 1.5rem auto;
        }

        .incomes-header .title {
            font-weight: 700;
            font-size: 2rem;
            color: #2563eb;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .incomes-header .title .bi {
            font-size: 2.1rem;
        }

        .incomes-header .subtitle {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 0;
        }

        .incomes-header .btn {
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

        .incomes-header .btn:hover {
            transform: scale(1.04) translateY(-2px);
            box-shadow: 0 6px 24px rgba(56, 163, 220, 0.19);
            color: #fff;
        }

        .total-income-summary {
            background: linear-gradient(90deg, #38b6ff 0%, #2563eb 100%);
            color: #fff;
            font-size: 1.17rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            padding: 1.1rem 2.2rem;
            border-radius: 1.2rem;
            box-shadow: 0 2px 12px 0 rgba(56, 163, 220, 0.08);
            margin: 0 auto 1.7rem auto;
            max-width: 400px;
            text-align: center;
        }

        .incomes-filter-form {
            width: 100%;
            max-width: 800px;
            margin: 0 auto 2rem auto;
            padding: 1.1rem 1.2rem;
            background: #f8fafc;
            border-radius: 1.1rem;
            box-shadow: 0 2px 10px 0 rgba(31, 38, 135, .05);
            display: flex;
            gap: 1.5rem;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .incomes-filter-form .form-group {
            min-width: 140px;
            flex: 1 1 140px;
        }

        .incomes-filter-form label {
            font-weight: 600;
            color: #2563eb;
            margin-bottom: 0.2rem;
            font-size: 0.99rem;
        }

        .incomes-filter-form .form-select,
        .incomes-filter-form .btn,
        .incomes-filter-form .form-control {
            border-radius: 1rem;
            min-width: 100px;
        }

        .incomes-filter-form .btn-primary {
            background: linear-gradient(90deg, #38b6ff 0%, #2563eb 100%);
            border: none;
            font-weight: 600;
            padding: 0.5rem 1.6rem;
        }

        .incomes-filter-form .btn-light {
            font-weight: 600;
            border: 1px solid #a0aec0;
            background: #fff;
            padding: 0.5rem 1.4rem;
            color: #324a6d;
        }

        .incomes-filter-form .btn-primary:hover,
        .incomes-filter-form .btn-light:hover {
            box-shadow: 0 3px 12px rgba(56, 163, 220, 0.13);
            transform: translateY(-2px) scale(1.03);
        }

        @media (max-width: 800px) {

            .incomes-card,
            .incomes-header,
            .incomes-filter-form {
                max-width: 100vw;
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }

            .incomes-filter-form {
                gap: 0.6rem;
                padding: 0.8rem 0.5rem;
            }
        }

        @media (max-width: 600px) {
            .incomes-card {
                padding: 1.3rem 0.3rem;
            }

            .incomes-header .title {
                font-size: 1.2rem;
            }

            .incomes-header .btn {
                padding: 0.45rem 1.1rem;
                font-size: 0.98rem;
            }

            .incomes-table thead th,
            .incomes-table td {
                padding: 0.65rem 0.7rem;
                font-size: 0.97rem;
            }

            .incomes-filter-form {
                flex-direction: column;
                align-items: stretch;
                gap: 0.5rem;
            }

            .incomes-filter-form .form-group {
                min-width: 100px;
            }
        }

        .incomes-table {
            width: 100%;
            margin-bottom: 0;
            border-radius: 1rem;
            overflow: hidden;
            background: #fff;
        }

        .incomes-table thead th {
            background: #2563eb;
            color: #fff;
            font-weight: 600;
            padding: 1.1rem 1.3rem;
            font-size: 1.09rem;
            border: none;
            letter-spacing: 0.02em;
        }

        .incomes-table tbody tr {
            transition: background 0.2s;
        }

        .incomes-table tbody tr:hover {
            background: #f4f8ff;
        }

        .incomes-table td {
            padding: 1.05rem 1.3rem;
            vertical-align: middle;
            font-size: 1.06rem;
            border: none;
        }

        .incomes-table td .bi {
            font-size: 1.15rem;
            margin-right: 0.35rem;
            color: #2563eb;
        }

        .incomes-table td.text-success {
            color: #1cb26c !important;
            font-weight: 700;
        }

        .incomes-table td.text-muted {
            color: #6b7280 !important;
            font-size: 0.98rem;
        }

        .incomes-table .no-incomes {
            text-align: center;
            color: #a0aec0;
            padding: 2.5rem 0;
            font-size: 1.1rem;
        }
    </style>

    <div class="incomes-center-container container py-5">
        <div class="incomes-header">
            <div>
                <h2 class="title mb-1"><i class="bi bi-cash-coin"></i> Your Incomes </h2>
                <p class="subtitle mb-0">Track and review all your earnings in one place</p>
            </div>
            <a href="{{ route('incomes.create') }}" class="btn shadow-sm">
                <i class="bi bi-plus-lg"></i> Add New Income
            </a>
        </div>
        <div class="total-income-summary">
            <span>Total Income (PKR):</span>
            <span>
                {{ number_format($incomes->sum('amount') ?? 0, 2) }}
            </span>
        </div>

        <!-- Filter Form - Updated with better value preservation -->
        <form method="GET" action="{{ route('incomes.index') }}" class="incomes-filter-form">
            <div class="form-group">
                <label for="month" class="form-label">Month</label>
                <select name="month" id="month" class="form-select">
                    <option value="">All</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}"
                            {{ (string) request('month') === (string) $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="year" class="form-label">Year</label>
                <select name="year" id="year" class="form-select">
                    <option value="">All</option>
                    @for ($y = now()->year; $y >= 2000; $y--)
                        <option value="{{ $y }}"
                            {{ (string) request('year') === (string) $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="form-group d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                <a href="{{ route('incomes.index') }}" class="btn btn-light border">
                    Reset
                </a>
            </div>
        </form>

        <div class="incomes-card">
            <div class="table-responsive">
                <table class="table incomes-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($incomes as $inc)
                            <tr>
                                <td>
                                    <i class="bi bi-receipt"></i> {{ $inc->title }}
                                </td>
                                <td class="text-success">
                                    {{ number_format($inc->amount, 2) }}
                                </td>
                                <td>
                                    <i class="bi bi-tag"></i> {{ $inc->category->name ?? 'Uncategorized' }}
                                </td>
                                <td class="text-muted">
                                    {{ \Carbon\Carbon::parse($inc->date)->format('F j, Y') }}
                                </td>
                                <td>
                                    <a href="{{ route('incomes.edit', $inc->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('incomes.destroy', $inc->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this expense?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                            </tr>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="no-incomes">
                                    <i class="bi bi-emoji-frown fs-4"></i> No incomes found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>



    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <script>
        // Ensure filter values persist after page refresh
        document.addEventListener('DOMContentLoaded', function() {
            // Get URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const monthParam = urlParams.get('month');
            const yearParam = urlParams.get('year');

            // Set month dropdown
            if (monthParam) {
                const monthSelect = document.getElementById('month');
                monthSelect.value = monthParam;
            }

            // Set year dropdown
            if (yearParam) {
                const yearSelect = document.getElementById('year');
                yearSelect.value = yearParam;
            }

            // Handle form submission to ensure parameters are maintained
            const filterForm = document.querySelector('.filter-form');
            filterForm.addEventListener('submit', function(e) {
                // Remove empty values before submission
                const formData = new FormData(this);
                const params = new URLSearchParams();

                for (let [key, value] of formData.entries()) {
                    if (value.trim() !== '') {
                        params.append(key, value);
                    }
                }

                // Update URL without page reload
                const newUrl = window.location.pathname + (params.toString() ? '?' + params.toString() :
                    '');
                window.history.replaceState({}, '', newUrl);
            });
        });
    </script>
@endsection
