<?php
namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Income;

use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
//     public function index(Request $request)
// {
//     $query = Expense::where('user_id', auth()->id());

//     // Filtering
//     if ($request->month) {
//         $query->whereMonth('date', $request->month);
//     }
//     if ($request->year) {
//         $query->whereYear('date', $request->year);
//     }

//     $expenses = $query->orderBy('date', 'desc')->get();

//     // Selected Month Chart Data
//     $monthLabels = $expenses->groupBy('title')->keys();
//     $monthData = $expenses->groupBy('title')->map->sum('amount')->values();

//     // Full Year Chart Data
//     $currentYear = $request->year ?? now()->year;
//     $yearExpenses = Expense::where('user_id', auth()->id())
//         ->whereYear('date', $currentYear)
//         ->get()
//         ->groupBy(function($item) {
//             return \Carbon\Carbon::parse($item->date)->format('F');
//         });

//     $yearLabels = collect(range(1, 12))->map(function($m) {
//         return \Carbon\Carbon::create()->month($m)->format('F');
//     });

//     $yearData = $yearLabels->map(function($month) use ($yearExpenses) {
//         return $yearExpenses->get($month)?->sum('amount') ?? 0;
//     });

//     $categories = \App\Models\Category::all();

//     // for income

//     $query = Income::where('user_id', auth()->id());


//         // Filtering
//         if ($request->month) {
//             $query->whereMonth('date', $request->month);
//         }
//         if ($request->year) {
//             $query->whereYear('date', $request->year);
//         }

//         $incomes = $query->orderBy('date', 'desc')->get();
//         //  $categories = \App\Models\Category::all();

//     return view('dashboard', compact(
//         'expenses', 'monthLabels', 'monthData', 'yearLabels', 'yearData', 'categories', 'incomes'
//     ));
// }

// ... existing code above ...

public function index(Request $request)
{
    // Expense
    $query = Expense::where('user_id', auth()->id());
    if ($request->month) {
        $query->whereMonth('date', $request->month);
    }
    if ($request->year) {
        $query->whereYear('date', $request->year);
    }
    $expenses = $query->orderBy('date', 'desc')->get();

    // Income
    $incomeQuery = Income::where('user_id', auth()->id());
    if ($request->month) {
        $incomeQuery->whereMonth('date', $request->month);
    }
    if ($request->year) {
        $incomeQuery->whereYear('date', $request->year);
    }
    $incomes = $incomeQuery->orderBy('date', 'desc')->get();

    // Selected period totals
    $totalIncome = $incomes->sum('amount');
    $totalExpense = $expenses->sum('amount');
    $totalOutcome = $totalIncome - $totalExpense;

    // Existing chart data (keep as is)
    $monthLabels = $expenses->groupBy('title')->keys();
    $monthData = $expenses->groupBy('title')->map->sum('amount')->values();

    $currentYear = $request->year ?? now()->year;
    $yearExpenses = Expense::where('user_id', auth()->id())
        ->whereYear('date', $currentYear)
        ->get()
        ->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->date)->format('F');
        });

    $yearLabels = collect(range(1, 12))->map(function($m) {
        return \Carbon\Carbon::create()->month($m)->format('F');
    });

    $yearData = $yearLabels->map(function($month) use ($yearExpenses) {
        return $yearExpenses->get($month)?->sum('amount') ?? 0;
    });

    $categories = \App\Models\Category::all();

    return view('dashboard', compact(
        'expenses', 'monthLabels', 'monthData', 'yearLabels', 'yearData', 'categories', 'incomes',
        'totalIncome', 'totalExpense', 'totalOutcome'
    ));
}
}

//     public function store(Request $request)
// {
//     $request->validate([
//         'title' => 'required|string|max:255',
//         'amount' => 'required|numeric',
//         'date' => 'required|date',
//          'category_id' => 'required|exists:categories,id',
//     ]);

//     Expense::create([
//         'user_id' => auth()->id(),
//         'title'   => $request->title,
//         'amount'  => $request->amount,
//         'date'    => $request->date,
//         'category_id' => $request->category_id,
//     ]);

//     return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
// }
// public function create()
// {
//      $categories = \App\Models\Category::all()->where('type', 'expense');
//     return view('expenses.create' , compact('categories'));
// }


// public function showForm()
//     {
//         return view('expense-ai-suggestion.expense-form');
//     }

//     public function getAISuggestion()
//     {
//         $expenses = Expense::where('user_id', auth()->id())->get();

//         if ($expenses->isEmpty()) {
//             return response()->json(['suggestion' => 'No expenses found to analyze.']);
//         }

//         $topExpenses = $expenses->sortByDesc('amount')->take(3);

//         $expenseText = "";
//         foreach ($topExpenses as $exp) {
//             $expenseText .= "{$exp->title}: {$exp->amount}\n";
//         }

//         // Correct POST request
//         $response = Http::withHeaders([
//             'Authorization' => 'Bearer ' . env('COHERE_API_KEY'),
//             'Content-Type' => 'application/json',
//         ])->post('https://api.cohere.ai/v1/generate', [
//             'model' => 'command-light',
//             'prompt' => "Analyze the following top 3 expenses and suggest ways to reduce costs:\n" . $expenseText,

//         ]);

//         $data = $response->json();

//         $aiSuggestion = $data['generations'][0]['text'] ?? 'No suggestion received';

//         return response()->json(['suggestion' => $aiSuggestion]);
//     }




//       public function edit(Expense $expense)
//     {
//         // $this->authorize('update', $expense);
//         $categories = \App\Models\Category::all()->where('type', 'expense');
//         return view('expenses.edit', compact('expense'), compact('categories'));
//     }

//       public function update(Request $request, Expense $expense)
//     {
//         // $this->authorize('update', $expense);

//         $request->validate([
//             'title'  => 'required|string|max:255',
//             'amount' => 'required|numeric',
//             'date'   => 'required|date',
//              'category_id' => 'required|exists:categories,id',
//         ]);

//         $expense->update([
//             'title'  => $request->title,
//             'amount' => $request->amount,
//             'date'   => $request->date,
//             'category_id' => $request->category_id,
//         ]);

//         return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
//     }


//     public function destroy(Expense $expense)
//     {
//         $expense->delete();

//         return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
//     }
// }
