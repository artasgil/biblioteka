<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Author $author)
    {

        $authors = Author::sortable()->paginate(10);

        // $authorss = Author::select(['id'])->withCount('books.author_id')->get();

        // $data = DB::table('books')->join('authors', )

        return view('author.index', ['authors'=>$authors]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("author.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = new Author();


        $validateVar = $request->validate([
            'author_name' => 'required|regex:/^[\pL\s]+$/u|unique:authors,name|min:6|max:225',
            'author_surname' => 'required|regex:/^[\pL\s]+$/u|unique:authors,name|min:6|max:225',

        ]);

        $author->name = $request->author_name;
        $author->surname = $request->author_surname;


        $author->save();
        return redirect()->route("author.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view('author.show', ['author'=>$author]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.edit', ['author'=>$author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $validateVar = $request->validate([
            'author_name' => 'required|regex:/^[\pL\s]+$/u|min:3|max:225',
            'author_surname' => 'required|regex:/^[\pL\s]+$/u|min:3|max:225',

        ]);

        $author->name = $request->author_name;
        $author->surname = $request->author_surname;


        $author->save();
        return redirect()->route("author.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $authors_count = $author->authorAll->count();
        if($authors_count!==0) {
            return redirect()->route("author.index")->with('error_message','Author can not be deleted, because has books');
        }
        $author->delete();
        return redirect()->route("author.index")->with('sucess_message','Author deleted successfully');
    }
}
