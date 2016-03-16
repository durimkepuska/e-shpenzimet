<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ZotimetRequest extends Request
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
        'description'=>'required',
        'paid_value'=>'required',
        'expenditure_date'=>'required',

      ];
    }
}
