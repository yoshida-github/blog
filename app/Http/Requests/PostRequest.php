<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     * 
     * 入力されたタイトル（post.title）が、
     * 未入力ではないかつ、文字列であるかつ、100文字以下ならOKという条件。
     * 入力された本文（post.body）が未入力ではないかつ、文字列であるかつ、4000文字以下ならOKという条件。
     * ルールは左から評価され、エラーがあった段階で評価され、エラーがあった段階で返却される。
     */
    public function rules(): array
    {
        return [
            'post.title' => 'required | string | max:100',
            'post.body' => 'required | string | max:4000',
        ];
    }
}
