@extends('layouts.app')
@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #f4f7fd 0%, #e9eefb 100%);
            min-height: 100vh;
        }

        .incomes-edit-container {
            min-height: 70vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .incomes-edit-card {
            width: 100%;
            max-width: 420px;
            border-radius: 2rem;
            background: #fff;
            box-shadow: 0 12px 32px 0 rgba(31, 38, 135, 0.12);
            padding: 2.2rem 2rem 2rem 2rem;
            margin-top: 2.5rem;
        }

        .incomes-edit-header {
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

        .incomes-edit-header .bi {
            font-size: 2rem;
        }

        .incomes-edit-form .form-group {
            margin-bottom: 1.2rem;
            display: flex;
            flex-direction: column;
        }

        .incomes-edit-form .form-label {
            font-weight: 600;
            color: #2563eb;
            font-size: 1rem;
            margin-bottom: 0.25rem;
            margin-left: 2px;
        }

        .incomes-edit-form .form-control {
            border-radius: 1rem;
            font-size: 1.06rem;
            padding: 0.7rem 1rem;
        }

        .incomes-edit-form .btn-primary {
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
        }

        .incomes-edit-form .btn-primary:hover {
            transform: scale(1.04) translateY(-2px);
            box-shadow: 0 6px 24px rgba(56, 163, 220, 0.19);
            color: #fff;
        }

        .incomes-edit-form .btn-secondary {
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

        .incomes-edit-form .btn-secondary:hover {
            background: #2563eb;
            color: #fff;
        }
    </style>
    <div class="incomes-edit-container container py-5">
        <div class="incomes-edit-card">
            <div class="incomes-edit-header">
                <i class="bi bi-pencil-square"></i> Edit Income
            </div>
            {{-- Back Button --}}
            <a href="{{ route('incomes.index') }}" class="btn btn-secondary incomes-edit-form mb-3">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
            {{-- Edit Income Form --}}
            <form method="POST" action="{{ route('incomes.update', $income->id) }}" class="incomes-edit-form mt-2">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label" for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $income->title) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="amount">Amount</label>
                    <input type="number" step="0.01" name="amount" id="amount" class="form-control"
                        value="{{ old('amount', $income->amount) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $income->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control"
                        value="{{ old('date', $income->date) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update Income
                </button>
            </form>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
