<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Bilah :attribute harus diterima.',
    'active_url' => 'Bilah :attribute berisi URL yang tidak sah.',
    'after' => 'Bilah :attribute harus berupa tanggal setelah :date.',
    'after_or_equal' => 'Bilah :attribute harus berupa tanggal mulai :date atau setelahnya.',
    'alpha' => 'Bilah :attribute hanya boleh diisi huruf.',
    'alpha_dash' => 'Bilah :attribute hanya boleh diisi huruf, angka, tanda hubung dan garis bawah.',
    'alpha_num' => 'Bilah :attribute hanya boleh diisi huruf dan angka.',
    'array' => 'Bilah :attribute harus berupa array.',
    'before' => 'Bilah :attribute harus berupa tanggal sebelum :date.',
    'before_or_equal' => 'Bilah :attribute harus berupa tanggal mulai :date atau setelahnya.',
    'between' => [
        'numeric' => 'Bilah :attribute harus angka antara :min sampai :max.',
        'file' => 'Bilah :attribute harus diisi angka antara :min sampai :max kilobytes.',
        'string' => 'Bilah :attribute harus diisi :min sampai :max karakter.',
        'array' => 'Bilah :attribute diisi antara :min sampai :max buah data.',
    ],
    'boolean' => 'Bilah :attribute berisi true atau false.',
    'confirmed' => 'Bilah :attribute konfirmasinya tidak cocok.',
    'date' => 'Bilah :attribute berisi tanggal yang tidak sah.',
    'date_equals' => 'Bilah :attribute harus berupa tanggal yang setara dengan :date.',
    'date_format' => 'Bilah :attribute tidak cocok dengan format :format.',
    'different' => 'Bilah :attribute dan :other harus diisi berbeda.',
    'digits' => 'Bilah :attribute harus diisi :digits digit.',
    'digits_between' => 'Bilah :attribute harus diisi angka antara :min sampai :max digit.',
    'dimensions' => 'Bilah :attribute berisi dimensi gambar yang tidak sah.',
    'distinct' => 'Bilah :attribute memiliki nilai ganda.',
    'email' => 'Bilah :attribute harus diisi alamat email yang sah.',
    'exists' => 'Bilah :attribute yang anda pilih tidak sah.',
    'file' => 'Bilah :attribute harus berupa file.',
    'filled' => 'Bilah :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => 'Bilah :attribute harus diisi angka yang lebih besar dari :value.',
        'file' => 'Bilah :attribute harus diisi angka yang lebih besar dari :value kilobytes.',
        'string' => 'Bilah :attribute minimal diisi :value character.',
        'array' => 'Bilah :attribute harus diisi lebih dari :value data.',
    ],
    'gte' => [
        'numeric' => 'Bilah :attribute harus diisi amgka yang lebih besar atau sama dengan :value.',
        'file' => 'Bilah :attribute harus diisi amgka yang lebih besar atau sama dengan :value kilobytes.',
        'string' => 'Bilah :attribute harus diisi amgka yang lebih besar atau sama dengan :value karakter.',
        'array' => 'Bilah :attribute harus diisi minimal :value data.',
    ],
    'image' => 'Bilah :attribute harus berupa an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'Bilah :attribute field does not exist in :other.',
    'integer' => 'Bilah :attribute harus berupa an integer.',
    'ip' => 'Bilah :attribute harus berupa a valid IP address.',
    'ipv4' => 'Bilah :attribute harus berupa alamat IPv4 yang sah.',
    'ipv6' => 'Bilah :attribute harus berupa alamat IPv6 yang sah.',
    'json' => 'Bilah :attribute harus berupa string JSON yang sah.',
    'lt' => [
        'numeric' => 'Bilah :attribute harus kurang dari :value.',
        'file' => 'Bilah :attribute harus kurang dari :value kilobytes.',
        'string' => 'Bilah :attribute harus kurang dari :value karakter.',
        'array' => 'Bilah :attribute harus diisi maksimal :value data.',
    ],
    'lte' => [
        'numeric' => 'Bilah :attribute harus kurang dari atau sama dengan :value.',
        'file' => 'Bilah :attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string' => 'Bilah :attribute harus kurang dari atau sama dengan :value karakter.',
        'array' => 'Bilah :attribute tidak boleh lebih dari :value data.',
    ],
    'max' => [
        'numeric' => 'Bilah :attribute tidak boleh lebih dari :max.',
        'file' => 'Bilah :attribute tidak boleh lebih dari :max kilobytes.',
        'string' => 'Bilah :attribute tidak boleh lebih dari :max karakter.',
        'array' => 'Bilah :attribute tidak boleh lebih dari :max data.',
    ],
    'mimes' => 'Bilah :attribute harus berupa file dengan tipe: :values.',
    'mimetypes' => 'Bilah :attribute harus berupa file dengan tipe: :values.',
    'min' => [
        'numeric' => 'Bilah :attribute harus diisi minimal :min.',
        'file' => 'Bilah :attribute harus diisi minimal :min kilobytes.',
        'string' => 'Bilah :attribute harus diisi minimal :min karakter.',
        'array' => 'Bilah :attribute  harus diisi minimal :min data.',
    ],
    'not_in' => 'Bilah :attribute yang anda pilih tidak sah.',
    'not_regex' => 'Bilah :attribute formatnya tidak sah.',
    'numeric' => 'Bilah :attribute harus berupa angka.',
    'present' => 'Bilah :attribute harus ada.',
    'regex' => 'Bilah :attribute formatnya tidak valid.',
    'required' => 'Bilah :attribute wajib diisi.',
    'required_if' => 'Bilah :attribute wajib diisi ketika :other diisi :value.',
    'required_unless' => 'Bilah :attribute wajib diisi hanya jika :other diisi :values.',
    'required_with' => 'Bilah :attribute wajib diisi ketika terdapat :values',
    'required_with_all' => 'Bilah :attribute wajib diisi ketika terdapat :values',
    'required_without' => 'Bilah :attribute wajib diisi ketika tidak terdapat :values',
    'required_without_all' => 'Bilah :attribute wajib diisi ketika tidak terdapat satupun :values',
    'same' => 'Bilah :attribute isinya harus sama dengan bilah :other',
    'size' => [
        'numeric' => 'Bilah :attribute harus berukuran :size.',
        'file' => 'Bilah :attribute harus berukuran :size kilobytes.',
        'string' => 'Bilah :attribute harus berukuran :size karakter.',
        'array' => 'Bilah :attribute harus mengandung :size data.',
    ],
    'starts_with' => 'Bilah :attribute harus diawali dengan salah satu dari: :values',
    'string' => 'Bilah :attribute harus berupa string.',
    'timezone' => 'Bilah :attribute harus berupa zona waktu yang sah.',
    'unique' => 'Bilah :attribute telah terpakai.',
    'uploaded' => 'Bilah :attribute gagal untuk diupload.',
    'url' => 'Bilah :attribute memiliki format yang tidak sah.',
    'uuid' => 'Bilah :attribute harus berupa UUID yang sah.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
