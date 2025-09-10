{{-- @extends('layouts.app')
@section('content')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
:root {
    --primary-blue: #2563eb;
    --secondary-blue: #38b6ff;
    --success-green: #10b981;
    --danger-red: #f87171;
    --text-gray: #6b7280;
    --bg-light: #f8fafc;
    --shadow-light: rgba(56, 163, 220, 0.08);
    --shadow-medium: rgba(56, 163, 220, 0.16);
    --shadow-heavy: rgba(56, 163, 220, 0.25);
}

body {
    background: linear-gradient(135deg, #f4f7fd 0%, #e9eefb 100%);
    min-height: 100vh;
}

.container { max-width: 1200px; }

/* Common Components */
.btn-gradient {
    background: linear-gradient(90deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
    border: none;
    color: #fff;
    border-radius: 2rem;
    font-weight: 600;
    transition: all 0.2s ease;
}
.btn-gradient:hover {
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 6px 24px var(--shadow-medium);
    color: #fff;
}

.card-modern {
    background: #fff;
    border-radius: 1.5rem;
    box-shadow: 0 4px 24px var(--shadow-medium);
    border: none;
    transition: all 0.3s ease;
}
.card-modern:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 32px var(--shadow-heavy);
}

/* FORCE PIE CHARTS IN ONE ROW */
.pie-charts-wrapper {
    display: flex !important;
    flex-wrap: nowrap !important;
    justify-content: space-between !important;
    gap: 1.5rem !important;
    margin-bottom: 3rem !important;
}

.pie-chart-column {
    flex: 1 !important;
    min-width: 0 !important;
    max-width: 33.333% !important;
}

/* Pie Chart Cards */
.pie-chart-card {
    background: #fff;
    border-radius: 1.3rem;
    box-shadow: 0 4px 20px var(--shadow-medium);
    padding: 1.5rem 1rem;
    text-align: center;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s ease;
    width: 100%;
}
.pie-chart-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px var(--shadow-heavy);
}

.pie-chart-container {
    width: 180px;
    height: 180px;
    margin: 0 auto 1rem;
    position: relative;
}

.chart-title {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--primary-blue);
    margin-bottom: 1rem;
}

.chart-total {
    background: linear-gradient(90deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
    color: #fff;
    font-size: 0.95rem;
    font-weight: 600;
    padding: 0.8rem 1rem;
    border-radius: 1rem;
    margin-top: 1rem;
}

/* AI Suggestions */
.ai-section {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
}
.ai-card {
    background: linear-gradient(135deg, #eaf1fc 0%, var(--bg-light) 100%);
    border-radius: 1.5rem;
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem;
    position: relative;
    display: none;
}
.ai-card::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 6px;
    background: linear-gradient(90deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
    border-radius: 1.5rem 1.5rem 0 0;
}
.ai-icon {
    background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
    color: #fff;
    border-radius: 50%;
    width: 2.5rem; height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(56, 163, 220, 0.4); }
    50% { box-shadow: 0 0 0 10px rgba(56, 163, 220, 0.1); }
}

/* Filter Form */
.filter-form {
    max-width: 800px;
    margin: 0 auto 2rem;
    padding: 1.2rem;
    background: var(--bg-light);
    border-radius: 1.2rem;
    display: flex;
    gap: 1rem;
    align-items: flex-end;
    flex-wrap: wrap;
}
.filter-form .form-group {
    min-width: 140px;
    flex: 1 1 140px;
}
.filter-form label {
    font-weight: 600;
    color: var(--primary-blue);
    font-size: 0.95rem;
}
.filter-form .form-select,
.filter-form .btn {
    border-radius: 1rem;
    min-width: 100px;
}

/* FIXED YEARLY CHART - ALWAYS VISIBLE */
.yearly-chart-section {
    margin: 3rem 0;
}

.yearly-chart-container {
    max-width: 1100px;
    width: 100%;
    height: 500px;
    margin: 0 auto;
}

.yearly-chart-card {
    height: 100%;
    display: flex;
    flex-direction: column;
    padding: 2rem;
}

.yearly-chart-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-blue);
    text-align: center;
    margin-bottom: 2rem;
}

