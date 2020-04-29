<?php

namespace App\Http\Requests;

use App\Rules\FileUniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateDirectoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ["required", "string", new FileUniqueRule($this->name)]
        ];
    }


    protected function prepareForValidation()
    {
        $temp = $this->request->get('name');
        $temp = str_replace("/", "", $temp);
        $temp = str_replace(".", "", $temp);
        $this->merge([
            'name' => $temp
        ]);
    }
}
