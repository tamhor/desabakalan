<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class CategoriesController extends Controller{

    public function index(){

        $category = DB::table('categories')->get();
        // dd($outcome->name);
        return view('category.category', compact('category'));
    }
    
    public function create(){
        //
    }

    public function store(Request $request){
        $request->validate([
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
        $source = DB::table('sources')->get();
        $category = DB::table('categories')->get();

        return view('category.show', compact('data', 'title', 'source', 'category', 'disabled'));
    }

    public function edit(Category $category){
        //
    }

    public function update(Request $request, Category $category){
        //
    }

    public function destroy(Category $category){
        //
    }

}
