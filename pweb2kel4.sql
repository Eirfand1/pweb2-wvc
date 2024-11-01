-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 28 Okt 2024 pada 13.03
-- Versi server: 8.0.30
-- Versi PHP: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pweb2kel4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `penulis_id` int DEFAULT NULL,
  `kategori_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `judul`, `konten`, `penulis_id`, `kategori_id`) VALUES
(1, '10 Tren Teknologi 2024', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 1, 1),
(2, 'Tips Hidup Sehat di Era Digital', 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 2, 6),
(3, 'Perkembangan Politik Terkini', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 3, 3),
(4, 'Review Restoran Bintang 5', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 4, 4),
(5, 'Belajar Programming untuk Pemula', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.', 5, 1),
(6, 'Tren Fashion 2024', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.', 2, 2),
(7, 'Analisis Ekonomi Kuartal I', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod.', 3, 8),
(8, 'Tips Memasak untuk Pemula', 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet.', 4, 4),
(9, 'AI dalam Kehidupan Sehari-hari', 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores.', 1, 1),
(10, 'Olahraga di Rumah yang Efektif', 'Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae.', 2, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Teknologi'),
(2, 'Lifestyle'),
(3, 'Politik'),
(4, 'Kuliner'),
(5, 'Pendidikan'),
(6, 'Kesehatan'),
(7, 'Olahraga'),
(8, 'Bisnis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `artikel_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `username`, `isi_komentar`, `tanggal_update`, `artikel_id`) VALUES
(1, 'user123', 'Artikel yang sangat informatif!', '2024-10-28 13:03:15', 1),
(2, 'tech_lover', 'Saya setuju dengan point nomor 3', '2024-10-28 13:03:15', 1),
(3, 'health_enthusiast', 'Terima kasih atas tipsnya!', '2024-10-28 13:03:15', 2),
(4, 'political_junkie', 'Analisis yang menarik', '2024-10-28 13:03:15', 3),
(5, 'foodie99', 'Reviewnya sangat membantu', '2024-10-28 13:03:15', 4),
(6, 'code_newbie', 'Tutorial yang mudah dipahami', '2024-10-28 13:03:15', 5),
(7, 'fashion_lover', 'Trend fashion-nya keren2', '2024-10-28 13:03:15', 6),
(8, 'analyst01', 'Analisis yang mendalam', '2024-10-28 13:03:15', 7),
(9, 'cooking_mom', 'Akan saya coba tips memasaknya', '2024-10-28 13:03:15', 8),
(10, 'ai_fan', 'AI memang luar biasa', '2024-10-28 13:03:15', 9),
(11, 'fit_life', 'Olahraga yang simpel tapi efektif', '2024-10-28 13:03:15', 10),
(12, 'tech_guru', 'Ditunggu artikel selanjutnya!', '2024-10-28 13:03:15', 1),
(13, 'health_doc', 'Bagus untuk kesehatan mental juga', '2024-10-28 13:03:15', 2),
(14, 'news_reader', 'Beritanya update terus', '2024-10-28 13:03:15', 3),
(15, 'food_critic', 'Saya sudah mengunjungi restoran ini', '2024-10-28 13:03:15', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `bio` text,
  `profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama`, `bio`, `profil`) VALUES
(1, 'John Doe', 'Penulis teknologi dan inovasi', 'john-profile.jpg'),
(2, 'Jane Smith', 'Spesialis konten lifestyle', 'jane-profile.jpg'),
(3, 'Ahmad Rahman', 'Jurnalis politik dan ekonomi', 'ahmad-profile.jpg'),
(4, 'Sarah Wilson', 'Food blogger dan kritikus kuliner', 'sarah-profile.jpg'),
(5, 'Michael Chen', 'Tech reviewer dan developer', 'michael-profile.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`),
  ADD KEY `penulis_id` (`penulis_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `artikel_id` (`artikel_id`);

--
-- Indeks untuk tabel `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_ibfk_1` FOREIGN KEY (`penulis_id`) REFERENCES `penulis` (`id_penulis`) ON DELETE SET NULL,
  ADD CONSTRAINT `artikel_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`artikel_id`) REFERENCES `artikel` (`id_artikel`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
