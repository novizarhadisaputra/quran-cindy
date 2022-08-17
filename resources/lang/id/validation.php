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

    'accepted'             => ':attribute harus diterima.',
    'active_url'           => ':attribute bukan URL yang valid.',
    'after'                => ':attribute harus tanggal setelah :date.',
    'after_or_equal'       => ':attribute harus tanggal setelah atau sama dengan :date.',
    'alpha'                => ':attribute hanya boleh berisi huruf.',
    'alpha_dash'           => ':attribute hanya boleh berisi huruf, angka, dan tanda hubung.',
    'alpha_num'            => ':attribute hanya boleh berisi huruf dan angka.',
    'array'                => ':attribute harus berupa array.',
    'before'               => ':attribute harus tanggal sebelum :date.',
    'before_or_equal'      => ':attribute harus tanggal sebelum atau sama dengan :date.',
    'between'              => [
        'numeric' => ':attribute harus antara :min dan :max.',
        'file'    => ':attribute harus antara :min dan :max kilobytes.',
        'string'  => ':attribute harus antara :min dan :max karakter.',
        'array'   => ':attribute harus antara :min dan :max item.',
    ],
    'boolean'              => ':attribute harus berupa nilai boolean: true atau false.',
    'confirmed'            => ':attribute konfirmasi tidak cocok.',
    'date'                 => ':attribute bukan tanggal yang valid.',
    'date_format'          => ':attribute tidak sesuai format :format.',
    'different'            => ':attribute dan :other harus berbeda.',
    'digits'               => ':attribute harus sebanyak :digits digit.',
    'digits_between'       => ':attribute harus antara :min and :max digit.',
    'dimensions'           => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct'             => ':attribute memiliki nilai duplikat.',
    'email'                => ':attribute harus alamat e-mail yang valid.',
    'exists'               => ':attribute yang dipilih tidak valid.',
    'file'                 => ':attribute harus berupa file.',
    'filled'               => ':attribute harus diisi.',
    'gt'                   => [
        'numeric' => ':attribute harus lebih besar dari :value.',
        'file'    => ':attribute harus lebih besar dari :value kilobytes.',
        'string'  => ':attribute harus lebih besar dari :value karakter.',
        'array'   => ':attribute harus memiliki lebih dari :value item.',
    ],
    'gte'                  => [
        'numeric' => ':attribute harus lebih besar dari atau sama dengan :value.',
        'file'    => ':attribute harus lebih besar dari atau sama dengan :value kilobytes.',
        'string'  => ':attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array'   => ':attribute harus memiliki :value item atau lebih.',
    ],
    'image'                => ':attribute harus berupa gambar.',
    'in'                   => ':attribute yang dipilih tidak valid.',
    'in_array'             => ':attribute tidak ada di :other.',
    'integer'              => ':attribute harus bilangan bulat / integer.',
    'ip'                   => ':attribute harus berupa alamat IP yang valid.',
    'ipv4'                 => ':attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'                 => ':attribute harus berupa alamat IPv6 yang valid.',
    'json'                 => ':attribute harus berupa string JSON yang valid.',
    'lt'                   => [
        'numeric' => ':attribute harus kurang dari :value.',
        'file'    => ':attribute harus kurang dari :value kilobytes.',
        'string'  => ':attribute harus kurang dari :value karakter.',
        'array'   => ':attribute harus memiliki kurang dari :value item.',
    ],
    'lte'                  => [
        'numeric' => ':attribute harus kurang dari atau sama dengan :value.',
        'file'    => ':attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string'  => ':attribute harus kurang dari atau sama dengan :value karakter.',
        'array'   => ':attribute tidak boleh lebih dari :value item.',
    ],
    'max'                  => [
        'numeric' => ':attribute tidak boleh lebih besar dari :max.',
        'file'    => ':attribute tidak boleh lebih besar dari :max kilobytes.',
        'string'  => ':attribute tidak boleh lebih besar dari :max karakter.',
        'array'   => ':attribute tidak boleh lebih besar dari :max item.',
    ],
    'mimes'                => ':attribute harus berupa file bertipe: :values.',
    'mimetypes'            => ':attribute harus berupa file bertipe: :values.',
    'min'                  => [
        'numeric' => ':attribute harus setidaknya :min.',
        'file'    => ':attribute harus setidaknya :min kilobytes.',
        'string'  => ':attribute harus setidaknya :min karakter.',
        'array'   => ':attribute harus memiliki setidaknya :min item.',
        'duration' => 'Durasi Paling tidak harus :min :unit dari waktu terakhir melakukan absen.'
    ],
    'not_in'               => ':attribute yang dipilih tidak valid.',
    'not_regex'            => ':attribute format tidak valid.',
    'numeric'              => ':attribute harus berupa angka.',
    'present'              => ':attribute harus ada.',
    'regex'                => ':attribute format tidak valid.',
    'required'             => 'Kolom :attribute wajib diisi.',
    'required_if'          => 'Kolom :attribute wajib diisi ketika :other adalah :value.',
    'required_unless'      => 'Kolom :attribute wajib diisi kecuali :other ada di :values.',
    'required_with'        => 'Kolom :attribute wajib diisi saat :values ada.',
    'required_with_all'    => 'Kolom :attribute wajib diisi saat :values ada.',
    'required_without'     => 'Kolom :attribute wajib diisi ketika :values tidak ada.',
    'required_without_all' => 'Kolom :attribute wajib diisi ketika tidak ada nilai :values yang ada.',
    'same'                 => 'Kolom :attribute dan :other harus sesuai.',
    'size'                 => [
        'numeric' => 'Kolom :attribute harus :size.',
        'file'    => 'Kolom :attribute harus :size kilobytes.',
        'string'  => 'Kolom :attribute harus :size karakter.',
        'array'   => 'Kolom :attribute harus memiliki :size item.',
    ],
    'string'               => 'Kolom :attribute harus berupa string.',
    'timezone'             => 'Kolom :attribute harus berupa zona yang valid.',
    'unique'               => 'Kolom :attribute sudah digunakan.',
    'uploaded'             => 'Kolom :attribute gagak mengunggah.',
    'url'                  => 'Kolom :attribute format tidak valid.',
    'authorization'        => 'Kolom :attribute tidak Memiliki Izin / Persetujuan Resmi',


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
        'password' => 'Username / password yang anda masukkan salah',
        'unverified_email' => 'Kami telah mengirimkan email dengan link konfirmasi ke alamat email Anda. Harap verifikasi alamat email Anda Untuk menyelesaikan proses pendaftaran.'
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
