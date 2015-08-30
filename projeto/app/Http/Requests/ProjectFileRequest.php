<?php

namespace project\Http\Requests;

use project\Http\Requests\Request;

class ProjectFileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required',
            'description' => 'required',
            'file'        => 'required',
            'project_id'  => 'required|integer'
        ];
    }
}
