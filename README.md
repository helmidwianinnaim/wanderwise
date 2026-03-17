# 🌍 WanderWise — Curated Travel Intelligence

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=2D3748)](https://alpinejs.dev)

> **"Travel is more than seeing of sights; it is a change that goes on, deep and permanent, in the ideas of living."** 

---

## 📖 The Story Behind WanderWise

WanderWise lahir dari sebuah keresahan sederhana: **informasi perjalanan yang terlalu berisik.** 

Saat ini, mencari panduan perjalanan seringkali berarti harus melewati tumpukan iklan, desain web yang berantakan, dan konten yang tidak relevan. Kami ingin mengembalikan esensi dari eksplorasi—memberikan informasi yang jernih, visual yang memukau, dan kurasi destinasi yang benar-benar bermakna.

WanderWise didesain sebagai "Travel Intelligence" pribadi bagi mereka yang menghargai waktu dan kualitas. Fokus pada dua wilayah ikonik, **USA** dan **Europe**, proyek ini bertujuan menyederhanakan cara traveler menemukan inspirasi melalui desain yang *minimalist* namun tetap *premium*.

---

## ✨ Key Features

### 🏔️ Smart Destination Filtering
Sistem navigasi yang cerdas memungkinkan pengguna menyaring destinasi berdasarkan wilayah (USA/Europe) hingga kategori spesifik seperti *Budget-Friendly*, *National Parks*, atau *Mediterranean*.

### 🔍 Live Search Engine
Menggunakan **Alpine.js**, fitur pencarian kami bekerja secara *real-time* dan interaktif. Jika destinasi yang dicari belum tersedia, sistem akan memberikan rekomendasi alternatif yang populer secara cerdas.

### 🔐 Powerful Admin CMS
Manajemen konten di balik layar yang elegan:
- **General Settings**: Kendali penuh atas logo, media sosial, dan deskripsi situs.
- **Content Management**: CRUD (Create, Read, Update, Delete) yang mulus untuk Destinasi, Post Blog, dan Kategori.
- **Dynamic UI Control**: Admin dapat mengatur skema warna kategori langsung dari dashboard.

---

## 🛠️ Tech Stack

- **Backend**: Laravel 10 (PHP 8.1+)
- **Frontend**: Blade Engine, JavaScript (ES6+), Alpine.js
- **Styling**: Tailwind CSS (Custom Design System)
- **Database**: MySQL / MariaDB
- **Icons**: Heroicons & FontAwesome

---

## 🚀 Installation Guide

Jika Anda ingin menjalankan proyek ini secara lokal:

1. **Clone the repository**
   ```bash
   git clone https://github.com/username/wanderwise.git
   cd wanderwise
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Migration**
   ```bash
   php artisan migrate --seed
   ```

5. **Run the server**
   ```bash
   php artisan serve
   ```

---

## 📸 Preview

Berikut adalah tampilan antarmuka dari WanderWise:

<p align="center">
  <img src="screenshots/homepage.png" width="800" alt="Homepage WanderWise">
  <br>
  <em>Tampilan Beranda - Minimalist & Premium</em>
</p>

<p align="center">
  <img src="screenshots/dashboard.png" width="800" alt="Admin Dashboard WanderWise">
  <br>
  <em>Dashboard Admin - Full Content Control</em>
</p>

---

## 👨‍💻 Developer
Dibuat dengan ❤️ untuk para traveler dunia.

---
*WanderWise — Where curiosity meets clarity.*
