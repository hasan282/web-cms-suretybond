# CMS Aplikasi Suretybond

## Install di Server Lokal

1. Download File [PLUGIN](https://drive.google.com/file/d/1Gjv1kKclZ92QPfx10YvEihxCMh-IH6Wi/view) dan [VENDOR](https://drive.google.com/file/d/1S0gXXwrhpintvg8CmC7Tv4NJ5B7DqQLq/view) pada Google Drive.

2. Ekstrak file `plugins_and_fonts.rar` pada folder utama.

3. Ekstrak `vendor_ci.rar` pada folder `public/`.

4. Rename file `env` menjadi `.env`.

5. Buat database baru dengan nama `jasmin_sbond` atau sesuaikan nama database pada `.env`.

```bash
database.default.database = jasmin_sbond
```

6. Jalankan perintah pada terminal untuk migrasi database dan seeder.

```bash
php spark migrate

php spark db:seed AllSeeder
```

7. Jalankan perintah pada terminal untuk running aplikasi.

```bash
php spark serve
```

## Server Requirements

Dibutuhkan PHP versi 8.0 atau lebih tinggi, dengan terinstall extension berikut:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- json
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php)

atau lihat Server Requirements pada dokumentasi [Codeigniter 4](https://codeigniter.com/user_guide/intro/requirements.html).
