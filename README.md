nama db: pantisurya 

import pantisurya.sql

List revisi:

1. Tambah input gambar di berita
2. Pake file .txt buat pengurusnya
3. Overview bisa search tagihan per bulan (overview nicho)
4. Penduduk ganti kolom pengobatan terakhir jadi tanggal masuk sama keluar
5. Penduduk: add penduduknya jadi satu trs ganti kolom + tambah tabel wali
6. Pondokkan: tampilan depan ada tagihan berapa bulan ini, bagian view laporan nanti pisah yang sudah dibayar sama belum
7. Tabungan (perlu nyambungin tabungan sama path)
8. Obat: blm jelas
9. Nyimpen nama variabelnya doang di pathnya

UPDATE SQL

ALTER TABLE penduduk
CHANGE pengobatan_terakhir tanggal_masuk DATE;
