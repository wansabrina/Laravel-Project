# Tugas Pemrograman Berbasis Kerangka Kerja

| Nama              | NRP        | Kelas  |
|-------------------|------------|--------|
| Wan Sabrina Mayzura| 5025211023 | PBKK D |

Proyek ini dibuat menggunakan Laravel dan Blade untuk membangun sebuah website dengan komponen UI yang modular. Berikut adalah penjelasan dari setiap komponen dan layout yang digunakan dalam website ini.

## Struktur Komponen

### Layout Utama
Layout utama digunakan sebagai kerangka dasar untuk semua halaman dalam website. Layout ini mengintegrasikan komponen-komponen seperti navbar, header, dan main, di mana slot main digunakan sebagai tempat penempatan konten halaman sebenarnya. Slot ini memungkinkan konten yang spesifik untuk masing-masing halaman dapat disisipkan secara dinamis berdasarkan kebutuhan halaman tersebut.

```html
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>{{ $title }}</title>
</head>
<body class="h-full">
    <div class="min-h-full">
        <x-navbar></x-navbar>
        <x-header>{{ $title }}</x-header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
```

### Navbar
![alt text](public/img/navbar.png)

Komponen `navbar` berfungsi untuk navigasi antar halaman. Navbar ini responsif dan menyediakan dropdown menu untuk akses cepat ke profil pengguna. Komponen ini dibangun menggunakan Tailwind CSS dan Alpine.js.

![alt text](public/img/dropdown.png)

Komponen x-nav-link membuat tautan navigasi yang aktif sesuai dengan halaman yang sedang dikunjungi. Atribut :active membandingkan URL saat ini dengan target untuk menentukan tautan aktif. 
```html
<x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
<x-nav-link href="/posts" :active="request()->is('posts')">Blog</x-nav-link>
<x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link>
<x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
```

### Header
![alt text](public/img/header.png)

`Header` menampilkan judul halaman yang sedang aktif. Ini menyesuaikan isi berdasarkan halaman yang dikunjungi dan didefinisikan secara dinamis melalui `slot`.
```html
<header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $slot }}</h1>
    </div>
</header>
```

## Halaman Web

### Home
![alt text](public/img/homepage.png)

Halaman `Home` memberikan pengantar singkat kepada pengunjung tentang website. Komponen ini menggunakan layout utama dan mengisi slot konten dengan teks sambutan.


### Blog
Menampilkan daftar artikel yang tersedia di website. Setiap artikel dapat diklik untuk membuka halaman detailnya.

![alt text](public/img/blog.png)

Menggunakan direktif `@foreach`, kode ini mengiterasi melalui setiap item dalam array `$posts`. Setiap item dalam array ini mewakili satu postingan yang diambil dari database.

```html
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @foreach ($posts as $post)
    <article class="py-8 max-w-screen-md border-b border-grey-300">
        <a href="/posts/{{ $post['slug'] }}" class="hover:underline">
            <h2 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">{{ $post['title'] }}</h2>
        </a>
        <div class="text-base text-gray-500">
            <a href="#">{{ $post['author'] }}</a> | 1 January 2024
        </div>
        <p class="my-4 font-light">
            {{ Str::limit($post['body'], 120) }}
        </p>
        <a href="/posts/{{ $post['slug'] }}" class="font-medium text-blue-500">Read More &raquo;</a>
    </article>
    @endforeach

</x-layout>
```

Di dalam loop, `slug` adalah versi judul postingan yang disederhanakan, umumnya ditulis dengan huruf kecil dan dihubungkan dengan strip (-), yang membuat URL lebih mudah dibaca.

![alt text](public/img/singlepost.png)

### About
![alt text](public/img/about.png)

Halaman `About` memberikan informasi tentang pembuat atau tujuan website. Ini juga mengambil nama dari variabel yang diberikan dan menampilkan dalam konten.

```html
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h3>This is About section</h3>
    <p>Nama: {{ $name }}</p>
</x-layout>
```

### Contact
![alt text](public/img/contact.png)

Halaman `Contact` menyediakan informasi kontak atau formulir untuk menghubungi pembuat website.

```html
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h3>This is Contact section</h3>
</x-layout>
```

## Teknologi yang digunakan
- **Laravel 11**: Framework PHP modern untuk pengembangan web yang efisien.
- **Laragon**: Alat yang memudahkan setup dan manajemen lingkungan pengembangan Laravel di Windows.
- **PHP**: Bahasa pemrograman untuk scripting server-side dengan dukungan fitur terbaru.
- **Composer**: Manajer paket yang mengatur dependensi PHP dalam proyek.
- **Tailwind CSS**: Framework CSS untuk desain antarmuka yang cepat dan responsif.
- **Alpine.js**: Framework JavaScript ringan untuk penambahan interaktivitas sederhana pada halaman web.

## Langkah-Langkah Menjalankan Proyek Laravel dengan Laragon
1. **Start Laragon**: Buka Laragon dan klik `Start All` untuk memulai semua layanan seperti Nginx dan MySQL.
2. **Buka Terminal dari Laragon**: Navigasikan ke direktori proyek Anda menggunakan `cd Laravel-Project`.
3. **Jalankan Server Laravel**: Ketik `php artisan serve` di terminal untuk memulai server pengembangan Laravel.
4. **Kompilasi Aset**: Jalankan `npm run dev` untuk mengkompilasi aset JavaScript dan Tailwind CSS.
5. **Buka di Browser**: Akses aplikasi di browser dengan membuka `http://localhost:8000`.