<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    public $timestamps = false;
    protected $fillable = [
        'title_blog',
        'description_blog',
        'content_blog',
        'posting_date_time',
        'image'
    ];

    // function de lay du lieu tu DB ve, hứng vào 1 biến $blogs
    // public function index()
    // {
    //     $blogs = DB::table('blogs')
    //         ->get();
    //     // tra ve DL lay duoc
    //     return $blogs;
    // }




    // public function store()
    // {
    //     DB::table('blogs')
    //         ->insert([
    //             'title_blog' => $this->title_blog,
    //             'description_blog' => $this->description_blog,
    //             'content_blog' => $this->content_blog,
    //             'posting_date_time' => $this->posting_date_time,
    //             'image' => $this->image, // Bổ sung thêm ảnh vào cơ sở dữ liệu
    //         ]);
    // }

    // function luu DL duoc them len DB
    // public function store()
    // {
    //     DB::table('blogs')
    //         ->insert([
    //             'title_blog' => $this->title_blog,
    //             'description_blog' => $this->description_blog,
    //             'content_blog' => $this->content_blog,
    //             'posting_date_time' => $this->posting_date_time,
    //         ]);
    // }

    // lay DL theo id
    public function edit(){
        $blogs = DB::table('blogs')
            ->where('id', $this->id)
            ->get();
        // tra ve DL lay duoc
        return $blogs;
    }

    public function updateBlog(){
        DB::table('blogs')
            ->where('id', $this->id)
            ->update([
                'title_blog' => $this->title_blog,
                'description_blog' => $this->description_blog,
                'content_blog' => $this->content_blog,
                'posting_date_time' => $this->posting_date_time,
                'image' => $this->image
            ]);
    }

    public function deleteBlog() {
        DB::table('blogs')
            ->where('id', $this->id)
            ->delete();
    }
}
