<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ORM
        // lay du lieu tu DB ve
        $blogs = Blog::all();
        return view('blogs.index', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ten thu muc.tenview de hien thi giao dien
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $image_name = $request->file('image')->getClientOriginalName();
        if (!Storage::exists('public/Admin/' . $image_name)) {
            Storage::putFileAs('public/Admin/', $request->file('image'), $image_name);
        }
        $array = [];
        $array = Arr::add($array, 'title_blog', $request->title_blog);
        $array = Arr::add($array, 'description_blog', $request->description_blog);
        $array = Arr::add($array, 'content_blog', $request->content_blog);
        $array = Arr::add($array, 'posting_date_time', $request->posting_date_time);
        $array = Arr::add($array, 'image', $image_name);
        // luu len db
        Blog::create($array);
        session()->flash('success', 'Đã tạo thành công!');
        return Redirect::route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog, Request $request)
    {
        return view('blogs.edit', [
            'blog' => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if ($request->validated()) {
            if ($request->file('image') !== null) {
                $image_name = $request->file('image')->getClientOriginalName();
            } else {
                $image_name = $blog->image;
            }

            //kiem tra neu file da ton tai, neu file chua ton tai thi luu vao folder
            if (!Storage::exists('public/Admin/' . $image_name)) {
                Storage::putFileAs('public/Admin/', $request->file('image'), $image_name);
            }
            // lay DL trong form va luu len DB
            $array = [];
            $array = Arr::add($array, 'title_blog', $request->title_blog);
            $array = Arr::add($array, 'description_blog', $request->description_blog);
            $array = Arr::add($array, 'content_blog', $request->content_blog);
            $array = Arr::add($array, 'posting_date_time', $request->posting_date_time);
            $array = Arr::add($array, 'image', $image_name);
            $blog->update($array);
            session()->flash('success', 'Cập nhật thành công!');
            return Redirect::route('blogs.index');
        } else {
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog, Request $request)
    {

        $blog->delete();
        session()->flash('success', 'Đã xoá thành công!');
        return Redirect::route('blogs.index');
    }

    public function showBlog($id)
    {
        $blog = Blog::find($id); // Lấy blog dựa trên ID
        return view('blogs.show', [
            'blog' => $blog,
            'id' => $id
        ]);
    }
}
