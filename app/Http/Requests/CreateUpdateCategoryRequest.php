<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateCategoryRequest extends FormRequest
{
    public string $name;
    public ?string $slug;

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
            'name' => 'required|string|max:200',
            'slug' => 'nullable|string|regex:/^[a-z0-9-]+$/i',
        ];
    }

    public function validated(): self
    {
        $params = parent::validated();
        $this->name = $params['name'];
        $this->slug = $params['slug'];

        return $this;
    }
}
