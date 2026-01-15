# Instalasi Cepat

1.  **Clone repositori**
    ```bash
    git clone <URL_REPOSITORI_ANDA>
    cd <NAMA_FOLDER_PROYEK>
    ```

2.  **Install dependencies**
    ```bash
    composer install
    ```

3.  **Setup file `.env`**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Konfigurasi Database**
    Buka file `.env` dan atur koneksi database Anda (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

5.  **Jalankan Migrasi & Link Storage**
    ```bash
    php artisan migrate
    php artisan storage:link
    ```

6.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
