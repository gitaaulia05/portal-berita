
<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/othneildrew/Best-README-Template">
    <img src="public/assets/images/logo.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">PORTAL BERITA</h3>

  <p align="center">
   Wesbite yang menampilkan daftar berita terkini.
    <br />
  </p>
</div>


<!-- ABOUT THE PROJECT -->
## About Project
PORTAL BERITA adalah website sederhana yanhg menampilkan daftar  berita terkini yang diambil dari <a href="https://github.com/gitaaulia05/api-news">API BERITA </a>. Website ini dirancang agar mudah diakses, ringna dan responsif di berbagai perangkat.


### Built With
PORTAL BERITA ini dibuat menggunakan laravel serta untuk optimalisasi Response aplikasi ini didukung oleh franken PHP.
* [![Laravel][Laravel.com]][Laravel-url]
* [![Mysql][Mysql.com]][Mysql-url]
* [![Tailwind][Tailwind.com]][Tailwind-url]
* [![Bootsrap][Bootsrap.com]][Bootsrap-url]


## Fitur Utama
* ✅ Menampilkan daftar berita terkini
* 🔍 Fitur pencarian berita
* 📂 Filter berdasarkan kategori/topik
* 📱 Responsif (mobile friendly)
* 🌐 Konsumsi API eksternal (REST API)

<!-- GETTING STARTED -->
## Getting Started
Panduan awal untuk menyiapkan dan menjalankan proyek Portal Berita di lingkungan lokal. 

### Prerequisites
Hal yang diperlukan untuk mendukung aplikasi ini berjalan, gunakan command dibawah ini di terminal.

* npm
  ```sh
  npm install npm@latest -g
  ```

### Installation

_Ikuti langkah-langkah berikut untuk menginstal dan menjalankan aplikasi secara lokal._

1. Clone repositori
   ```sh
    https://github.com/gitaaulia05/portal-berita
   ```
2. Install NPM packages
   ```sh
   npm install
   ```
3. Generate application key dan jalankan migrasi database beserta seeder:
   ```bash
    php artisan key:generate
    php artisan migrate --seed
   ```

4. Instalasi Franken PHP pastikan anda sudah memiliki WSL di Komputer pribadi anda dan jalankan perinta di bawah ini di dalam WSL

    ``` bash
      sudo apt update
      sudo apt install frankenphp
     php artisan octane:start --server=frankenphp --host=172.23.67.4 --port=8002 --https
    ```

<!-- USAGE EXAMPLES -->
## Tambahan

_Website ini merupakan hasil implementasi dari proyek API-news maka diharapkan untuk clone terlebih dahulu repository tesebut
<a href="https://github.com/gitaaulia05/api-news">API-News</a>_


## Preview proyek 
- Halaman Awal 
<img src="public/assets/images/Screenshot 2025-05-26 225130.png">

- Halaman Detail berita
<img src="public/assets/images/Screenshot 2025-05-26 232755.png">

- Halaman Profile
<img src="public/assets/images/Screenshot 2025-05-26 233209.png">


[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com

[Tailwind.com]:https://img.shields.io/badge/Tailwind_CSS-grey?style=for-the-badge&logo=tailwind-css&logoColor=38B2AC
[Tailwind-url]: https://tailwindcss.com/

[Bootsrap.com]:https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootsrap-url]: https://getbootstrap.com/docs/4.6/getting-started/introduction/

[Mysql.com]:https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white
[Mysql-url]:https://www.mysql.com/