# Dokumentasi UI Komponen Website

Proyek ini menggunakan Laravel dan Blade untuk membangun sebuah website dengan komponen UI yang modular. Berikut adalah penjelasan dari setiap komponen dan layout yang digunakan dalam website ini.

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

### Header
![alt text](public/img/header.png)
`Header` menampilkan judul halaman yang sedang aktif. Ini menyesuaikan isi berdasarkan halaman yang dikunjungi dan didefinisikan secara dinamis melalui `slot`.
```
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

Pada halaman Blog, setiap artikel ditampilkan dengan tautan yang mengarah ke halaman detail berdasarkan slug-nya. Slug adalah string unik yang berfungsi sebagai pengenal URL-friendly untuk setiap artikel. Ketika pengguna mengklik pada judul atau tautan "Read More" di setiap artikel, mereka diarahkan ke URL seperti `/posts/{slug}`, di mana {slug} diisi dengan slug spesifik dari artikel tersebut.

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