<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Author extends Model
{
    public function authorAll() {
        return $this->hasMany(Book::class,'author_id', 'id');
    }

    use Sortable;
    protected $table="authors";

    protected $fillable = ["name", "surname"];

    public $sortable = ["id", "name", "surname"];
}