#yearChart {
    width: 100% !important;
    height: 420px !important;
    max-height: 420px !important;
}

/* Monthly Charts Section */
.monthly-charts-section {
    margin: 3rem 0;
}

.monthly-chart-card {
    height: 400px;
    padding: 1.5rem;
}

.monthly-chart-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--primary-blue);
    text-align: center;
    margin-bottom: 1.5rem;
}

/* Responsive Design */
@media (max-width: 992px) {
    .pie-charts-wrapper {
        flex-wrap: wrap !important;
    }
    .pie-chart-column {
        max-width: 50% !important;
        flex: 1 1 45% !important;
        margin-bottom: 1.5rem;
    }

    .yearly-chart-container {
        height: 400px;
    }
    #yearChart {
        height: 320px !important;
        max-height: 320px !important;
    }
}

@media (max-width: 768px) {
    .filter-form {
        flex-direction: column;
        gap: 0.5rem;
    }
    .pie-charts-wrapper {
        flex-direction: column !important;
        gap: 1rem !important;
    }
    .pie-chart-column {
        max-width: 100% !important;
        flex: 1 1 100% !important;
    }
    .pie-chart-container {
        width: 150px;
        height: 150px;
    }
    .chart-total { font-size: 0.9rem; padding: 0.6rem 1rem; }

    .yearly-chart-container {
        height: 350px;
    }
    #yearChart {
        height: 270px !important;
        max-height: 270px !important;
    }
}

@media (max-width: 576px) {
    .pie-chart-container {
        width: 120px;
        height: 120px;
    }
    .chart-total { font-size: 0.8rem; padding: 0.5rem 0.8rem; }

    .yearly-chart-container {
        height: 300px;
    }
    #yearChart {
        height: 220px !important;
        max-height: 220px !important;
    }
}
</style>

<!-- AI Suggestions Section -->
<div class="ai-section">
    <button id="show-ai-card" class="btn btn-gradient">
        <i class="bi bi-robot me-2"></i>Get AI Suggestion
    </button>
    <div class="ai-card card-modern" id="ai-suggestions">
        <button class="btn-close position-absolute top-0 end-0 m-3" id="hide-ai-card"></button>
        <div class="d-flex align-items-center mb-3">
            <div class="ai-icon me-3">
                <i class="bi bi-robot"></i>
            </div>
            <h5 class="mb-0 text-primary">AI Financial Suggestions</h5>
        </div>
        <div class="position-relative">
            <div id="suggestion-text" class="p-3 bg-light rounded-3 mb-3">
                <span class="text-muted">Click "Get Suggestion" to receive AI advice on your spending patterns.</span>
            </div>
        </div>
        <button id="get-suggestion" class="btn btn-gradient">
            <i class="bi bi-lightbulb me-2"></i>Get Suggestion
        </button>
    </div>
</div>

