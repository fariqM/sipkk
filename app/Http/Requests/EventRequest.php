<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{

    protected function prepareForValidation()
    {   
        $this->merge([
            'balance' => str_replace(array("Rp ", ",", "Rp"), "", $this->balance),
        ]);
        
    }
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
            'user_id' => 'required',
            'event_id' => 'required',
            'balance' => 'required',
            'date' => 'required',
        ];
    }
}
