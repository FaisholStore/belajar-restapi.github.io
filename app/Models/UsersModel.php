<?php 
namespace App\Models;


class UsersModel extends \CodeIgniter\Model
{
    protected $table = 'barang';
    protected $primaryKey = 'kode';
    protected $allowedFields = [
        'kode', 'nama', 'jenis', 'harga', 'stok'
    ];
    protected $returnType = 'App\Entities\Users';
    protected $useTimestamps = false;

    public function findById($id)
    {
        return $this->find($id);
    }
}
?>