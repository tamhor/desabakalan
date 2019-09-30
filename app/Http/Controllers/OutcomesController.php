<?php

namespace App\Http\Controllers;

use App\Outcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class OutcomesController extends Controller{

    public function index($id){
        if (!empty($id)) {
            $income = DB::table('incomes')->where('in_category', $id)->get();
            $title = DB::table('sources')->where('id', $id)->value('source');
            $outcome = DB::table('outcomes')
                        ->join('sources', 'outcomes.source_id', '=', 'sources.id')
                        ->join('categories', 'outcomes.out_category', '=', 'categories.id')
                        ->select('outcomes.*', 'sources.source as source', 'categories.name as name')
                        ->where('outcomes.source_id', $id)
                        ->get();
        }else{
            $income = DB::table('incomes')->get();
            $title = "Data Pengeluaran";
            $outcome = DB::table('outcomes')
            ->join('sources', 'outcomes.source_id', '=', 'sources.id')
            ->join('categories', 'outcomes.out_category', '=', 'categories.id')
            ->select('outcomes.*', 'sources.source as source', 'categories.name as name')
            ->get();
        }
        // dd($outcome->name);
        return view('outcome.outcome', compact('outcome','income','title'));
    }
    
    public function create(){
        $source = DB::table('sources')->get();
        $category = DB::table('categories')->get();
        // dd($categories);
        return view('outcome.create', compact('source','category'));
    }

    public function store(Request $request){
        $request->validate([
            'source_id' => 'required',
            'out_category' => 'required',
            'out_description' => 'required',
            'out_balance' => 'required'
            ]);
        $data = $request->all();
        $data['out_balance'] = intval(preg_replace('/,.*|[^0-9]/', '', $request->out_balance));
        Outcome::create($data);

        return back()->with('status', 'Data sudah pengeluaran berhasil ditambahkan!');
    }

    public function show(Outcome $outcome){
        //
    }

    public function edit(Outcome $outcome){
        $source = DB::table('sources')->get();
        $category = DB::table('categories')->get();

        return view('outcome.edit', compact('outcome','source','category'));
    }

    public function update(Request $request, Outcome $outcome){
        $request->validate([
            'source_id' => 'required',
            'out_category' => 'required',
            'out_description' => 'required',
            'out_balance' => 'required'
        ]);
        $data = $request->all();
        $data['out_balance'] = intval(preg_replace('/,.*|[^0-9]/', '', $request->out_balance));
        Outcome::where('id', $outcome->id)
                ->update([
                    'source_id' => $request->source_id,
                    'out_category' => $request->out_category,
                    'out_description' => $request->out_description,
                    'out_balance' => $data['out_balance'],
                    'out_info' => $request->out_info
                ]);

        return redirect('/category/show/'.$request->out_category)->with('status', 'Data pengeluaran sudah berhasil di Ubah!');
    }

    public function destroy(Outcome $outcome){
        Outcome::destroy($outcome->id);

        return redirect('/category/show/'.$outcome->out_category)->with('status', 'Data sudah berhasil dihapus!');
    }

    public function report(){

        return view('outcome.report');
    }
}
