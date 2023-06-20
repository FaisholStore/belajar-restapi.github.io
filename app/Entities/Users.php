<?php

namespace App\Entities;

class Users extends \CodeIgniter\Entity\Entity
{
    protected $attributes = [
        'kode' => null,
        'nama' => null,
        'jenis' => null,
        'harga' => null,
        'stok' => null
    ];

    public function setHarga(float $harga)
    {
        $this->attributes['harga'] = $harga;
        return $this;
    }

    public function setStok(int $stok)
    {
        $this->attributes['stok'] = $stok;
        return $this;
    }
}
