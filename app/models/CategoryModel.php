<?php

require_once BASE_PATH . 'core/Model.php';

class CategoryModel extends Model
{
    // Ambil semua kategori
    public function getAllCategories()
    {
        $stmt = $this->db->query("SELECT * FROM categories ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil kategori berdasarkan ID
    public function getCategoryById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah kategori baru
    public function createCategory($name, $description)
    {
        $stmt = $this->db->prepare("
            INSERT INTO categories (name, description)
            VALUES (:name, :description)
        ");
        return $stmt->execute([
            'name' => $name,
            'description' => $description
        ]);
    }

    // Update kategori
    public function updateCategory($id, $name, $description)
    {
        $stmt = $this->db->prepare("
            UPDATE categories
            SET name = :name,
                description = :description
            WHERE id = :id
        ");
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'description' => $description
        ]);
    }

    // Hapus kategori
    public function deleteCategory($id)
    {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
