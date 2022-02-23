<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKategoriBarangRequest extends FormRequest
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
            'kode_barang' => 'required|unique:barangs',
            'nama_barang' => 'required',
            'description' => 'required',
            'jenis' => 'required',
            'type' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'kode_barang.required' => 'The kode produk field is required.',
            'nama_barang.required' => 'The nama_barang field is required.',
            'description.required' => 'The description field is required.',
            'jenis.required' => 'The jenis field is required.',
            'type.required' => 'The type field is required.',
            'kode_barang.unique' => 'The kode produk has already been taken.'
        ];
    }
}
