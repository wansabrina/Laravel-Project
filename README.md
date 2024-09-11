# Tugas Pemrograman Berbasis Kerangka Kerja

| Nama              | NRP        | Kelas  |
|-------------------|------------|--------|
| Wan Sabrina Mayzura| 5025211023 | PBKK D |

Proyek ini dibuat menggunakan Laravel dan Blade untuk membangun sebuah website dengan komponen UI yang modular. Berikut adalah penjelasan dari setiap komponen dan layout yang digunakan dalam website ini.

### Teknologi yang digunakan
- **Laravel 11**: Framework PHP modern untuk pengembangan web.
- **Laragon**: Alat setup dan manajemen lingkungan pengembangan Laravel di Windows.
- **PHP**: Bahasa pemrograman untuk scripting server-side.
- **Composer**: Manajer paket yang mengatur dependensi PHP dalam proyek.
- **Tailwind CSS**: Framework CSS untuk desain antarmuka.
- **Alpine.js**: Framework JavaScript untuk penambahan interaktivitas pada web.

### Langkah-Langkah Menjalankan Proyek Laravel dengan Laragon
1. **Start Laragon**: Buka Laragon dan klik `Start All` untuk memulai semua layanan seperti Nginx dan MySQL.
2. **Buka Terminal dari Laragon**: Navigasikan ke direktori proyek Anda menggunakan `cd Laravel-Project`.
3. **Jalankan Server Laravel**: Ketik `php artisan serve` di terminal untuk memulai server pengembangan Laravel.
4. **Kompilasi Aset**: Jalankan `npm run dev` untuk mengkompilasi aset JavaScript dan Tailwind CSS.
5. **Buka di Browser**: Akses aplikasi di browser dengan membuka `http://localhost:8000`.

