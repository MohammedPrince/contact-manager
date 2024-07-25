<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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

        if ($this->isMethod('post') && $this->routeIs('AddContact')) {
            return [
                'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:100|min:4|unique:contacts',
                'phone' => 'required|regex:/^\d+$/|max:13|min:10|unique:contacts',
            ];
        } elseif ($this->isMethod('post') && $this->routeIs('UpdateContact')) {
            return [
                'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:100|min:4',
                'phone' => 'required|regex:/^\d+$/|max:13|min:10',
            ];
        } else {
            return [
                'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:100|min:4|unique:contacts',
                'phone' => 'required|regex:/^\d+$/|max:13|min:10|unique:contacts',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Contact Name',
            'phone.required' => 'Please Enter Phone Number',
        ];
    }
}
