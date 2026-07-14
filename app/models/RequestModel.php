<?php

require_once BASE_PATH . 'core/Model.php';

class RequestModel extends Model
{
    // Ambil semua request (untuk admin) beserta nama user dan nama produk
    public function getAllRequests()
    {
        $stmt = $this->db->query("
            SELECT r.*, u.username AS user_name, p.name AS product_name, p.stock AS product_stock
            FROM requests r
            LEFT JOIN users u ON r.user_id = u.id
            LEFT JOIN products p ON r.product_id = p.id
            ORDER BY r.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil request berdasarkan ID
    public function getRequestById($id)
    {
        $stmt = $this->db->prepare("
            SELECT r.*, u.username AS user_name, u.email AS user_email, p.name AS product_name, p.stock AS product_stock
            FROM requests r
            LEFT JOIN users u ON r.user_id = u.id
            LEFT JOIN products p ON r.product_id = p.id
            WHERE r.id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ambil semua request dari user tertentu (untuk riwayat user)
    public function getRequestsByUserId($userId)
    {
        $stmt = $this->db->prepare("
            SELECT r.*, p.name AS product_name, p.image AS product_image
            FROM requests r
            LEFT JOIN products p ON r.product_id = p.id
            WHERE r.user_id = :user_id
            ORDER BY r.created_at DESC
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tambah request baru
    public function createRequest($userId, $productId, $quantity, $purpose)
    {
        $stmt = $this->db->prepare("
            INSERT INTO requests (user_id, product_id, quantity, purpose, status)
            VALUES (:user_id, :product_id, :quantity, :purpose, 'pending')
        ");
        return $stmt->execute([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'purpose' => $purpose
        ]);
    }

    // Update status request (approve/reject)
    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("
            UPDATE requests
            SET status = :status
            WHERE id = :id
        ");
        return $stmt->execute([
            'id' => $id,
            'status' => $status
        ]);
    }
}
