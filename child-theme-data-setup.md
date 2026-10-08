# Alur Isi Data Child Theme Berita B1

## Plugin

- Wajib aktif: **Velocity Addons**.
  - Fitur **Statistik Pengunjung** harus aktif (bawaan aktif); hitungan kunjungannya (meta `hit`) dipakai widget **Velocity Posts** urutan Populer, tab **Popular** di `[velocity-post-tabs]`, dan angka "views" di halaman artikel.
- Plugin **Kirki tidak diperlukan**; semua pengaturan tema ada di Customizer bawaan WordPress (panel **Berita Setting**).
  - Biarkan Kirki **nonaktif**: bila Kirki aktif, tema induk `velocity` memindahkan pengaturan warna/latar ke panel Kirki.

## Customize

1. **Settings › Reading**: pilih **Your latest posts** (jangan A static page).
   - Beranda (artikel utama, carousel, blok kategori, banner) dibangun di `index.php` dari tulisan terbaru; halaman statis sebagai beranda akan tampil sebagai halaman biasa.
2. Isi Customize (menu Appearance › Customize):
   1. **Site Identity**: **Logo** klien, site title, tagline, site icon.
      - Di desktop logo tampil di kiri (kolom 1/4), sejajar kotak pencarian di tengah dan tanggal di kanan; di HP logo di tengah di antara tombol menu dan tombol cari. Latar header putih.
      - Ukuran demo **188 x 29 px** (rasio melebar ±6:1). Gunakan PNG berlatar transparan.
      - Tema ini tidak memakai Header Image.
   2. **Theme Colors › Primary Accent** (setting `primary_color`): bar "Special Content" (berita berjalan), tombol cari, label kategori, dan warna hover link + pagination (demo **#ff5722**). Bawaan bila kosong: #740106. Sesuaikan dengan warna logo klien; teks di bar berita berjalan putih, jadi pilih warna yang cukup gelap/kontras.
   3. **Background**: demo putih **#ffffff**.
   4. **Berita Setting › Berita Home** (semua pilihan kategori; "Show All" = semua kategori):
      - **Headline Post**: kategori untuk bar berita berjalan "Special Content" di header (5 artikel) dan carousel pertama di beranda (6 artikel). Demo: Nasional.
      - **Post Carousel** (pertama): carousel kedua di beranda (6 artikel) + daftar 3 artikel di bawahnya. Demo: Berita.
      - **Post Carousel** (kedua): tersimpan tetapi **belum dipakai** template beranda; boleh diisi kategori lain atau dibiarkan (demo: Kriminal).
      - **Post Grid Home**: grid 3 artikel bergambar di beranda. Demo: Politik.
      - Pilih kategori yang berisi **minimal 6 artikel** agar carousel penuh. Judul tiap blok = nama kategori.
   5. **Berita Setting › Banner Setting** (gambar; kosong = tidak ditampilkan, tanpa link):
      - **Banner Header1**: paling atas di atas logo, **970 x 90 px**.
      - **Banner Header2**: di bawah bar berita berjalan, **970 x 250 px**.
      - **Banner Archive**: halaman kategori/arsip di bawah artikel pertama, **728 x 90 px**.
      - **Banner Single** (pertama): halaman artikel di bawah gambar unggulan, demo **500 x 65 px** (boleh 728 x 90).
      - **Banner Single** (kedua): halaman artikel di bawah Related posts, **970 x 90 px**.
      - **Banner Home** (pertama): beranda di bawah carousel Headline, **400 x 130 px**.
      - **Banner Home** (kedua): beranda di atas grid Post Grid Home, **970 x 250 px**.
      - Apabila client belum punya iklan, buatkan banner "Pasang Iklan di Sini" (nama media + nomor WA/email redaksi) sesuai ukuran di atas.
   6. **Berita Setting › Iklan Float**:
      - **Aktifkan Iklan Float** (bawaan aktif) + **Image Iklan Kiri** dan **Image Iklan Kanan**: gambar tegak **200 x 800 px**, menempel di kiri/kanan konten, hanya tampil di layar lebar (≥1300 px), bisa ditutup pengunjung.
      - Kosongkan gambarnya bila client tidak punya iklan float (jangan pasang banner contoh di sini).
3. **Menus**:
   - **Primary Menu** (bar di bawah logo): Home + kategori berita, mis. Home, Berita, Kriminal, Nasional, Olahraga, lalu item **Lainnya** (Custom Link `#`) berisi submenu kategori sisanya (demo: Otomotif, Pendidikan, Politik). Batasi **±8 item** di level atas agar muat satu baris.
   - **Secondary Menu** (baris kecil di bawah menu utama): Tentang Kami, Redaksi, Pedoman Media Siber, lalu beberapa kategori.

## Artikel

- Isi artikel di **Posts**: judul, isi, **gambar unggulan**, dan **kategori**. Tag opsional (tampil di bawah isi artikel).
- Semua gambar artikel dipotong **16:9** (thumbnail widget 4:3); gunakan gambar unggulan **landscape 16:9**, mis. **1200 x 675 px**. Tanpa gambar unggulan tampil gambar `no-image`.
- Beranda: artikel terbaru pertama tampil besar, diikuti blok Headline/Carousel/Grid dari Customize › Berita Home, lalu artikel terbaru lain sebagai daftar.
- Buat minimal **20 artikel**, tersebar sehingga kategori Headline Post dan Post Carousel berisi **minimal 6 artikel**, Post Grid Home minimal 3, dan tiap kategori di Primary Menu tidak kosong.
- Apabila tidak ada artikel dari client, buatkan artikel contoh sesuai kategori dan bidang media client.

## Halaman

- **Tentang Kami**: profil media.
- **Redaksi**: susunan redaksi (pemimpin redaksi, redaktur, wartawan) dan alamat/kontak redaksi. Apabila client mengirim berkas redaksi, isi dari berkas tersebut.
- **Pedoman Media Siber**: teks pedoman pemberitaan media siber (Dewan Pers).
- **Kontak** dan **Disclaimer**: halaman pendukung.
- **Privacy Policy**: terbitkan halaman kebijakan privasi bawaan WordPress.
- Semua halaman memakai template bawaan (Default), tidak perlu memilih template khusus.

## Widgets

- **Main Sidebar** (kolom kanan di beranda, arsip, artikel, dan halaman), urutan demo:
  1. **Image**: banner iklan **300 x 250 px** (bila client belum punya, banner "Pasang Iklan di Sini").
  2. **Velocity Posts** (widget bawaan tema): judul nama kategori, mis. "Nasional"; Layout **Gallery**, Kategori Nasional, Jumlah **4**, Urutkan Tanggal, Tampilkan tanggal Tidak.
  3. **Image**: banner iklan tegak **300 x 600 px**.
  4. **Velocity Posts**: judul "Berita Populer"; Layout **List**, Semua Kategori, Jumlah **10**, Urutkan **Populer**, Tampilkan views **Ya** (artikel yang belum pernah dikunjungi belum muncul).
  5. **Velocity Posts**: judul nama kategori, mis. "Politik"; Layout **List**, Kategori Politik, Jumlah **4**, Urutkan Tanggal.
  6. **Text** berisi shortcode `[velocity-post-tabs]` (tab Popular/Recent/Comment, 3 artikel; atur jumlah dengan `jumlah="5"`).
- **Footer Widget 1**: **Image** logo klien (demo 188 x 29 px) + **Text** deskripsi singkat media.
- **Footer Widget 2**: widget **Categories** judul "Categories" (atau "Kategori").
- **Footer Widget 3**: **Text** judul "Pengunjung" berisi `[velocity-statistics]`.
- Footer otomatis ditutup baris copyright nama situs + "Design by Velocity Developer".

## Logo Header

- Logo klien diisi di **Site Identity › Logo** (bukan Header Image), tampil di kiri (desktop) / tengah (HP) di atas latar putih.
- Apabila logo berwarna putih/terang sehingga tidak terlihat di latar putih, jangan ubah warna logo; berikan latar/pelat gelap di belakang logo atau garis tepi gelap tipis. Lakukan hal yang sama untuk logo di Footer Widget 1 (latar footer abu-abu muda).