<div class="container py-4">
    <!-- Filter Form -->
    <form method="GET" action="{{ route('expenses.index') }}" class="filter-form">
        <div class="form-group">
            <label for="month">Month</label>
            <select name="month" id="month" class="form-select">
                <option value="">All Months</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <select name="year" id="year" class="form-select">
                <option value="">All Years</option>
                @for ($y = now()->year; $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group d-flex gap-2">
            <button type="submit" class="btn btn-gradient">
                <i class="bi bi-funnel me-1"></i>Filter
            </button>
            <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    <!-- PIE CHARTS IN ONE ROW -->
    <div class="pie-charts-wrapper">
        <div class="pie-chart-column">
            <div class="pie-chart-card">
                <h6 class="chart-title">📈 Income Overview</h6>
                <div class="pie-chart-container">
                    <canvas id="incomePieChart"></canvas>
                </div>
                <div class="chart-total">
                    Total Income (PKR)<br>
                    <strong>{{ number_format($incomes->sum('amount') ?? 0, 2) }}</strong>
                </div>
            </div>
        </div>
        <div class="pie-chart-column">
            <div class="pie-chart-card">
                <h6 class="chart-title">💰 Expense Overview</h6>
                <div class="pie-chart-container">
                    <canvas id="expensePieChart"></canvas>
                </div>
                <div class="chart-total">
                    Total Expenses (PKR)<br>
                    <strong>{{ number_format($expenses->sum('amount') ?? 0, 2) }}</strong>
                </div>
            </div>
        </div>
        <div class="pie-chart-column">
            <div class="pie-chart-card">
                <h6 class="chart-title">⚖️ Financial Balance</h6>
                <div class="pie-chart-container">
                    <canvas id="outcomePieChart"></canvas>
                </div>
                <div class="chart-total">
                    Net Outcome (PKR)<br>
                    <strong>{{ number_format(($incomes->sum('amount') ?? 0) - ($expenses->sum('amount') ?? 0), 2) }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- YEARLY CHART - ALWAYS VISIBLE WITH FIXED SIZE -->
<div class="yearly-chart-section">
    <div class="yearly-chart-container">
        <div class="yearly-chart-card card-modern">
            <h3 class="yearly-chart-title">📈 Annual Financial Overview ({{ request('year') ?? now()->year }})</h3>
            <canvas id="yearChart"></canvas>
        </div>
    </div>
</div>

<!-- MONTHLY CHARTS SECTION -->
<div class="monthly-charts-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="monthly-chart-card card-modern">
                    <h5 class="monthly-chart-title">📊 Monthly Expenses Breakdown</h5>
                    <canvas id="monthChart" height="300"></canvas>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="monthly-chart-card card-modern">
                    <h5 class="monthly-chart-title">💰 Monthly Income Breakdown</h5>
                    <canvas id="monthIncomeChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // AI Suggestions
    $('#show-ai-card').click(() => {
        $('#show-ai-card').hide();
        $('#ai-suggestions').fadeIn(300);
    });

    $('#hide-ai-card').click(() => {
        $('#ai-suggestions').fadeOut(200, () => {
            $('#show-ai-card').show();
            $('#suggestion-text').html('<span class="text-muted">Click "Get Suggestion" to receive AI advice on your spending patterns.</span>');
            $('#get-suggestion').prop('disabled', false);
        });
    });

    $('#get-suggestion').click(function() {
        const $btn = $(this);
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Loading...');

             url: "{{ route('expense.ai.suggestion') }}",
            type: 'GET',
            success: function(response) {
                let formatted = response.suggestion.includes('- ') ?
                    '<ul>' + response.suggestion.replace(/- /g, '<li>').replace(/\n/g, '</li>') + '</ul>' :
                    response.suggestion;
                $('#suggestion-text').html(formatted);
                $btn.prop('disabled', false).html('<i class="bi bi-lightbulb me-2"></i>Get New Suggestion');
            },
            error: function() {
                $('#suggestion-text').html('<div class="alert alert-danger">⚠️ Error fetching suggestion. Please try again.</div>');
                $btn.prop('disabled', false).html('<i class="bi bi-lightbulb me-2"></i>Try Again');
            }
        });
    });
});

