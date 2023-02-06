<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('edit-users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user = $this->route('user');

        return [
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'is_active' => 'required',
            'role_id' => 'required|exists:Spatie\Permission\Models\Role,id',
        ];
    }
}
