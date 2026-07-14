<?php

require_once BASE_PATH . 'core/Model.php';

class UserModel extends Model
{
    // Ambil user berdasarkan email
    public function getUserByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([
            'email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ambil user berdasarkan ID
    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ambil semua user
    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM users ORDER BY username ASC");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Register User
    public function register($username, $email, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("
            INSERT INTO users
            (username,email,password,role)
            VALUES
            (:username,:email,:password,'user')
        ");

        return $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);
    }

    // Update Profile
    public function updateProfile($id, $username, $email, $street, $city, $province, $zip)
    {
        $stmt = $this->db->prepare("
            UPDATE users
            SET username = :username,
                email = :email,
                address_street = :street,
                address_city = :city,
                address_province = :province,
                address_zip = :zip
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'street' => $street,
            'city' => $city,
            'province' => $province,
            'zip' => $zip
        ]);
    }

    // Create User (Admin)
    public function createUser($username, $email, $password, $role, $street, $city, $province, $zip)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("
            INSERT INTO users
            (username, email, password, role, address_street, address_city, address_province, address_zip)
            VALUES
            (:username, :email, :password, :role, :street, :city, :province, :zip)
        ");

        return $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $passwordHash,
            'role' => $role,
            'street' => $street,
            'city' => $city,
            'province' => $province,
            'zip' => $zip
        ]);
    }

    // Update User (Admin)
    public function updateUser($id, $username, $email, $role, $street, $city, $province, $zip, $password = '')
    {
        if (!empty($password)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("
                UPDATE users
                SET username = :username,
                    email = :email,
                    role = :role,
                    address_street = :street,
                    address_city = :city,
                    address_province = :province,
                    address_zip = :zip,
                    password = :password
                WHERE id = :id
            ");
            return $stmt->execute([
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'role' => $role,
                'street' => $street,
                'city' => $city,
                'province' => $province,
                'zip' => $zip,
                'password' => $passwordHash
            ]);
        } else {
            $stmt = $this->db->prepare("
                UPDATE users
                SET username = :username,
                    email = :email,
                    role = :role,
                    address_street = :street,
                    address_city = :city,
                    address_province = :province,
                    address_zip = :zip
                WHERE id = :id
            ");
            return $stmt->execute([
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'role' => $role,
                'street' => $street,
                'city' => $city,
                'province' => $province,
                'zip' => $zip
            ]);
        }
    }

    // Hapus User
    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id=:id");

        return $stmt->execute([
            'id' => $id
        ]);
    }
}