<?php

require_once BASE_PATH . 'core/Model.php';

class ProductModel extends Model
{
    // Ambil semua produk beserta nama kategori
    public function getAllProducts()
    {
        $stmt = $this->db->query("
            SELECT p.*, c.name AS category_name 
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            ORDER BY p.name ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil produk berdasarkan ID
    public function getProductById($id)
    {
        $stmt = $this->db->prepare("
            SELECT p.*, c.name AS category_name 
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah produk baru
    public function createProduct($categoryId, $name, $description, $image, $stock)
    {
        $stmt = $this->db->prepare("
            INSERT INTO products (category_id, name, description, image, stock)
            VALUES (:category_id, :name, :description, :image, :stock)
        ");
        return $stmt->execute([
            'category_id' => $categoryId,
            'name' => $name,
            'description' => $description,
            'image' => $image,
            'stock' => $stock
        ]);
    }

    // Update produk
    public function updateProduct($id, $categoryId, $name, $description, $image, $stock)
    {
        $stmt = $this->db->prepare("
            UPDATE products
            SET category_id = :category_id,
                name = :name,
                description = :description,
                image = :image,
                stock = :stock
            WHERE id = :id
        ");
        return $stmt->execute([
            'id' => $id,
            'category_id' => $categoryId,
            'name' => $name,
            'description' => $description,
            'image' => $image,
            'stock' => $stock
        ]);
    }

    // Hapus produk
    public function deleteProduct($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Update stok produk secara langsung
    public function updateStock($id, $newStock)
    {
        $stmt = $this->db->prepare("
            UPDATE products
            SET stock = :stock
            WHERE id = :id
        ");
        return $stmt->execute([
            'id' => $id,
            'stock' => $newStock
        ]);
    }
}
