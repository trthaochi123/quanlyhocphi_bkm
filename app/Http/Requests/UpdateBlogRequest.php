<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title_blog' => ['required'],
            'description_blog' => ['required'],
            'content_blog' => ['required'],
            'image' => ['nullable'],
            'posting_date_time' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'title_blog.required' => 'Tên tiêu đề không thể để trống',
            'description_blog.required' => 'Trường mô tả không thể để trống',
            'content_blog.required' => 'Trường nội dung không thể để trống',
            'image.nullable' => 'Trường hình ảnh không thể để trống',
            'posting_date_time.required' => 'Bạn chưa chọn ngày đăng',
        ];
    }
}
