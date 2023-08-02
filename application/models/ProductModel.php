<?php

class ProductModel extends CI_Model {

    public function insertProduct($data) {
        return $this->db->insert('products', $data);
    }

    public function selectAllproduct() {
        $query = $this->db->select('categories.title as tendanhmc,products.*,brands.title as tenthuonghieu')
        ->from('categories')
        ->join('products','products.category_id=categories.id')
        ->join('brands','brands.id=products.brand_id')
        ->get();
        return $query->result();
    }
/*
    public function selectCategoryById($id) {
        $query = $this->db->where('id', $id)->get('categories');
        return $query->row();
    }

    
    public function updateCategory($id, $data) {
        return $this->db->update('categories', $data, ['id' => $id]);
    }


    public function deleteCategory($id) {
        return $this->db->delete('categories', ['id' => $id]);
    }*/
}
?>