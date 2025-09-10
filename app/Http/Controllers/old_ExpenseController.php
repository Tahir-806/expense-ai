<?php
namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class ExpenseController extends Controller
{
    public function index(Request $request)
{
    $query = Expense::where('user_id', auth()->id());

    // Filtering
    if ($request->month) {
        $query->whereMonth('date', $request->month);
    }
    if ($request->year) {
        $query->whereYear('date', $request->year);
    }

    $expenses = $query->orderBy('date', 'desc')->get();

    // Selected Month Chart Data
    $monthLabels = $expenses->groupBy('title')->keys();
    $monthData = $expenses->groupBy('title')->map->sum('amount')->values();

    // Full Year Chart Data
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

    return view('expenses.index', compact(
        'expenses', 'monthLabels', 'monthData', 'yearLabels', 'yearData'
    ));
}


//     public function index(Request $request)
// {
//     $query = Expense::query();

//     if ($request->filled('month')) {
//         $query->whereMonth('date', $request->month);
//     }

//     if ($request->filled('year')) {
//         $query->whereYear('date', $request->year);
//     }

//     $expenses = $query->get();

//     return view('expenses.index', compact('expenses'));
// }



    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'amount' => 'required|numeric',
        'date' => 'required|date',
    ]);

    Expense::create([
        'user_id' => auth()->id(),
        'title'   => $request->title,
        'amount'  => $request->amount,
        'date'    => $request->date,
    ]);

    return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
}
public function create()
{
    return view('expenses.create');
}

// for ai suggestion
// public function getAISuggestion()
// {
//     $expenses = Expense::where('user_id', auth()->id())->get();

//     $summary = $expenses->groupBy(function($item) {
//         return $item->category ?? 'Other';
//     })->map->sum('amount');

//     // Yahan tum OpenAI API call karoge
//     $aiResponse = "It seems you spent the most on ".$summary.". Try reducing it next month.";

//     return response()->json([
//         'suggestion' => $aiResponse
//     ]);
// }

// public function getAISuggestion()
// {
//     // Current logged-in user ke saare expenses
//     $expenses = Expense::where('user_id', auth()->id())->get();

//     if ($expenses->isEmpty()) {
//         return response()->json([
//             'suggestion' => 'No expenses found to analyze.'
//         ]);
//     }

//     // Category-wise total amount calculate karna
//     $summary = $expenses->groupBy(function($item) {
//         return $item->category ?? 'Other';
//     })->map->sum('amount');

//     // Sabse zyada expense wali category
//     $topCategory = $summary->sortDesc()->keys()->first();
//     $topAmount = $summary[$topCategory];

//     // Suggestion message create karna
//     $aiResponse = "Your highest spending is in the category '$topCategory' (Total: $topAmount).
//     You might want to monitor this category next month to save more.";

//     return response()->json([
//         'suggestion' => $aiResponse
//     ]);
// }

// public function getAISuggestion()
// {
//     // Current logged-in user ke saare expenses
//     $expenses = Expense::where('user_id', auth()->id())->get();

//     if ($expenses->isEmpty()) {
//         return response()->json([
//             'suggestion' => 'No expenses found to analyze.'
//         ]);
//     }

//     // Sabse zyada amount wala expense
//     $topExpense = $expenses->sortByDesc('amount')->first();

//     $title = $topExpense->title ?? 'Untitled';
//     $amount = number_format($topExpense->amount, 2);

//     // Suggestion message
//     $aiResponse = "Your highest spending is on '$title' (Amount: $amount).
//     Consider reviewing this expense next month to save money.";

//     return response()->json([
//         'suggestion' => $aiResponse
//     ]);
// }

// public function getAISuggestion()
// {
//     // Current logged-in user ke saare expenses (amount ke hisaab se descending order)
//     $topExpenses = Expense::where('user_id', auth()->id())
//         ->orderByDesc('amount')
//         ->take(3)
//         ->get(['title', 'amount']); // Sirf title aur amount columns

//     if ($topExpenses->isEmpty()) {
//         return response()->json([
//             'suggestion' => 'No expenses found to analyze.'
//         ]);
//     }

//     // Top 3 expenses ka text banaye
//     $expenseList = $topExpenses->map(function ($expense) {
//         return "{$expense->title} (Total: {$expense->amount})";
//     })->implode(', ');

//     // Suggestion message
//     $aiResponse = "Your top 3 expenses are: {$expenseList}.
//     Consider reviewing these to manage your budget better next month.";

//     return response()->json([
//         'suggestion' => $aiResponse
//     ]);
// }




