<?php

namespace App\Http\Requests;

use App\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->user_type == UserType::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:2|max:30',
            'description' => 'required',
            'assigned_to_id' => [
                'required',
                Rule::exists('users', 'id')
                    ->where('user_type', UserType::USER)
            ],
            'assigned_by_id' => [
                'required',
                Rule::exists('users', 'id')
                    ->where('user_type', UserType::ADMIN)
            ],
        ];
    }
}
