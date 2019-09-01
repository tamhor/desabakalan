<?php

namespace App\Http\Controllers;

use App\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Income::with('category')->get();
        $outcome = DB::table('outcomes')->get();
        // dd($category);
        return view('income.income', compact('category','outcome'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->OrderBy('id', 'desc')->limit(5)->get();

        return view('income.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'in_category' => 'required',
            'in_balance' => 'required'
            ]);
            
        $data = $request->all();
        $data['in_balance'] = intval(preg_replace('/,.*|[^0-9]/', '', $request->in_balance));

        Income::create($data);
        return redirect('/income')->with('status', 'Data pendapatan sudah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        return $income;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        $categories = DB::table('categories')->OrderBy('id', 'desc')->limit(5)->get();

        return view('income.edit', compact('income','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        $request->validate([
            'in_category' => 'required',
            'in_balance' => 'required'
        ]);

        $data = $request->all();
        $data['in_balance'] = intval(preg_replace('/,.*|[^0-9]/', '', $request->in_balance));
        
        Income::where('id', $income->id)
                ->update([
                    'in_category' => $request->in_category,
                    'in_balance' => $data['in_balance'],
                    'in_info' => $request->in_info
                ]);
        return redirect('/income')->with('status', 'Data Pendapatan sudah berhasil di Ubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        Income::destroy($income->id);
        // dd($outcome->id);
        return redirect('/income')->with('status', 'Data sudah berhasil dihapus!');
    }
}
