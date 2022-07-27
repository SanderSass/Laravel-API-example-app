<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFreedomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'year' => ['required'],
            'iso_code' => ['required'],
            'country' => ['required'],
            'personal_freedom_score' => ['required'],
            'economic_freedom_score' => ['required'],
            'human_freedom_score' => ['required'],
            'human_freedom_rank' => ['required'],
            'human_freedom_quartile' => ['required']
        ];
    }
}
