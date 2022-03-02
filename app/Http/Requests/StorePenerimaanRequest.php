<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenerimaanRequest extends FormRequest
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
            'id_user' => 'required',
            'id_purchase' => 'required',
            'no_penerimaan_barang' => 'required',
            'tanggal_penerimaan' => 'required',
            'harga_beli' => 'required',
            'total' => 'required',
            'qty_received' => 'required',
        ];
    }

    public function messages()
    {
     
        return [
            'id_user.required' => 'The id user field is required.',
            'id_purchase.required' => 'The purchase field is required.',
            'no_penerimaan_barang.required' => 'The nomor penerimaan barang field is required.',
            'tanggal_penerimaan.required' => 'The tanggal penerimaan field is required.',
            'harga_satuan.required' => 'The harga satuan field is required.',
            'total.required' => 'The persentase field is required.',
            'qty_received.required' => 'The qty received field is required.',
        ];
    }
}
