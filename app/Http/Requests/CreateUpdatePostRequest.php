<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdatePostRequest extends FormRequest
{
    public string $title;
    public ?string $slug;
    public ?string $published_at;

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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:500',
            'slug' => 'nullable|string|regex:/^[a-z0-9-]+$/i',
            'published_at' => 'nullable|date',
        ];
    }

    public function validated(): self
    {
        $params = parent::validated();
        $this->title = $params['title'];
        $this->slug = $params['slug'];
        $this->published_at = $params['published_at'];

        return $this;
    }
}
