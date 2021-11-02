<?php

namespace App;
use App\author;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Book extends Model
{
    public function bookAuthor() {
        return $this->belongsTo(Author::class,'author_id', 'id');
    }
    use Sortable;
    protected $table="books";

    protected $fillable = ["title", "isbn", "pages", "about", "author_id"];

    public $sortable = ["id", "title", "isbn", "pages", "about", "author_id" ];



}