## Daftar Isi
1. [Section 2 - Blade Templating Engine & Blade Component](#section-2---blade-templating-engine--blade-component)
2. [Section 3 - Blade Templating Engine & Blade Component](#section-3---blade-templating-engine--blade-component)

## Section 2 - Blade Templating Engine & Blade Component

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

- #### Navbar
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

- #### Header
    ![alt text](public/img/header.png)

    `Header` menampilkan judul halaman yang sedang aktif. Ini menyesuaikan isi berdasarkan halaman yang dikunjungi dan didefinisikan secara dinamis melalui `slot`.
    ```html
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $slot }}</h1>
        </div>
    </header>
    ```

### Halaman Web

- #### Home
    ![alt text](public/img/homepage.png)

    Halaman `Home` memberikan pengantar singkat kepada pengunjung tentang website. Komponen ini menggunakan layout utama dan mengisi slot konten dengan teks sambutan.

    ```html
    <x-layout>
        <x-slot:title>{{ $title }}</x-slot:title>
        <h3>Welcome to Home Page</h3>
    </x-layout>
    ```

    **Route**: Halaman ini diakses melalui rute `/` yang mengembalikan view `home` dengan judul 'Home Page'.

    ```php
    Route::get('/', function () {
        return view('home', ['title' => 'Home Page']);
    });
    ```

- #### Blog
    ![alt text](public/img/blog.png)

    Halaman `Blog` ini akan diisi dengan artikel atau postingan oleh pembuat website.

    ```html
    <x-layout>
        <x-slot:title>{{ $title }}</x-slot:title>
        <h3>Welcome to my Blog</h3>
    </x-layout>
    ```

    **Route**: Rute `/blog` mengarahkan ke halaman ini, mengembalikan view `blog` dengan judul 'Blog'.

    ```php
    Route::get('/blog', function () {
        return view('blog', ['title' => 'Blog']);
    });
    ```

- #### About
    ![alt text](public/img/about.png)

    Halaman `About` memberikan informasi tentang pembuat atau tujuan website. Ini juga mengambil nama dari variabel yang diberikan dan menampilkan dalam konten.

    ```html
    <x-layout>
        <x-slot:title>{{ $title }}</x-slot:title>
        <h3>This is About section</h3>
        <p>Nama: {{ $name }}</p>
    </x-layout>
    ```

    **Route**: Rute `/about` membawa pengunjung ke halaman ini, mengembalikan view `about` dengan informasi nama dan judul.

    ```php
    Route::get('/about', function () {
        return view('about', ['name'=> 'Sabrina', 'title' => 'About']);
    });
    ```

- #### Contact
    ![alt text](public/img/contact.png)

    Halaman `Contact` menyediakan informasi kontak atau formulir untuk menghubungi pembuat website.

    ```html
    <x-layout>
        <x-slot:title>{{ $title }}</x-slot:title>
        <h3>This is Contact section</h3>
    </x-layout>
    ```

    **Route**: Halaman `Contact` dapat diakses melalui rute `/contact` yang mengembalikan view `contact` dengan judul 'Contact'.

    ```php
    Route::get('/contact', function () {
        return view('contact', ['title' => 'Contact']);
    });
    ```

## Section 3 - Blade Templating Engine & Blade Component

### Blog (Updated)

Pada halaman blog, daftar artikel yang diambil dari database ditampilkan, dan setiap artikel dapat diklik untuk membuka halaman detailnya.

![Blog](public/img/posts.png)

Pada slot layout untuk page Blog, digunakan direktif `@foreach` untuk mengiterasi setiap item dalam array `$posts`. Setiap item merepresentasikan satu artikel dari database, dengan struktur data yang didefinisikan dalam model `Post`.

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

Pada loop di atas, `slug` adalah versi sederhana dari judul artikel, yang ditulis dengan huruf kecil dan dihubungkan dengan tanda strip (-). Hal ini memudahkan URL untuk dibaca dan diingat. Penggunaan slug alih-alih ID numerik meningkatkan keamanan dan SEO, karena slug yang diambil dari judul artikel lebih sulit ditebak dan memperbaiki struktur URL.

![Single Post](public/img/singlepost.png)

### Data Access and MVC Architecture

Model `Post` terletak di direktori `App\Models` dan menyediakan metode untuk mengakses data artikel. Pemisahan data ke model ini mengikuti prinsip MVC (Model-View-Controller), di mana `Model` menangani data, `View` menampilkan data, dan `Controller` menghubungkan keduanya. Awalnya, data dapat ditempatkan langsung di dalam file rute (`web.php`), namun memindahkannya ke model memungkinkan kode lebih reusable dan mengoptimalkan pemisahan tanggung jawab.

Isi file `Post.php`
```php
<?php 

namespace App\Models;
use Illuminate\Support\Arr;

class Post
{
    public static function all()
    {
        return [
            [
                'id' => '1',
                'slug' => 'judul-artikel-1',
                'title' => 'Judul Artikel 1',
                'author' => 'Wan Sabrina',
                'body' => 'Lorem ipsum...'
            ],
            [
                'id' => '2',
                'slug' => 'judul-artikel-2',
                'title' => 'Judul Artikel 2',
                'author' => 'Wan Sabrina',
                'body' => 'Lorem ipsum...'
            ],
        ];
    }
}
```
Penggunaan `namespace` seperti `namespace App\Models;` membantu dalam mengorganisir kode secara logis dan menghindari konflik nama. Di Laravel, `namespace` memungkinkan kita untuk mengelompokkan kelas yang berhubungan (misalnya model atau controller) ke dalam direktori tertentu yang memudahkan manajemen kode dan autoloading.

Selain itu untuk memisahkan tanggung jawab pengolahan data dari logika routing dan menyederhanakan akses data pada aplikasi, fungsi untuk mengakses masing masing post yang awalnya berada di dalam file routing seperti berikut:

```php
Route::get('/posts/{slug}', function ($slug) {
    $post = Arr::first(Post::all(), function ($post) use ($slug) {
        return $post['slug'] == $slug;
    });

    return view('post', ['title' => 'Single Post', 'post' => $post]);
});
```

Sebaiknya dipindahkan dari rute `web.php` ke dalam class `Post` atau file `Post.php`, seperti ini:

```php
public static function find($slug) {
    return Arr::first(static::all(), function ($post) use ($slug) {
        return $post['slug'] == $slug;
    });
}
```

Selain itu, juga bisa menggunakan arrow function untuk mempersingkat syntax:

```php
return Arr::first(static::all(), fn ($post) => $post['slug'] == $slug);
```

Setelah fungsi `find` dipindahkan ke dalam class `Post`, pada routing, bisa dipanggil sebagai berikut:

```php
Route::get('/posts/{slug}', function ($slug) {
    $post = Post::find($slug);

    return view('post', ['title' => 'Single Post', 'post' => $post]);
});
```

### Menampilkan halaman 404
![alt text](/public/img/404notfound.png)
Fungsi `find` dalam model `Post` bertugas mencari artikel berdasarkan `slug` yang diberikan. Jika artikel tidak ditemukan, Laravel akan menampilkan halaman error 404, memberitahukan bahwa sumber yang diminta tidak tersedia atau tidak ditemukan.
Sehingga pada fungsi `find` ditambahkan kondisi if else sebagai berikut:
```php
public static function find($slug): array {
    $post = Arr::first(static::all(), fn ($post) => $post['slug'] == $slug);

    if(!$post) {
        abort(404); // Memunculkan halaman error 404 jika tidak ada artikel yang cocok
    }

    return $post;
}
```