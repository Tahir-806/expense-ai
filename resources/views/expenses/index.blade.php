@extends('layouts.app')
@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #f4f7fd 0%, #e9eefb 100%);
            min-height: 100vh;
        }

        .expenses-center-container {
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .expenses-card {
            width: 100%;
            max-width: 800px;
            border-radius: 2rem;
            background: #fff;
            box-shadow: 0 12px 32px 0 rgba(31, 38, 135, 0.12);
            padding: 2.5rem 2rem 2rem 2rem;
            margin-top: 2rem;
        }

        .expenses-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 800px;
            width: 100%;
            margin: 0 auto 1.5rem auto;
        }

        .expenses-header .title {
            font-weight: 700;
            font-size: 2rem;
            color: #2563eb;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .expenses-header .title .bi {
            font-size: 2.1rem;
        }

        .expenses-header .subtitle {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 0;
        }

        .expenses-header .btn {
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

        .expenses-header .btn:hover {
            transform: scale(1.04) translateY(-2px);
            box-shadow: 0 6px 24px rgba(56, 163, 220, 0.19);
            color: #fff;
        }

        .total-expense-summary {
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

        .expenses-filter-form {
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

        .expenses-filter-form .form-group {
            min-width: 140px;
            flex: 1 1 140px;
        }

        .expenses-filter-form label {
            font-weight: 600;
            color: #2563eb;
            margin-bottom: 0.2rem;
            font-size: 0.99rem;
        }

        .expenses-filter-form .form-select,
        .expenses-filter-form .btn,
        .expenses-filter-form .form-control {
            border-radius: 1rem;
            min-width: 100px;
        }

        .expenses-filter-form .btn-primary {
            background: linear-gradient(90deg, #38b6ff 0%, #2563eb 100%);
            border: none;
            font-weight: 600;
            padding: 0.5rem 1.6rem;
        }

        .expenses-filter-form .btn-light {
            font-weight: 600;
            border: 1px solid #a0aec0;
            background: #fff;
            padding: 0.5rem 1.4rem;
            color: #324a6d;
        }

        .expenses-filter-form .btn-primary:hover,
        .expenses-filter-form .btn-light:hover {
            box-shadow: 0 3px 12px rgba(56, 163, 220, 0.13);
            transform: translateY(-2px) scale(1.03);
        }

        @media (max-width: 800px) {

            .expenses-card,
            .expenses-header,
            .expenses-filter-form {
                max-width: 100vw;
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }

            .expenses-filter-form {
                gap: 0.6rem;
                padding: 0.8rem 0.5rem;
            }
        }

        @media (max-width: 600px) {
            .expenses-card {
                padding: 1.3rem 0.3rem;
            }

            .expenses-header .title {
                font-size: 1.2rem;
            }

            .expenses-header .btn {
                padding: 0.45rem 1.1rem;
                font-size: 0.98rem;
            }

            .expenses-table thead th,
            .expenses-table td {
                padding: 0.65rem 0.7rem;
                font-size: 0.97rem;
            }

            .expenses-filter-form {
                flex-direction: column;
                align-items: stretch;
                gap: 0.5rem;
            }

            .expenses-filter-form .form-group {
                min-width: 100px;
            }
        }

        .expenses-table {
            width: 100%;
            margin-bottom: 0;
            border-radius: 1rem;
            overflow: hidden;
            background: #fff;
        }

        .expenses-table thead th {
            background: #2563eb;
            color: #fff;
            font-weight: 600;
            padding: 1.1rem 1.3rem;
            font-size: 1.09rem;
            border: none;
            letter-spacing: 0.02em;
        }

        .expenses-table tbody tr {
            transition: background 0.2s;
        }

        .expenses-table tbody tr:hover {
            background: #f4f8ff;
        }

        .expenses-table td {
            padding: 1.05rem 1.3rem;
            vertical-align: middle;
            font-size: 1.06rem;
            border: none;
        }

        .expenses-table td .bi {
            font-size: 1.15rem;
            margin-right: 0.35rem;
            color: #2563eb;
        }

        .expenses-table td.text-success {
            color: #1cb26c !important;
            font-weight: 700;
        }

        .expenses-table td.text-muted {
            color: #6b7280 !important;
            font-size: 0.98rem;
        }

        .expenses-table .no-expenses {
            text-align: center;
            color: #a0aec0;
            padding: 2.5rem 0;
            font-size: 1.1rem;
        }

        #ai-suggestion-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        #show-ai-card {
            margin: 2.2rem 0 1.5rem 0;
            font-size: 1.1rem;
            padding: 0.8rem 2.2rem;
        }

        #ai-suggestions {
            background: linear-gradient(135deg, #eaf1fc 0%, #f8fafc 100%);
            border-radius: 1.5rem;
            max-width: 900px;
            margin: 2.2rem auto 1.5rem auto;
            box-shadow: 0 12px 40px 0 rgba(56, 163, 220, 0.18);
            border: none;
            padding: 2.1rem 2.2rem 1.4rem 2.2rem;
            position: relative;
            transition: box-shadow 0.18s, transform 0.14s;
            overflow: hidden;
            display: none;
        }

        #ai-suggestions::before {
            content: "";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 7px;
            background: linear-gradient(90deg, #38b6ff 0%, #2563eb 100%);
            border-radius: 1.5rem 1.5rem 0 0;
            z-index: 1;
        }

        #ai-suggestions:hover {
            box-shadow: 0 16px 48px 0 rgba(56, 163, 220, 0.26);
            transform: translateY(-3px) scale(1.011);
        }

        #ai-suggestions .ai-header {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            margin-bottom: 1rem;
            z-index: 2;
            position: relative;
        }

        #ai-suggestions .ai-icon {
            background: linear-gradient(135deg, #38b6ff 0%, #2563eb 100%);
            color: #fff;
            border-radius: 50%;
            width: 2.7rem;
            height: 2.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.54rem;
            box-shadow: 0 2px 8px rgba(38, 99, 235, 0.13);
            animation: pulse 1.7s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(56, 163, 220, 0.16);
            }

            70% {
                box-shadow: 0 0 12px 9px rgba(56, 163, 220, 0.08);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(56, 163, 220, 0.13);
            }
        }

        #ai-suggestions h5 {
            font-weight: 700;
            color: #2563eb;
            letter-spacing: 0.01em;
            font-size: 1.18rem;
            margin-bottom: 0.2rem;
        }

        #ai-suggestions .ai-close {
            position: absolute;
            top: 0.8rem;
            right: 1.3rem;
            background: none;
            border: none;
            color: #a0aec0;
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.18s;
            z-index: 10;
        }

        #ai-suggestions .ai-close:hover {
            color: #2563eb;
        }

        #suggestion-text-container {
            position: relative;
        }

        #suggestion-text {
            color: #1e293b;
            font-size: 1.07rem;
            line-height: 1.7;
            background: rgba(244, 247, 253, 0.97);
            border-radius: 1.1rem;
            padding: 1.1rem 1.2rem;
            margin-bottom: 1.1rem;
            box-shadow: 0 1px 6px rgba(56, 163, 220, 0.04);
            transition: background 0.15s;
            word-break: break-word;
            white-space: pre-line;
            opacity: 0;
            transform: translateY(6px);
            animation: fadeIn 0.7s forwards;
            min-height: 2rem;
            max-height: 300px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #2563eb #f4f7fd;
        }

        #suggestion-text::-webkit-scrollbar {
            width: 7px;
            background: #f4f7fd;
            border-radius: 9px;
        }

        #suggestion-text::-webkit-scrollbar-thumb {
            background: #38b6ff77;
            border-radius: 9px;
        }

        #suggestion-text::-webkit-scrollbar-thumb:hover {
            background: #2563ebaa;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: none;
            }
        }

        .ai-loader {
            display: inline-block;
            vertical-align: middle;
            width: 1.2em;
            height: 1.2em;
            border: 2.5px solid #2563eb;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spin 0.75s linear infinite;
            margin-right: 0.7em;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        #ai-suggestions .btn {
            font-size: 1.01rem;
            font-weight: 600;
            padding: 0.62rem 2.1rem;
            border-radius: 2rem;
            background: linear-gradient(90deg, #38b6ff 0%, #2563eb 100%);
            color: #fff;
            box-shadow: 0 3px 12px rgba(56, 163, 220, 0.13);
            border: none;
            transition: transform 0.14s, box-shadow 0.16s;
        }

        #ai-suggestions .btn:active {
            transform: scale(0.98);
        }

        #ai-suggestions .btn:disabled {
            background: #b4c8f7;
            color: #ffffffcc;
            cursor: not-allowed;
            opacity: 0.75;
        }

        #hide-answer {
            position: absolute;
            top: 0.6rem;
            right: 1.0rem;
            z-index: 20;
            background: #f3f6fb;
            color: #2563eb;
            border: none;
            border-radius: 1.5rem;
            padding: 0.21rem 0.95rem;
            font-size: 0.97rem;
            box-shadow: 0 1px 6px rgba(56, 163, 220, 0.05);
            cursor: pointer;
            display: none;
            transition: background 0.13s, color 0.13s;
        }

        #hide-answer:hover {
            background: #2563eb;
            color: #fff;
        }

        #ai-suggestions::after {
            content: "";
            position: absolute;
            right: -60px;
            top: 30%;
            width: 180px;
            height: 180px;
            background-image: radial-gradient(circle at 60% 30%, #38b6ff44 0px, transparent 70%);
            z-index: 0;
            pointer-events: none;
        }

        .chart-toggle-btns {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            margin-bottom: 18px;
            gap: 1.2rem;
        }

        .chart-toggle-btn {
            padding: 0.55rem 1.6rem;
            font-size: 1.06rem;
            border-radius: 1.5rem;
            border: none;
            background: #e6edfa;
            color: #2563eb;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(56, 163, 220, 0.06);
            transition: background 0.18s, color 0.18s;
            cursor: pointer;
        }

        .chart-toggle-btn.active,
        .chart-toggle-btn:hover {
            background: linear-gradient(90deg, #38b6ff 0%, #2563eb 100%);
            color: #fff;
        }

        .chart-section {
            display: none;
        }

        .chart-section.active {
            display: block;
        }

        /* --- Year Chart Sizing Fix --- */
        #year-chart-container {
            width: 80vw;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #year-chart-section .card {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem;
            height: 400px;
            /* Fixed height for the card */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        #yearChart {
            width: 100% !important;
            height: 350px !important;
            /* Fixed height for the canvas */
            display: block;
        }

        @media (max-width: 900px) {
            #year-chart-container {
                width: 98vw;
                min-width: 0;
            }
        }

        @media (max-width: 600px) {
            #year-chart-container {
                width: 100vw;
            }

            #year-chart-section .card {
                height: 220px;
                padding: 0.7rem !important;
            }

            #yearChart {
                height: 180px !important;
            }
        }
    </style>

    <div id="ai-suggestion-wrapper">
        <button id="show-ai-card" class="btn btn-primary">
            <i class="bi bi-robot"></i> Get AI Suggestion
        </button>
        <div class="card shadow-sm" id="ai-suggestions">
            <button class="ai-close" id="hide-ai-card" type="button">
                <i class="bi bi-x"></i>
            </button>
            <div class="ai-header">
                <span class="ai-icon"><i class="bi bi-robot"></i></span>
                <h5 class="mb-0">AI Suggestions</h5>
            </div>
            <div id="suggestion-text-container">
                <div id="suggestion-text">
                    <span class="text-muted">Click "Get Suggestion" to see AI's advice on your spending.</span>
                </div>
                <button id="hide-answer">
                    <i class="bi bi-eye-slash"></i> Hide Answer
                </button>
            </div>
            <button id="get-suggestion" class="btn btn-primary">
                <i class="bi bi-lightbulb me-1"></i> Get Suggestion
            </button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#show-ai-card').click(function() {
                $(this).hide();
                $('#ai-suggestions').fadeIn(200);
            });
            $('#hide-ai-card').click(function() {
                $('#ai-suggestions').fadeOut(150, function() {
                    $('#show-ai-card').show();
                    $('#suggestion-text').html(
                        '<span class="text-muted">Click "Get Suggestion" to see AI\'s advice on your spending.</span>'
                    );
                    $('#hide-answer').hide();
                    $('#get-suggestion').prop('disabled', false);
                });
            });
            $('#get-suggestion').click(function() {
                const $btn = $(this);
                $btn.prop('disabled', true);
                $('#suggestion-text').html(
                    '<span class="ai-loader"></span> <span>Loading AI suggestion...</span>');
                $('#hide-answer').hide();
                $.ajax({
                    url: "{{ route('expense.ai.suggestion') }}",
                    type: 'GET',
                    success: function(response) {
                        let formatted = response.suggestion;
                        if (formatted.includes('- ')) {
                            formatted = '<ul style="margin-left:1em;padding-left:1em;">' +
                                formatted.replace(/- /g, '<li style="margin-bottom:0.5em;">')
                                .replace(/\n/g, '</li>') + '</ul>';
                        }
                        $('#suggestion-text').hide().html(formatted).fadeIn(300);
                        $('#hide-answer').show();
                        $btn.prop('disabled', false);
                    },
                    error: function(xhr) {
                        $('#suggestion-text').html(
                            '<span class="text-danger">⚠️ Error fetching suggestion. Please try again.</span>'
                        );
                        $('#hide-answer').hide();
                        $btn.prop('disabled', false);
                    }
                });
            });
            $('#hide-answer').click(function() {
                $('#suggestion-text').fadeOut(200, function() {
                    $(this).html(
                        '<span class="text-muted">Click "Get Suggestion" to see AI\'s advice on your spending.</span>'
                    ).fadeIn(150);
                });
                $(this).hide();
            });
            $('.chart-toggle-btn').click(function() {
                $('.chart-toggle-btn').removeClass('active');
                $(this).addClass('active');
                $('.chart-section').removeClass('active');
                $('#' + $(this).data('chart')).addClass('active');
            });
            // Do NOT activate any chart or button by default
            $('.chart-toggle-btn').removeClass('active');
            $('.chart-section').removeClass('active');
        });
    </script>
    <div class="expenses-center-container container py-5">
        <div class="expenses-header">
            <div>
                <h2 class="title mb-1"><i class="bi bi-wallet2"></i> Your Expenses </h2>
                <p class="subtitle mb-0">Track and review all your spending in one place</p>
            </div>
            <a href="{{ route('expenses.create') }}" class="btn shadow-sm">
                <i class="bi bi-plus-lg"></i> Add New Expense
            </a>
        </div>
        <div class="total-expense-summary">
            <span>Total Expenses(PKR):</span>
            <span>
                {{ number_format($expenses->sum('amount') ?? 0, 2) }}
            </span>
        </div>
        <!-- Filter Form - Updated with better value preservation -->
        <form method="GET" action="{{ route('expenses.index') }}" class="expenses-filter-form">
            <div class="form-group">
                <label for="month" class="form-label">Month</label>
                <select name="month" id="month" class="form-select">
                    <option value="">All</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
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
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
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


        <div class="expenses-card">
            <div class="table-responsive">
                <table class="table expenses-table align-middle mb-0">
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
                        @forelse($expenses as $exp)
                            <tr>
                                <td>
                                    <i class="bi bi-receipt"></i> {{ $exp->title }}
                                </td>
                                <td class="text-success">
                                    {{ number_format($exp->amount, 2) }}
                                </td>
                                <td>
                                    <i class="bi bi-tag"></i> {{ $exp->category->name ?? 'Uncategorized' }}
                                </td>
                                <td class="text-muted">
                                    {{ \Carbon\Carbon::parse($exp->date)->format('F j, Y') }}
                                </td>
                                <td>
                                    <a href="{{ route('expenses.edit', $exp->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('expenses.destroy', $exp->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this expense?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="no-expenses">
                                    <i class="bi bi-emoji-frown fs-4"></i> No expenses found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="chart-toggle-btns">
            <button type="button" class="chart-toggle-btn" data-chart="month-chart-section">
                📊 Selected Month Breakdown
            </button>
            <button type="button" class="chart-toggle-btn" data-chart="year-chart-section">
                📈 Full Year Overview
            </button>
        </div>
        <div id="month-chart-section" class="chart-section">
            <div class="card p-3 shadow-sm" style="max-width: 600px; width: 100%; margin: 0 auto;">
                <h5 class="text-center mb-3">📊 Selected Month Breakdown</h5>
                <canvas id="monthChart" height="250"></canvas>
            </div>
        </div>
        <div id="year-chart-section" class="chart-section">
            <div id="year-chart-container">
                <div class="card p-3 shadow-sm">
                    <h5 class="text-center mb-3">📈 Full Year Overview</h5>
                    <canvas id="yearChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let monthChartInstance, yearChartInstance;
        document.addEventListener('DOMContentLoaded', function() {
            const monthLabels = @json($monthLabels ?? []);
            const monthData = @json($monthData ?? []);
            const ctxMonth = document.getElementById('monthChart').getContext('2d');
            monthChartInstance = new Chart(ctxMonth, {
                type: 'pie',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        label: 'Expenses',
                        data: monthData,
                        backgroundColor: ['#2563eb', '#38b6ff', '#fbbf24', '#10b981', '#f87171',
                            '#a78bfa'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
            const yearLabels = @json($yearLabels ?? []);
            const yearData = @json($yearData ?? []);
            const ctxYear = document.getElementById('yearChart').getContext('2d');
            yearChartInstance = new Chart(ctxYear, {
                type: 'bar',
                data: {
                    labels: yearLabels,
                    datasets: [{
                        label: 'Monthly Total ',
                        data: yearData,
                        backgroundColor: '#2563eb'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Allow to fill container
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 50
                            }
                        }
                    }
                }
            });
        });
    </script>
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
