<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class CategoriesController extends Controller{

    public function index(){

        $source = DB::table('sources')->get();
        $category = Category::with('source')->get();
        // dd($outcome->name);
        return view('category.category', compact('category', 'source'));
    }
    
    public function create(){
        //
    }

    public function store(Request $request){
        $request->validate([
            'source_id' => 'required',
            'name' => 'required',
            'balance' => 'required'
            ]);
        $data = $request->all();
        $data['balance'] = intval(preg_replace('/,.*|[^0-9]/', '', $request->balance));
        Category::create($data);

        return redirect('/category')->with('status', 'Kegiatan baru sudah berhasil ditambahkan!');
    }

    public function show(Category $category, $id){
        
        $data = DB::table('categories')
                ->join('outcomes', 'categories.id', '=', 'outcomes.out_category')
                ->where('out_category', $id)
                ->get();
        // dd($data);
        $title = DB::table('categories')->where('id', $id)->value('name');
        $disabled = DB::table('categories')->where('id', $id)->value('id');
        $source = DB::table('categories')->where('id', $id)->value('source_id');
        $category = DB::table('categories')->get();
        $income = DB::table('incomes')->get();
        $outcome = DB::table('outcomes')->get();
        $balance = DB::table('categories')->where('id', $id)->value('balance')-$outcome->sum('out_balance');
        // dd($source);
        return view('category.show', compact('data','source', 'title', 'category', 'disabled','income','outcome', 'balance'));
    }

    public function edit(Category $category){
        $source = DB::table('sources')->get();

        return view('category.edit', compact('source','category'));
    }

    public function update(Request $request, Category $category){
        $request->validate([
            'source_id' => 'required',
            'name' => 'required',
            'balance' => 'required',
        ]);
        $data = $request->all();
        $data['balance'] = intval(preg_replace('/,.*|[^0-9]/', '', $request->balance));
        Category::where('id', $category->id)
                ->update([
                    'source_id' => $request->source_id,
                    'name' => $request->name,
                    'balance' => $data['balance'],
                ]);

        return redirect('/category')->with('status', 'Data pengeluaran sudah berhasil di Ubah!');

    }

    public function destroy(Category $category){
        $delete = Category::destroy($category->id);
        $delete = DB::table('outcomes')->where('out_category', $category->id)->delete();

        return redirect('/category')->with('status', 'Data Kegiatan sudah berhasil di hapus!');
    }
}
