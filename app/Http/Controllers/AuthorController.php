<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use PDF;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Author $author, Request $request)
    {

        $authors = Author::all();
        $author_id = $request->author_id;
        $authors_filter = $authors;


        $sort = $request->sort;
        $direction = $request->direction;

        if($author_id) {
            if($author_id == "all") {
                $authors = Author::sortable()->paginate(10);
                //Apacioje pavaizduota, jeigu reikia prijungti ir sortinima su selectais.
                // $sortedResult = $books->getCollection()->sortBy('id')->values();
                // $books->setCollection($sortedResult);
            }
            else {
            $authors = Author::query()->where("id", $author_id)->sortable()->paginate(10);
            }
        }
            else {
                $authors = Author::sortable()->paginate(10);

            }



        return view('author.index', ['authors'=>$authors, 'sort' => $sort, 'direction' => $direction, "author_id"=> $author_id, 'authors_filter' => $authors_filter]);

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

    public function generateAuthor(Author $author)
    {
        view()->share('author', $author);

        $pdf = PDF::loadView("pdf_author_template", $author);
        return $pdf->download("author".$author->id.".pdf");

    }

    public function generatePDF(Request $request)
    {

        // $authors = Author::all(); //visi autoriai
        $sortby=$request->sort;
        $collumnName = $request->direction;


        if(empty($collumnName) && empty($sortby)) {
            $sortby = 'id';
            $collumnName = 'asc';

        }



        $authors = Author::orderBy($sortby, $collumnName)->get();

        // return $authors;


        // $authors = Author::orderBy() ->where;

        view()->share(['authors'=> $authors]);

        // view()->share('tasks_count', $tasks_count);


        $pdf = PDF::loadView("pdf_authors_template", $authors);
        return $pdf->download("authors.pdf");

        // return $sortby." ".$collumnName;

    }





}
