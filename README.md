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
2. [Section 3 - View Data & Model](#section-3---view-data--model)
2. [Section 4 - Database & Migration | Eloquent ORM & Post Model](#section-4---database--migration--eloquent-orm--post-model)

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

## Section 3 - View Data & Model

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

## Section 4 - Database & Migration | Eloquent ORM & Post Model

### Database & Migration

Pada section ini, kita akan mengonfigurasi database menggunakan SQLite atau MySQL.

- **SQLite**: Database berbasis file yang mudah digunakan.
- **MySQL**: Database server yang lebih kuat dan ideal untuk aplikasi yang lebih kompleks.

#### Konfigurasi Database

Pada file `.env`, jika menggunakan SQLite, konfigurasi database hanya perlu diisi seperti berikut:
```
DB_CONNECTION=sqlite
```
Jika menggunakan MySQL, hapus bagian yang ditandai sebagai komentar dan isi konfigurasi sebagai berikut:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pbkk_laravel
DB_USERNAME=root
DB_PASSWORD=
```

#### Testing Database

Untuk mengetes kedua jenis database, kita dapat menggunakan `TablePlus`. Tambahkan database baru dan lakukan migration dengan menjalankan perintah `php artisan migrate`. Setelah perintah ini dijalankan, masing-masing database akan berisi tabel-tabel yang telah didefinisikan dalam file migration yang ada di direktori `database` proyek kita.

![Default Migration](public/img/migrationdefault.png)

Pada database `PBKK_SQLite`, database akan otomatis terisi dengan tabel-tabel seperti berikut:

![SQLite Tables](public/img/tabelsqlite.png)

#### Membuat Tabel Baru

Untuk project ini, kita akan menggunakan SQLite karena lebih cocok untuk struktur project yang sederhana. Pada section sebelumnya, kita telah membuat post dengan data yang masih di-hardcode. Sekarang, kita akan membuat tabel baru untuk menyimpan data post ini.

Di terminal, jalankan perintah berikut untuk membuat tabel `create_posts_table`:
```
php artisan make:migration create_posts_table
```

Setelah menjalankan perintah tersebut, file migration baru akan muncul di dalam direktori `database/migrations`. Buka file tersebut dan isi struktur tabelnya seperti ini sesuai dengan struktur data dari model post yang telah dibuat sebelumnya:

```php
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('slug')->unique();
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
```

#### Menjalankan Migration

Setelah mengedit file migration, jalankan perintah berikut di terminal untuk menjalankan migrasi dan meng-update database:
```
php artisan migrate:fresh
```
Perintah ini akan menghapus semua tabel yang ada dan menjalankan ulang semua migration, termasuk migration baru yang kita buat.

Setelah menjalankan migration, tabel `posts` akan muncul di dalam database dengan struktur seperti berikut, dan bisa mengisi data/row dari tabel `posts` dengan data yang telah dibuat sebelumnya.

![Posts Table Added](public/img/tablepostsadded.png) 

### Eloquent ORM & Post Model
Eloquent ORM adalah fitur bawaan Laravel yang memungkinkan kita untuk memetakan tabel di dalam database ke dalam bentuk objek. Setiap tabel di dalam database memiliki model yang berkorespondensi, dan model ini yang akan kita gunakan untuk berinteraksi dengan tabel tersebut. Model ini akan mempermudah kita dalam melakukan berbagai operasi pada database tanpa harus menulis query SQL secara manual.

#### Menghubungkan Model dengan Tabel

Kita sudah memiliki tabel `posts` di dalam database `PBKK_SQLite`, dan sebelumnya kita telah membuat file model `Post.php` di direktori `app/Models`. File tersebut awalnya berisi method statis `all` dan `find` untuk mencari single post berdasarkan slug.

Namun, dengan menggunakan Eloquent ORM, kita bisa langsung menghubungkan model `Post` dengan tabel `posts`. Secara default, Laravel akan otomatis menyambungkan model dengan tabel yang memiliki nama jamak dari model tersebut.

Untuk membuat model `Post` dengan cara yang benar, kita perlu menambahkan `extends Model` agar model tersebut mewarisi perilaku dari Eloquent Model. Caranya cukup dengan menambahkan `use Illuminate\Database\Eloquent\Model` di dalam file `Post.php` dan meng-extend `Model`:

```php
<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

}
```

Karena Eloquent Model secara default sudah memiliki fungsi `all` untuk mengambil semua data dan `find` untuk mencari data berdasarkan ID, kita tidak perlu lagi menulis method statis `all` dan `find` secara manual. Kita cukup menggunakan method bawaan dari Eloquent.

#### Menyambungkan Model dan Tabel dengan nama yang berbeda 

Secara default, Laravel akan menyambungkan model `Post` dengan tabel `posts` secara otomatis. Namun, jika nama model berbeda dengan nama tabel, atau nama tabel tidak mengikuti aturan jamak, kita perlu menyambungkan model ke tabel secara eksplisit.

Misalnya, jika tabel yang ingin kita hubungkan dengan model adalah `my_posts`, maka kita bisa menghubungkannya dengan menambahkan properti `$table` pada model:

```php
class Post extends Model 
{
    protected $table = 'my_posts'; 
}
```

#### Mengatur Primary Key

Secara default, Eloquent menggunakan kolom `id` sebagai primary key. Jika tabel menggunakan nama kolom primary key yang berbeda, kita dapat mengaturnya menggunakan properti `$primaryKey`:

```php
class Post extends Model 
{
    protected $table = 'my_posts'; 
    protected $primaryKey = 'posts_id'; 
} 
```

### Mengganti Fungsi `find` dengan Eloquent Routing

Di Laravel, secara default, model memiliki fungsi `find` yang mencari data berdasarkan ID. Namun, kita juga bisa menggunakan route model binding untuk mencari data berdasarkan atribut lain seperti `slug`. 

Dengan route model binding, kita bisa langsung mengembalikan instance model yang sesuai dengan kriteria pencarian tertentu tanpa perlu menggunakan fungsi `find` lagi. Berikut adalah cara menggunakannya pada file routing `web.php`:

```php
Route::get('/posts/{post:slug}', function (Post $post) {
    // $post = Post::find($slug); // Tidak perlu lagi

    return view('post', ['title' => 'Single Post', 'post' => $post]);
});
```

Dalam contoh di atas, kita menggunakan route model binding dengan menambahkan `{post:slug}`. Dengan ini, Laravel akan otomatis mencari post berdasarkan kolom `slug` dan mengembalikan instance `Post` yang sesuai. Kita tidak perlu lagi memanggil fungsi `find` secara manual. 

### Menambahkan Data Menggunakan Tinker
Sebelum kita bisa menambahkan data ke tabel `posts` melalui Tinker, kita perlu menambahkan properti `$fillable` di model `Post`. Properti ini menentukan field mana saja yang dapat diisi melalui metode mass assignment, seperti `create`:

```php
class Post extends Model
{
    protected $fillable = ['title', 'author', 'slug', 'body'];
}
```

`$fillable` digunakan untuk melindungi aplikasi dari *mass assignment vulnerabilities*. Dengan mendefinisikan field yang dapat diisi, kita memastikan bahwa hanya field tersebut yang bisa diisi melalui mass assignment.

#### Memasukkan Data dengan Tinker

Untuk memasukkan data ke dalam tabel `posts` menggunakan Tinker, ikuti langkah-langkah berikut:

- Buka terminal dan jalankan perintah berikut untuk masuk ke Tinker:
    ```bash
    php artisan tinker
    ```

- Setelah masuk ke Tinker, jalankan perintah berikut untuk membuat data baru:
   ![image](public/img/datamasuk.png)

Data akan dimasukkan ke dalam tabel `posts`, dan field `created_at` serta `updated_at` akan diisi secara otomatis oleh Eloquent.

#### Menggunakan `created_at` di View

Karena Eloquent secara otomatis mengisi field `created_at`, kita bisa menggunakan data ini untuk menampilkan tanggal kapan post dibuat di view kita. Contoh penggunaan di view:

Menggunakan format tanggal tertentu:
```php
<a href="#">{{ $post['author'] }}</a> | {{ $post->created_at->format('j F Y')}}
```

Atau menggunakan waktu relatif:
```php
<a href="#">{{ $post['author'] }}</a> | {{ $post->created_at->diffForHumans()}}
```

## Operasi Lain yang Bisa Dilakukan di Tinker

Selain memasukkan data, ada berbagai operasi lain yang bisa dilakukan di Tinker, seperti:

- **Mengambil Semua Data**:
    ```php
    App\Models\Post::all();
    ```

- **Mengambil Data Pertama**:
    ```php
    App\Models\Post::first();
    ```

- **Mengambil Data Berdasarkan ID**:
    ```php
    App\Models\Post::find(1);
    ```

- **Menghapus Data**:
    ```php
    $post = App\Models\Post::find(1);
    $post->delete();
    ```

- **Mengupdate Data**:
    ```php
    $post = App\Models\Post::find(1);
    $post->title = 'Updated Title';
    $post->save();
    ```

### Membuat Model Beserta Migration

Selain membuat model secara manual, kita juga bisa membuat model beserta migration-nya secara otomatis dengan satu perintah. Berikut cara melakukannya:

- Buka terminal dan jalankan perintah berikut:
    ```bash
    php artisan make:model Post -m
    ```

Perintah ini akan membuat model `Post` dan juga migration untuk tabel `posts`. Kita dapat menemukan file migration yang baru dibuat di direktori `database/migrations`.

Setelah mendefinisikan struktur tabel `posts`, jalankan migration untuk membuat tabel di database:
```bash
php artisan migrate
```