// Chart.js Configuration
document.addEventListener('DOMContentLoaded', function() {
    const chartDefaults = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 15,
                    fontSize: 11,
                    usePointStyle: true
                }
            }
        }
    };
    const totalIncome = {{ $incomes->sum('amount') ?? 0 }};
    const totalExpense = {{ $expenses->sum('amount') ?? 0 }};
    const totalOutcome = totalIncome - totalExpense;

    // Pie Charts - Fixed Size
    new Chart(document.getElementById('incomePieChart'), {
        type: 'pie',
        data: {
            labels: ['Income', 'Expenses'],
            datasets: [{
                data: [totalIncome, totalExpense],
                backgroundColor: ['#10b981', '#f87171'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            ...chartDefaults,
            aspectRatio: 1
        }
    });

    new Chart(document.getElementById('expensePieChart'), {
        type: 'pie',
        data: {
            labels: ['Expenses', 'Remaining'],
            datasets: [{
                data: [totalExpense, Math.max(0, totalOutcome)],
                backgroundColor: ['#f87171', '#10b981'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            ...chartDefaults,
            aspectRatio: 1
        }
    });

    new Chart(document.getElementById('outcomePieChart'), {
        type: 'pie',
        data: {
            labels: ['Net Outcome', 'Total Income', 'Total Expenses'],
            datasets: [{
                data: [Math.abs(totalOutcome), totalIncome, totalExpense],
                backgroundColor: ['#38b6ff', '#10b981', '#f87171'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            ...chartDefaults,
            aspectRatio: 1
        }
    });

    // Monthly Charts
    const monthLabels = @json($monthLabels ?? []);
    const monthData = @json($monthData ?? []);

    if (monthLabels.length > 0) {
        new Chart(document.getElementById('monthChart'), {
            type: 'doughnut',
            data: {
                labels: monthLabels,
                datasets: [{
                    data: monthData,
                    backgroundColor: ['#2563eb', '#38b6ff', '#fbbf24', '#10b981', '#f87171', '#a78bfa']
                }]
            },
            options: chartDefaults
        });
    }

    const incomeLabels = @json($incomes->groupBy('title')->keys()->toArray());
    const incomeData = @json($incomes->groupBy('title')->map->sum('amount')->values()->toArray());

    if (incomeLabels.length > 0) {
        new Chart(document.getElementById('monthIncomeChart'), {
            type: 'doughnut',
            data: {
                labels: incomeLabels,
                datasets: [{
                    data: incomeData,
                    backgroundColor: ['#10b981', '#38b6ff', '#fbbf24', '#f87171', '#a78bfa', '#2563eb']
                }]
            },
            options: chartDefaults
        });
    }

    // YEARLY CHART - FIXED SIZE, ALWAYS VISIBLE
    const yearLabels = @json($yearLabels ?? []);
    const yearExpenseData = @json($yearData ?? []);
    @php
        $currentYear = request('year') ?? now()->year;
        $yearIncomeData = collect(range(1,12))->map(function($m) use ($incomes, $currentYear) {
            return $incomes->where('date', '>=', \Carbon\Carbon::create($currentYear, $m, 1)->startOfMonth())
                           ->where('date', '<=', \Carbon\Carbon::create($currentYear, $m, 1)->endOfMonth())
                           ->sum('amount');
        });
    @endphp
    const yearIncomeData = @json($yearIncomeData);

    new Chart(document.getElementById('yearChart'), {
        type: 'bar',
        data: {
            labels: yearLabels.length > 0 ? yearLabels : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Expenses',
                data: yearExpenseData.length > 0 ? yearExpenseData : Array(12).fill(0),
                backgroundColor: '#f87171',
                borderRadius: 6,
                borderWidth: 1,
                borderColor: '#fff'
            }, {
                label: 'Income',
                data: yearIncomeData.length > 0 ? yearIncomeData : Array(12).fill(0),
                backgroundColor: '#10b981',
                borderRadius: 6,
                borderWidth: 1,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#2563eb',
                    bodyColor: '#374151',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': PKR ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            return 'PKR ' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection --}}

















@extends('layouts.app')
@section('content')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-blue: #2563eb;
            --secondary-blue: #38b6ff;
            --success-green: #10b981;
            --danger-red: #f87171;
            --text-gray: #6b7280;
            --bg-light: #f8fafc;
            --shadow-light: rgba(56, 163, 220, 0.08);
            --shadow-medium: rgba(56, 163, 220, 0.16);
            --shadow-heavy: rgba(56, 163, 220, 0.25);
        }

        body {
            background: linear-gradient(135deg, #f4f7fd 0%, #e9eefb 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
        }

        /* Common Components */
        .btn-gradient {
            background: linear-gradient(90deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
            border: none;
            color: #fff;
            border-radius: 2rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 6px 24px var(--shadow-medium);
            color: #fff;
        }

        .card-modern {
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px var(--shadow-medium);
            border: none;
            transition: all 0.3s ease;
        }

        .card-modern:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 32px var(--shadow-heavy);
        }

        /* FORCE PIE CHARTS IN ONE ROW */
        .pie-charts-wrapper {
            display: flex !important;
            flex-wrap: nowrap !important;
            justify-content: space-between !important;
            gap: 1.5rem !important;
            margin-bottom: 3rem !important;
        }

        .pie-chart-column {
            flex: 1 !important;
            min-width: 0 !important;
            max-width: 33.333% !important;
        }

        /* Pie Chart Cards */
        .pie-chart-card {
            background: #fff;
            border-radius: 1.3rem;
            box-shadow: 0 4px 20px var(--shadow-medium);
            padding: 1.5rem 1rem;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
            width: 100%;
        }

        .pie-chart-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px var(--shadow-heavy);
        }

        .pie-chart-container {
            width: 180px;
            height: 180px;
            margin: 0 auto 1rem;
            position: relative;
        }

        .chart-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .chart-total {
            background: linear-gradient(90deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
            color: #fff;
            font-size: 0.95rem;
            font-weight: 600;
            padding: 0.8rem 1rem;
            border-radius: 1rem;
            margin-top: 1rem;
        }

        /* AI Suggestions */
        .ai-section {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .ai-card {
            background: linear-gradient(135deg, #eaf1fc 0%, var(--bg-light) 100%);
            border-radius: 1.5rem;
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
            display: none;
        }

        .ai-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
            border-radius: 1.5rem 1.5rem 0 0;
        }

        .ai-icon {
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
            color: #fff;
            border-radius: 50%;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(56, 163, 220, 0.4);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(56, 163, 220, 0.1);
            }
        }

        /* Filter Form */
        .filter-form {
            max-width: 800px;
            margin: 0 auto 2rem;
            padding: 1.2rem;
            background: var(--bg-light);
            border-radius: 1.2rem;
            display: flex;
            gap: 1rem;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .filter-form .form-group {
            min-width: 140px;
            flex: 1 1 140px;
        }

        .filter-form label {
            font-weight: 600;
            color: var(--primary-blue);
            font-size: 0.95rem;
        }

        .filter-form .form-select,
        .filter-form .btn {
            border-radius: 1rem;
            min-width: 100px;
        }

        /* FIXED YEARLY CHART - ALWAYS VISIBLE */
        .yearly-chart-section {
            margin: 3rem 0;
        }

        .yearly-chart-container {
            max-width: 1100px;
            width: 100%;
            height: 500px;
            margin: 0 auto;
        }

        .yearly-chart-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 2rem;
        }

        .yearly-chart-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            text-align: center;
            margin-bottom: 2rem;
        }

        #yearChart {
            width: 100% !important;
            height: 420px !important;
            max-height: 420px !important;
        }

        /* Monthly Charts Section - Now Hidden */
        .monthly-charts-section {
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .pie-charts-wrapper {
                flex-wrap: wrap !important;
            }

            .pie-chart-column {
                max-width: 50% !important;
                flex: 1 1 45% !important;
                margin-bottom: 1.5rem;
            }

            .yearly-chart-container {
                height: 400px;
            }

            #yearChart {
                height: 320px !important;
                max-height: 320px !important;
            }
        }

        @media (max-width: 768px) {
            .filter-form {
                flex-direction: column;
                gap: 0.5rem;
            }

            .pie-charts-wrapper {
                flex-direction: column !important;
                gap: 1rem !important;
            }

            .pie-chart-column {
                max-width: 100% !important;
                flex: 1 1 100% !important;
            }

            .pie-chart-container {
                width: 150px;
                height: 150px;
            }

            .chart-total {
                font-size: 0.9rem;
                padding: 0.6rem 1rem;
            }

            .yearly-chart-container {
                height: 350px;
            }

            #yearChart {
                height: 270px !important;
                max-height: 270px !important;
            }
        }

        @media (max-width: 576px) {
            .pie-chart-container {
                width: 120px;
                height: 120px;
            }

            .chart-total {
                font-size: 0.8rem;
                padding: 0.5rem 0.8rem;
            }

            .yearly-chart-container {
                height: 300px;
            }

            #yearChart {
                height: 220px !important;
                max-height: 220px !important;
            }
        }
    </style>

    <!-- AI Suggestions Section -->
    {{-- <div class="ai-section">
        <button id="show-ai-card" class="btn btn-gradient">
            <i class="bi bi-robot me-2"></i>Get AI Suggestion
        </button>
        <div class="ai-card card-modern" id="ai-suggestions">
            <button class="btn-close position-absolute top-0 end-0 m-3" id="hide-ai-card"></button>
            <div class="d-flex align-items-center mb-3">
                <div class="ai-icon me-3">
                    <i class="bi bi-robot"></i>
                </div>
                <h5 class="mb-0 text-primary">AI Financial Suggestions</h5>
            </div>
            <div class="position-relative">
                <div id="suggestion-text" class="p-3 bg-light rounded-3 mb-3">
                    <span class="text-muted">Click "Get Suggestion" to receive AI advice on your spending patterns.</span>
                </div>
            </div>
            <button id="get-suggestion" class="btn btn-gradient">
                <i class="bi bi-lightbulb me-2"></i>Get Suggestion
            </button>
        </div>
    </div> --}}

    <div class="container py-4">



        <!-- Filter Form - Updated with better value preservation -->
        <form method="GET" action="{{ route('dashboard') }}" class="filter-form">
            <div class="form-group">
                <label for="month">Month</label>
                <select name="month" id="month" class="form-select">
                    <option value="">All Months</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ (string) request('month') === (string) $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="year">Year</label>
                <select name="year" id="year" class="form-select">
                    <option value="">All Years</option>
                    @for ($y = now()->year; $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ (string) request('year') === (string) $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="form-group d-flex gap-2">
                <button type="submit" class="btn btn-gradient">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
        <!-- PIE CHARTS IN ONE ROW - CATEGORY BREAKDOWN -->
        <div class="pie-charts-wrapper">
            <div class="pie-chart-column">
                <div class="pie-chart-card">
                    <h6 class="chart-title">📈 Income Categories</h6>
                    <div class="pie-chart-container">
                        <canvas id="incomePieChart"></canvas>
                    </div>
                    <div class="chart-total">
                        Total Income (PKR)<br>
                        <strong>{{ number_format($incomes->sum('amount') ?? 0, 2) }}</strong>
                    </div>
                </div>
            </div>
            <div class="pie-chart-column">
                <div class="pie-chart-card">
                    <h6 class="chart-title">💰 Expense Categories</h6>
                    <div class="pie-chart-container">
                        <canvas id="expensePieChart"></canvas>
                    </div>
                    <div class="chart-total">
                        Total Expenses (PKR)<br>
                        <strong>{{ number_format($expenses->sum('amount') ?? 0, 2) }}</strong>
                    </div>
                </div>
            </div>
            <div class="pie-chart-column">
                <div class="pie-chart-card">
                    <h6 class="chart-title">⚖️ Financial Balance</h6>
                    <div class="pie-chart-container">
                        <canvas id="outcomePieChart"></canvas>
                    </div>
                    <div class="chart-total">
                        Net Outcome (PKR)<br>
                        <strong>{{ number_format(($incomes->sum('amount') ?? 0) - ($expenses->sum('amount') ?? 0), 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- YEARLY CHART - ALWAYS VISIBLE WITH FIXED SIZE -->
    <div class="yearly-chart-section">
        <div class="yeart-container">
            <div class="yearly-chart-card card-modern">
                <h3 class="yearly-chart-title">📈 Annual Financial Overview ({{ request('year') ?? now()->year }})</h3>
                <canvas id="yearChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // AI Suggestions
            $('#show-ai-card').click(() => {
                $('#show-ai-card').hide();
                $('#ai-suggestions').fadeIn(300);
            });

            $('#hide-ai-card').click(() => {
                $('#ai-suggestions').fadeOut(200, () => {
                    $('#show-ai-card').show();
                    $('#suggestion-text').html(
                        '<span class="text-muted">Click "Get Suggestion" to receive AI advice on your spending patterns.</span>'
                    );
                    $('#get-suggestion').prop('disabled', false);
                });
            });

            $('#get-suggestion').click(function() {
                const $btn = $(this);
                $btn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm me-2"></span>Loading...');

                $.ajax({
                    url: "{{ route('expense.ai.suggestion') }}",
                    type: 'GET',
                    success: function(response) {
                        let formatted = response.suggestion.includes('- ') ?
                            '<ul>' + response.suggestion.replace(/- /g, '<li>').replace(/\n/g,
                                '</li>') + '</ul>' :
                            response.suggestion;
                        $('#suggestion-text').html(formatted);
                        $btn.prop('disabled', false).html(
                            '<i class="bi bi-lightbulb me-2"></i>Get New Suggestion');
                    },
                    error: function() {
                        $('#suggestion-text').html(
                            '<div class="alert alert-danger">⚠️ Error fetching suggestion. Please try again.</div>'
                        );
                        $btn.prop('disabled', false).html(
                            '<i class="bi bi-lightbulb me-2"></i>Try Again');
                    }
                });
            });
        });

        // Chart.js Configuration
        document.addEventListener('DOMContentLoaded', function() {
            const chartDefaults = {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 10,
                            fontSize: 10,
                            usePointStyle: true,
                            boxWidth: 12
                        }
                    }
                }
            };

            const totalIncome = {{ $incomes->sum('amount') ?? 0 }};
            const totalExpense = {{ $expenses->sum('amount') ?? 0 }};
            const totalOutcome = totalIncome - totalExpense;

            // INCOME CATEGORIES BREAKDOWN PIE CHART
            const incomeLabels = @json($incomes->groupBy('title')->keys()->toArray());
            const incomeData = @json($incomes->groupBy('title')->map->sum('amount')->values()->toArray());

            new Chart(document.getElementById('incomePieChart'), {
                type: 'pie',
                data: {
                    labels: incomeLabels.length > 0 ? incomeLabels : ['No Income Data'],
                    datasets: [{
                        data: incomeData.length > 0 ? incomeData : [1],
                        backgroundColor: incomeLabels.length > 0 ? [
                            '#10b981', '#38b6ff', '#fbbf24', '#a78bfa', '#f472b6', '#06d6a0',
                            '#ef4444', '#8b5cf6', '#f59e0b', '#3b82f6', '#6366f1', '#14b8a6'
                        ] : ['#e5e7eb'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    ...chartDefaults,
                    aspectRatio: 1,
                    plugins: {
                        ...chartDefaults.plugins,
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.parsed;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return context.label + ': PKR ' + value.toLocaleString() + ' (' +
                                        percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });

            // EXPENSE CATEGORIES BREAKDOWN PIE CHART
            const expenseLabels = @json($expenses->groupBy('title')->keys()->toArray());
            const expenseData = @json($expenses->groupBy('title')->map->sum('amount')->values()->toArray());

            new Chart(document.getElementById('expensePieChart'), {
                type: 'pie',
                data: {
                    labels: expenseLabels.length > 0 ? expenseLabels : ['No Expense Data'],
                    datasets: [{
                        data: expenseData.length > 0 ? expenseData : [1],
                        backgroundColor: expenseLabels.length > 0 ? [
                            '#f87171', '#2563eb', '#38b6ff', '#fbbf24', '#10b981', '#a78bfa',
                            '#f472b6', '#06d6a0', '#ef4444', '#8b5cf6', '#f59e0b', '#3b82f6'
                        ] : ['#e5e7eb'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    ...chartDefaults,
                    aspectRatio: 1,
                    plugins: {
                        ...chartDefaults.plugins,
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.parsed;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return context.label + ': PKR ' + value.toLocaleString() + ' (' +
                                        percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });

            // OUTCOME PIE CHART (Income vs Expenses comparison)
            new Chart(document.getElementById('outcomePieChart'), {
                type: 'pie',
                data: {
                    labels: ['Total Income', 'Total Expenses'],
                    datasets: [{
                        data: [Math.abs(totalIncome), totalExpense],
                        backgroundColor: ['#38b6ff', '#f87171'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    ...chartDefaults,
                    aspectRatio: 1,
                    plugins: {
                        ...chartDefaults.plugins,
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': PKR ' + context.parsed.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });

            // YEARLY CHART - FIXED SIZE, ALWAYS VISIBLE
            const yearLabels = @json($yearLabels ?? []);
            const yearExpenseData = @json($yearData ?? []);
            @php
                $currentYear = request('year') ?? now()->year;
                $yearIncomeData = collect(range(1, 12))->map(function ($m) use ($incomes, $currentYear) {
                    return $incomes
                        ->where('date', '>=', \Carbon\Carbon::create($currentYear, $m, 1)->startOfMonth())
                        ->where('date', '<=', \Carbon\Carbon::create($currentYear, $m, 1)->endOfMonth())
                        ->sum('amount');
                });
            @endphp
            const yearIncomeData = @json($yearIncomeData);

            new Chart(document.getElementById('yearChart'), {
                type: 'bar',
                data: {
                    labels: yearLabels.length > 0 ? yearLabels : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                    ],
                    datasets: [{
                        label: 'Expenses',
                        data: yearExpenseData.length > 0 ? yearExpenseData : Array(12).fill(0),
                        backgroundColor: '#f87171',
                        borderRadius: 6,
                        borderWidth: 1,
                        borderColor: '#fff'
                    }, {
                        label: 'Income',
                        data: yearIncomeData.length > 0 ? yearIncomeData : Array(12).fill(0),
                        backgroundColor: '#10b981',
                        borderRadius: 6,
                        borderWidth: 1,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.95)',
                            titleColor: '#2563eb',
                            bodyColor: '#374151',
                            borderColor: '#e5e7eb',
                            borderWidth: 1,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': PKR ' + context.parsed.y
                                        .toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    weight: 'bold'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return 'PKR ' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

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
  },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } }
                }
            });

            // YEAR COMPARISON CHART
            const yearLabels = @json($yearLabels ?? []);
            const yearExpenseData = @json($yearData ?? []);
            // Get year income data per month
            @php
                $currentYear = request('year') ?? now()->year;
                $yearIncomeData = collect(range(1,12))->map(function($m) use ($incomes, $currentYear) {
                    return $incomes->where('date', '>=', \Carbon\Carbon::create($currentYear, $m, 1)->startOfMonth())
                                   ->where('date', '<=', \Carbon\Carbon::create($currentYear, $m, 1)->endOfMonth())
                                   ->sum('amount');
                });
            @endphp
            const yearIncomeData = @json($yearIncomeData);
            const ctxYear = document.getElementById('yearChart').getContext('2d');
            new Chart(ctxYear, {
                type: 'bar',
                data: {
                    labels: yearLabels,
                    datasets: [
                        {
                            label: 'Expenses',
                            data: yearExpenseData,
                            backgroundColor: '#f87171'
                        },
                        {
                            label: 'Income',
                            data: yearIncomeData,
                            backgroundColor: '#10b981'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'top' } },
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 50 } }
                    }
                }
            });
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
