<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TendikRequest extends FormRequest
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
            'nik'            => 'required|regex:/^[0-9.]+$/',
            'nama'           => 'required',
            'jenis_kelamin'  => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'role'           => 'required',
            'jam_masuk'      => 'required',
            'jam_pulang'     => 'required',
            'nomor_whatsapp' => 'required',
            'foto'           => 'required|image|mimes:jpg,png,jpeg',
        ];
    }
}