public function showForm()
    {
        return view('expense-ai-suggestion.expense-form');
    }

    // public function getSuggestion(Request $request)
    // {
    //     $expenses = $request->input('expenses');
    //     $url = 'https://api-inference.huggingface.co/models/google/flan-t5-base';

    //     $response = Http::timeout(60)->withHeaders([
    //         'Authorization' => 'Bearer ' . env('HUGGINGFACE_API_KEY'),
    //         'Content-Type' => 'application/json',
    //     ])->post($url, [
    //         'inputs' => "Analyze the following expenses and suggest how to reduce costs:\n" . $expenses
    //     ]);

    //     dd([
    //         'status' => $response->status(),
    //         'body'   => $response->body()
    //     ]);

    //     // Hugging Face API request
    //     // $response = Http::withHeaders([
    //     //     'Authorization' => 'Bearer ' . env('HUGGINGFACE_API_KEY'),
    //     //     'Content-Type' => 'application/json',
    //     // ])->post('https://api-inference.huggingface.co/models/google/flan-t5-base', [
    //     //     'inputs' => "Analyze the following expenses and suggest how to reduce costs:\n" . $expenses
    //     // ]);

    //     // dd([
    //     //     'status' => $response->status(),
    //     //     'body'   => $response->body()
    //     // ]);
    //     // $data = $response->json();
    //     // dd($data);

    //     return view('expense-ai-suggestion.expense-form', [
    //         'expenses' => $expenses,
    //         'suggestion' => $data[0]['generated_text'] ?? 'No suggestion received'
    //     ]);
    // }

    // public function getSuggestion(Request $request)
    // {
    //     $request->validate([
    //         'expenses' => 'required|string',
    //     ]);

    //     $expenses = $request->input('expenses');

    //     // Cohere API request
    //     $response = Http::withHeaders([
    //         'Authorization' => 'Bearer ' . env('COHERE_API_KEY'),
    //         'Content-Type' => 'application/json',
    //     ])->post('https://api.cohere.ai/v1/generate', [
    //         'model' => 'command-light', // Free tier model
    //         'prompt' => "Analyze these expenses and suggest ways to reduce costs: " . $expenses,
    //         'max_tokens' => 150
    //     ]);

    //     $data = $response->json();

    //     $suggestion = $data['generations'][0]['text'] ?? 'No suggestion received';

    //     return view('expense-ai-suggestion.expense-form', compact('expenses', 'suggestion'));
    // }

//     public function getAISuggestion()
// {
//     // Current logged-in user ke saare expenses
//     $expenses = Expense::where('user_id', auth()->id())->get();

//     if ($expenses->isEmpty()) {
//         return response()->json([
//             'suggestion' => 'No expenses found to analyze.'
//         ]);
//     }

//     // Top 3 expenses by amount
//     $topExpenses = $expenses->sortByDesc('amount')->take(3);

//     // Prepare text for AI prompt
//     $expenseText = "";
//     foreach ($topExpenses as $exp) {
//         $expenseText .= "{$exp->title}: {$exp->amount}\n";
//     }

//     // Cohere API call
//     $response = Http::withHeaders([
//         'Authorization' => 'Bearer ' . env('COHERE_API_KEY'),
//         'Content-Type' => 'application/json',
//     ])->post('https://api.cohere.ai/v1/generate', [
//         'model' => 'command-light', // Free tier model
//         'prompt' => "Analyze the following top 3 expenses and suggest ways to reduce costs:\n" . $expenseText,
//         'max_tokens' => 150
//     ]);

//     $data = $response->json();

//     $aiSuggestion = $data['generations'][0]['text'] ?? 'No suggestion received';

//     return response()->json([
//         'suggestion' => $aiSuggestion
//     ]);
// }

public function getAISuggestion()
{
    $expenses = Expense::where('user_id', auth()->id())->get();

    if ($expenses->isEmpty()) {
        return response()->json(['suggestion' => 'No expenses found to analyze.']);
    }

    $topExpenses = $expenses->sortByDesc('amount')->take(3);

    $expenseText = "";
    foreach ($topExpenses as $exp) {
        $expenseText .= "{$exp->title}: {$exp->amount}\n";
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('COHERE_API_KEY'),
        'Content-Type' => 'application/json',
    ])->get('https://api.cohere.ai/v1/generate', [
        'model' => 'command-light',
        'prompt' => "Analyze the following top 3 expenses and suggest ways to reduce costs:\n" . $expenseText,
        'max_tokens' => 150
    ]);

    $data = $response->json();

    $aiSuggestion = $data['generations'][0]['text'] ?? 'No suggestion received';

    return response()->json(['suggestion' => $aiSuggestion]);
}


}
