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
        $category = Outcome::with('category')->get();
        $income = DB::table('incomes')->get();
        // dd($category);
        return view('outcome.outcome', compact('category','income'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->limit(2)->get();
        // dd($categories);
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
            
        $data = $request->all();
        $data['out_balance'] = intval(preg_replace('/,.*|[^0-9]/', '', $request->out_balance));

        // $balance = DB::table('outcomes')->sum($data);
        
        // dd($request->sum['out_balance']);

        Outcome::create($data);
        return redirect('/outcome')->with('status', 'Data sudah pengeluaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function show(Outcome $outcome)
    {
        // $outcome = Outcome::find($id);
        // return view('outcome',compact('outcome'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function edit(Outcome $outcome)
    {
        $categories = DB::table('categories')->limit(2)->get();

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

        $data = $request->all();
        $data['out_balance'] = intval(preg_replace('/,.*|[^0-9]/', '', $request->out_balance));
        
        Outcome::where('id', $outcome->id)
                ->update([
                    'out_category' => $request->out_category,
                    'out_description' => $request->out_description,
                    'out_balance' => $data['out_balance'],
                    'out_info' => $request->out_info
                ]);
        return redirect('/outcome')->with('status', 'Data pengeluaran sudah berhasil di Ubah!');
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
        // dd($outcome->id);
        return redirect('/outcome')->with('status', 'Data sudah berhasil dihapus!');
    }

}
