<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest
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
            'type' => 'required|in:free,paid',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'advertiser_id' => 'required|exists:advertisers,id',
            'start_date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Type field is required',
            'type.in' => 'Type must be free or paid',
            'title.required' => 'Title field is required',
            'title.string' => 'Title must be string',
            'title.max' => 'Title must be no more than 255 characters',
            'category_id.required' => 'Category field is required',
            'category_id.exists' => 'Invalid category id',
            'tags.required' => 'Tags field is required',
            'tags.array' => 'Tags must be an array',
            'tags.*.exists' => 'Invalid tag id',
            'advertiser_id.required' => 'Advertiser field is required',
            'advertiser_id.exists' => 'Invalid advertiser id',
            'start_date.required' => 'Start date field is required',
            'start_date.date' => 'Start date must be a valid date'
            ];
            }
}
