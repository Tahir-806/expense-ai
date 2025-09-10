<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{

    /**
     * Display a listing of the user's budgets.
     */
    public function index(Request $request)
    {
        $query = Budget::where('user_id', Auth::id());

        // Optional filtering
        if ($request->period) {
            $query->where('period', $request->period);
        }
        if ($request->month) {
            $query->where('month', $request->month);
        }
        if ($request->year) {
            $query->where('year', $request->year);
        }

        $budgets = $query->orderBy('created_at', 'desc')->get();

        return view('budgets.index', compact('budgets'));
    }

    /**
     * Show the form for creating a new budget.
     */
    public function create()
    {
        return view('budgets.create');
    }

    /**
     * Store a newly created budget in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount'  => 'required|numeric|min:0',
            'period'  => 'required|in:monthly,yearly',
            'month'   => 'nullable|integer|min:1|max:12',
            'year'    => 'nullable|integer|min:2000|max:' . now()->year,
            'category'=> 'nullable|string|max:255',
        ]);

        Budget::create([
            'user_id' => Auth::id(),
            'category'=> $request->category,
            'amount'  => $request->amount,
            'period'  => $request->period,
            'month'   => $request->month,
            'year'    => $request->year,
        ]);

        return redirect()->route('budgets.index')->with('success', 'Budget created successfully!');
    }

    /**
     * Show the form for editing the specified budget.
     */
    public function edit(Budget $budget)
    {
        // $this->authorize('update', $budget);
        return view('budgets.edit', compact('budget'));
    }

      public function update(Request $request, Budget $budget)
    {
        // $this->authorize('update', $budget);

        $request->validate([
            'amount'  => 'required|numeric|min:0',
            'period'  => 'required|in:monthly,yearly',
            'month'   => 'nullable|integer|min:1|max:12',
            'year'    => 'nullable|integer|min:2000|max:' . now()->year,
            'category'=> 'nullable|string|max:255',
        ]);

        $budget->update([
            'category'=> $request->category,
            'amount'  => $request->amount,
            'period'  => $request->period,
            'month'   => $request->month,
            'year'    => $request->year,
        ]);

        return redirect()->route('budgets.index')->with('success', 'Budget updated successfully!');
    }


    public function destroy(Budget $budget)
    {

        $budget->delete();

        return redirect()->route('budgets.index')->with('success', 'Budget deleted successfully!');
    }
}
