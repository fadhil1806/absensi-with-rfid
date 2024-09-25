<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IzinRequest extends FormRequest
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
            'tendik_id'      => 'nullable',
            'siswa_id'       => 'nullable',
            'jenis_izin'     => 'required',
            'tanggal'        => 'required',
            'jam_mulai'      => 'nullable',
            'jam_berakhir'   => 'nullable',
            'keterangan'     => 'required',
            'foto'           => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'jenis_izin.required' => 'Jenis izin harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
            'foto.required'       => 'Foto harus diisi'
        ];
    }
}
