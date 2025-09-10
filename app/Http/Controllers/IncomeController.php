<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;



class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Income::where('user_id', auth()->id());


        // Filtering
        if ($request->month) {
            $query->whereMonth('date', $request->month);
        }
        if ($request->year) {
            $query->whereYear('date', $request->year);
        }

        $incomes = $query->orderBy('date', 'desc')->get();
         $categories = \App\Models\Category::all();

        return view('incomes.index', compact('incomes', 'categories'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all()->where('type', 'income');

        return view('incomes.create' , compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
             'category_id' => 'required|exists:categories,id',
        ]);

        Income::create([
            'user_id' => auth()->id(),
            'title'   => $request->title,
            'amount'  => $request->amount,
            'date'    => $request->date,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('incomes.index')->with('success', 'Income added successfully!');
    }


    public function edit($id)
{
    // Fetch the income for the current user
    $income = Income::where('user_id', Auth::id())->findOrFail($id);
    $categories = \App\Models\Category::all()->where('type', 'income');
    return view('incomes.edit', compact('income', 'categories'));
}

// public function update(Request $request, $id)
// {
//     $income = Income::where('user_id', Auth::id())->findOrFail($id);

//     $request->validate([
//         'title'  => 'required|string|max:255',
//         'amount' => 'required|numeric|min:0',
//         'date'   => 'required|date',
//     ]);

//     $income->update([
//         'title'  => $request->title,
//         'amount' => $request->amount,
//         'date'   => $request->date,
//     ]);

//     return redirect()->route('incomes.index')->with('success', 'Income updated successfully!');
// }
public function update(Request $request, $id)
{
    $income = Income::where('user_id', Auth::id())->findOrFail($id);

    $request->validate([
        'title'       => 'required|string|max:255',
        'amount'      => 'required|numeric|min:0',
        'date'        => 'required|date',
        'category_id' => 'required|exists:categories,id',
    ]);

    $income->update([
        'title'       => $request->title,
        'amount'      => $request->amount,
        'date'        => $request->date,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('incomes.index')->with('success', 'Income updated successfully!');
}

public function destroy($id)
{
    $income = Income::where('user_id', Auth::id())->findOrFail($id);
    $income->delete();

    return redirect()->route('incomes.index')->with('success', 'Income deleted successfully!');
}
}
