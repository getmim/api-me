# api-me

Adalah module untuk memenej akun user yang sedang login dari API.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install api-me
```

## Profile Editor

Module sudah memiliki profile editor. Secara default, kolom yang ditangani
adalah kolom `name`, `fullname`, dan `avatar`. Jika ingin menambah kolom
yang bisa di-update melalui API, silahkan tambahkan daftar kolom pada konfigurasi
aplikasi/module form dengan nama `api-me.profile`.

## Endpoints

### `GET APIHOST/me`

Mengambil informasi tentang user yang sedang login.

### `PUT APIHOST/me/password`

Endpoint untuk mengubah password user. Menerima parameters `old`, `new`, dan `retype`.

### `PUT APIHOST/me/proifle`

Mengubah data profile user. Secara default hanya menerima `name`, `fullname`, dan `avatar`.