<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserCreatedRequest extends FormRequest
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
        $rules = User::VALIDATION_RULES;
        if ($this->getMethod() == "POST") {
            // add validation
            // $rules += ['password' => 'required'];
        } else {
            $rules['dni'][3] = 'unique:users,dni,' . $this->route('user')->id;
            $rules['email'][3] = 'unique:users,email,' . $this->route('user')->id;
        }

        return $rules;
    }
}
