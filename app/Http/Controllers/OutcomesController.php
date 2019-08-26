<?php

namespace App\Http\Controllers;

use App\Outcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutcomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outcomes = Outcome::with('category')->get();
        // dd($outcomes);
        return view('outcome.outcome', compact('outcomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('outcome.create', compact('categories'));
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
            'out_category' => 'required',
            'out_description' => 'required',
            'out_balance' => 'required'
        ]);

        Outcome::create($request->all());
        return redirect('/outcome')->with('status', 'Data sudah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function show(Outcome $outcome)
    {
        return $outcome;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function edit(Outcome $outcome)
    {
        $categories = DB::table('categories')->get();

        return view('outcome.edit', compact('outcome','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outcome $outcome)
    {
        $request->validate([
            'out_category' => 'required',
            'out_description' => 'required',
            'out_balance' => 'required'
        ]);
        
        Outcome::where('id', $outcome->id)
                ->update([
                    'out_category' => $request->out_category,
                    'out_description' => $request->out_description,
                    'out_balance' => $request->out_balance,
                    'out_info' => $request->out_info
                ]);
        return redirect('/outcome')->with('status', 'Data sudah berhasil di Ubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outcome $outcome)
    {
        Outcome::destroy($outcome->id);
        return redirect('/outcome')->with('status', 'Data sudah berhasil dihapus!');
    }
}
