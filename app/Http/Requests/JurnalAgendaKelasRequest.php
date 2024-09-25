<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JurnalAgendaKelasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tendik_id'    => 'required',
            'mapel'        => 'required',
            'tanggal'      => 'required',
            'jam_mulai'    => 'required',
            'jam_berakhir' => 'required',
            'kelas'        => 'required',
            'materi'       => 'required',
            'keterangan'   => 'required'
        ];
    }
}
