## Tutor Instalasi Web

- Buka direktori tempat anda ingin menyimpan project, lalu buka git bash (atau terminal biasa juga bisa) di lokasi tempat ingin menyimpan project
- ketik perintah di bawah

```bash
git clone https://github.com/onicyborg/sipbt.git
```

- masuk ke folder project dengan mengetik perintah di bawah ini pada terminal

```bash
cd sipbt
```

- lalu ketik perintah di bawah ini

```bash
composer install
```

- buka vscode dengan mengetik perintah dibawah ini

```bash
code .
```

- pada vscode, dalam folder project buat file baru dengan nama ".env" lalu copy isi dari file ".env.example" dan paste ke dalam ".env"
- ubah keterangan database (biasanya berada di line 14 dengan deskripsi DB_DATABASE) sesuai dengan yang di inginkan (contoh : sipbt) dan jangan lupa di save
- lalu jalankan perintah di bawah ini

```bash
php artisan key:generate
```

- lalu ketik perintah

```bash
php artisan migrate
```

- lalu ketik perintah

```bash
php artisan storage:link
```

- setelah itu jalankan serve dengan mengetik perintah di bawah ini

```bash
php artisan serve
```
