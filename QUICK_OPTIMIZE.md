# ⚡ Quick Image Optimization - 3 Langkah!

## 🚀 Langkah 1: Optimize Images yang Sudah Ada

```bash
php optimize-images.php
```

**Hasil:** Images jadi 50-90% lebih kecil! 🎉

---

## 🚀 Langkah 2: Update Composer Autoload

```bash
composer dump-autoload
```

---

## 🚀 Langkah 3: Update Views untuk Lazy Loading

### Contoh: Update `resources/views/gallery/galeri.blade.php`

**Cari:**
```blade
<img src="{{ $imagePath }}" 
     alt="{{ $foto->judul ?? 'Foto' }}" 
     class="gallery-image">
```

**Ganti dengan:**
```blade
{!! \App\Helpers\ImageHelper::lazyImage(
    $foto->file_path ?? $foto->thumbnail_path, 
    $foto->judul ?? 'Foto', 
    'gallery-image'
) !!}
```

### Atau Manual (jika helper tidak work):

```blade
<img 
    src="{{ asset('storage/' . ($foto->file_path ?? '')) }}"
    alt="{{ $foto->judul ?? 'Foto' }}"
    class="gallery-image"
    loading="lazy"
    decoding="async"
    style="width: 100%; height: auto;"
>
```

---

## ✅ Done!

Website lo sekarang jauh lebih cepat! Test di mobile dengan slow 3G untuk lihat perbedaannya! 🚀

---

**Tips:**
- Run `php optimize-images.php` setiap kali ada images baru yang belum di-optimize
- Upload baru akan auto-optimize (controller sudah diupdate)
- Check file sizes: harus < 500KB per image

