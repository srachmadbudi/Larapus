<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Author;
// use DataTables;
use Session; 
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('authors.index');
    // }
    public function index(Request $request, Builder $htmlBuilder)
    {
        // if ($request->ajax()) {
        //     $authors = Author::select(['id', 'name']);
        //     return Datatables::of($authors)->make(true);
        // }

        // $authors = Author::all();
        // // return view('authors.index', ['authors'=> $authors]);
        // return view('authors.index', compact('authors'));
        
        if($request->ajax())
        {
            $authors = Author::select(['id', 'name']);
            // return Datatables::of($authors)->make(true);
            return Datatables::of($authors)
                    ->addColumn('action', function($author){
                        return view('datatable._action', [
                            'model' => $author,
                            'form_url' => route('authors.destroy', $author->id),
                            'edit_url' => route('authors.edit', $author->id),
                            'confirm_message' => 'Yakin mau menghapus ' . $author->name . '?',
                        ]);
                    })
                    ->make(true);
        }
        
        $html= $htmlBuilder
        ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

        return view('authors.index',compact('html'));



        // if ($request->ajax()) 
        // {
        //     $authors = Author::query()->select(['id', 'name']);
        //     return DataTables::of($authors)->make(true);
        // }

        // $builder = Author::query();
        // dd($builder);
        // dd('masuk bang');
        // $html = $this->htmlBuilder->addColumn([
        //     'data' => 'name', 
        //     'name' =>'name', 
        //     'title'=>'Nama'
        // ], $order = false);

        // // dd($html);
        // return view('authors.index')->with(compact('html'));
    }

    // public function cari(Request $request)
	// {
	// 	// menangkap data pencarian
	// 	$cari = $request->cari;
 
    // 	// mengambil data dari table authors sesuai pencarian data
	// 	$authors = Author::where('authors_name','like',"%".$cari."%")
	// 	->paginate();
 
    // 	// mengirim data authors ke view index
	// 	return view('index',['authors' => $authors]);
 
    // }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:authors']); 
        $author = Author::create($request->only('name'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $author->name"
        ]);
        return redirect()->route('authors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return $author;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::find($id);
        return view('authors.edit')->with(compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required|unique:authors,name,'. $id]);
        $author = Author::find($id);
        $author->update($request->only('name'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $author->name" ]);
        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Author::destroy($id);
        if(!Author::destroy($id)) return redirect()->back();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Penulis berhasil dihapus"
            ]);
        return redirect()->route('authors.index');
    }

}
