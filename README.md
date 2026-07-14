<<<<<<< HEAD
# InventoryHub

## Deskripsi

InventoryHub adalah aplikasi web berbasis PHP Native dengan arsitektur MVC (Model-View-Controller) yang digunakan untuk mengelola data inventaris barang. Aplikasi ini memiliki dua jenis pengguna, yaitu Admin dan User. Admin dapat mengelola seluruh data inventaris, sedangkan User dapat melihat daftar barang dan mengajukan permintaan penggunaan barang.

Proyek ini dibuat untuk memenuhi tugas mata kuliah **Pengembangan Aplikasi Web Dinamis**.

---

## Fitur

### Admin
- Login
- Dashboard
- Kelola Data Barang (CRUD)
- Kelola Data Kategori (CRUD)
- Kelola Data User (CRUD)
- Upload Foto Barang
- Melihat Permintaan Barang
- Menyetujui atau Menolak Permintaan Barang

### User
- Login
- Dashboard
- Melihat Daftar Barang
- Melihat Detail Barang
- Mengajukan Permintaan Barang
- Melihat Status Permintaan

---

## Teknologi yang Digunakan

- PHP Native
- MVC (Model-View-Controller)
- MySQL
- PDO (PHP Data Objects)
- Bootstrap 5
- HTML5
- CSS3
- JavaScript

---

## Struktur Folder

```
InventoryHub
│
├── app
│   ├── controllers
│   ├── models
│   └── views
│
├── config
├── core
├── database
├── public
├── routes
│
├── index.php
├── .htaccess
└── README.md
```

---

## Cara Menjalankan Aplikasi

1. Clone repository ini.
2. Pindahkan folder ke direktori `htdocs` atau `www`.
3. Buat database dengan nama:

```
inventoryhub_db
```

4. Import file SQL yang terdapat pada folder `database`.
5. Atur konfigurasi database pada file:

```
config/Database.php
```

6. Jalankan aplikasi melalui browser.

Contoh:

```
http://localhost/InventoryHub
```

---

## Akun Login

### Admin

Email :

```
admin@gmail.com
```

Password :

```
admin123
```

### User

Email :

```
user@gmail.com
```

Password :

```
user123
```

---

## Struktur Database

Database menggunakan beberapa tabel utama:

- users
- categories
- products
- requests

---

## Hak Akses

### Admin

- Mengelola seluruh data
- Mengelola user
- Mengelola kategori
- Mengelola barang
- Mengelola permintaan barang

### User

- Melihat daftar barang
- Mengajukan permintaan barang
- Melihat status permintaan

---

## Pengembang

Nama Mahasiswa : Yesi Putri

Mata Kuliah : Pengembangan Aplikasi Web Dinamis

Universitas : _(Isi sesuai universitasmu)_

Tahun : 2026 
