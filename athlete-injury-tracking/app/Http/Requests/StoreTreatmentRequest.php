<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Carbon\Carbon;

class StoreTreatmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // Assuming all users can make this request. You can change this based on authentication.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'injury_id' => 'required|exists:injuries,id',  
            'treatment_type' => 'required|string|max:255',
            'treatment_date' => 'required|date|before_or_equal:today',  
            'notes' => 'nullable|string',
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'injury_id.required' => 'მოეთხოვება ტრავმის ID.',
            'injury_id.exists' => 'მოცემული ტრავმის ID არ არსებობს.',
            'treatment_type.required' => 'მოეთხოვება მკურნალობის ტიპი.',
            'treatment_type.string' => 'მკურნალობის ტიპი უნდა იყოს ტექსტი.',
            'treatment_type.max' => 'მკურნალობის ტიპი არ უნდა აღემატებოდეს 255 სიმბოლოს.',
            'treatment_date.required' => 'მოეთხოვება მკურნალობის თარიღი.',
            'treatment_date.date' => 'მკურნალობის თარიღი არ არის ვალიდური თარიღი.',
            'treatment_date.before_or_equal' => 'მკურნალობის თარიღი არ უნდა იყოს მომავალი.',
            'notes.string' => 'შენიშვნა უნდა იყოს ტექსტი.',
        ];
    }

    /**
     * Get the error messages to be shown.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     */
    protected function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }

    /**
     * Prepare data for validation.
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $this->merge([
            'treatment_date' => Carbon::parse($this->treatment_date)->format('Y-m-d'),
        ]);
    }
}
