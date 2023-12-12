<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesMarketingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sales_marketing';
    protected $primaryKey       = 'id_sales';
    protected $allowedFields    = ['id_sales', 'nama_sales', 'alamat_sales', 'umur_sales', 'daerah_operasi'];


    public function getSalesMarketing($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_Sales' => $id]);
        }
    }


    public function hapusSalesMarketing($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_sales' => $id]);
    }

    public function countSales()
    {
        return $this->table('sales_marketing')
            ->selectcount('id_sales')
            ->get()->getRow();
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('sales_marketing')->like('nama_sales', $keyword)->orLike('alamat_sales', $keyword);
    }
}
