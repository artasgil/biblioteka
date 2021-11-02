<?php

namespace App\Http\Controllers;

use App\Book;
use App\Author;
use Illuminate\Http\Request;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Book $book)
    {
        $books = Book::all();
        $books_filter = $books;
        $authors = Author::all();
        $author_id = $request->author_id;
        $book_id = $request->book_id;

        //FILTRAVIMAS
        if($author_id) {
                if($author_id == "all") {
                    $books = Book::sortable()->paginate(10);

                    //Apacioje pavaizduota, jeigu reikia prijungti ir sortinima su selectais.
                    // $sortedResult = $books->getCollection()->sortBy('id')->values();
                    // $books->setCollection($sortedResult);
                }
                else {
                $books = Book::query()->where("author_id", $author_id)->sortable()->paginate(10);
                }

                }
                else if($book_id) {
                    if($book_id == "all") {
                        $books = Book::sortable()->paginate(10);
                        //Apacioje pavaizduota, jeigu reikia prijungti ir sortinima su selectais.
                    // $sortedResult = $books->getCollection()->sortBy('id')->values();
                    // $books->setCollection($sortedResult);
                }
                else {
                $books = Book::query()->where("id", $book_id)->sortable()->paginate(10);
                }
                    } else {

                        $books = Book::sortable()->paginate(10);

                        // $books = Book::orderBy('id', 'desc')->paginate(10);
                        //Apacioje pavaizduota, jeigu reikia prijungti ir sortinima su selectais.
                        // $sortedResult = $books->getCollection()->sortBy('id')->values();
                        // $books->setCollection($sortedResult);
                }


    // $books = Book::sortable()->paginate(10);
    return view("book.index", ["book" => $book, "books" => $books, "authors" =>$authors, "author_id"=> $author_id, "book_id"=> $book_id, "booksFilter" => $books_filter]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();


        return view("book.create", ["authors" => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authors = Author::all();
        $authors_count = $authors->count();


        $book = new Book;


        $validateVar = $request->validate([
            'book_title' => 'required|regex:/^[\pL\s]+$/u|unique:books,title|min:6|max:225',
            'book_about' => 'required|max:1500',
            'book_isbn' => 'required|numeric',
            'book_author' => 'required|numeric|gt:0|lte:'.$authors_count,
            'book_pages' => 'required|numeric|gt:0'

        ]);

        $book->title = $request->book_title;
        $book->about = $request->book_about;
        $book->author_id = $request->book_author;
        $book->pages = $request->book_pages;
        $book->isbn = $request->book_isbn;


        $book->save();
        return redirect()->route("book.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', ["book"=>$book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();



        return view("book.edit", ["authors" => $authors, "book"=>$book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $authors = Author::all();
        $authors_count = $authors->count();

        $validateVar = $request->validate([
            'book_title' => 'required|regex:/^[\pL\s]+$/u|min:6|max:225',
            'book_about' => 'required|max:1500',
            'book_isbn' => 'required|numeric',
            'book_author' => 'required|numeric|gt:0|lte:'.$authors_count,
            'book_pages' => 'required|numeric|gt:0'

        ]);

        $book->title = $request->book_title;
        $book->about = $request->book_about;
        $book->author_id = $request->book_author;
        $book->pages = $request->book_pages;
        $book->isbn = $request->book_isbn;


        $book->save();
        return redirect()->route("book.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route("book.index")->with('sucess_message','Book deleted');
    }
}
