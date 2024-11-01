-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 28 Okt 2024 pada 12.22
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
-- Database: `tugas2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guidance`
--

CREATE TABLE `guidance` (
  `id_guidance` int NOT NULL,
  `id_student` int DEFAULT NULL,
  `problem` text,
  `solution` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `guidance`
--

INSERT INTO `guidance` (`id_guidance`, `id_student`, `problem`, `solution`) VALUES
(1, 1, 'Problem with course registration', 'Resolved by contacting admin'),
(2, 2, 'Issue with assignment submission', 'Extended submission deadline'),
(3, 3, 'Difficulty in understanding course material', 'Provided additional resources'),
(4, 4, 'Conflict with exam schedule', 'Arranged alternative exam date'),
(5, 5, 'Technical issue with online portal', 'Fixed by IT support'),
(6, 1, 'Problem with course registration', 'Resolved by contacting admin'),
(7, 1, 'Issue with assignment submission', 'Extended submission deadline'),
(8, 1, 'Difficulty in understanding course material', 'Provided additional resources'),
(9, 1, 'Conflict with exam schedule', 'Arranged alternative exam date'),
(10, 1, 'Technical issue with online portal', 'Fixed by IT support');

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id_student` int NOT NULL,
  `id_class` int DEFAULT NULL,
  `student_number` char(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `address` text,
  `id_user` int DEFAULT NULL,
  `signature` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id_student`, `id_class`, `student_number`, `name`, `phone_number`, `address`, `id_user`, `signature`) VALUES
(1, 101, 'S001', 'Alice Johnson', '081234567890', '123 Main Street, City', 1, 'sign1.png'),
(2, 102, 'S002', 'Bob Smith', '081234567891', '456 Oak Avenue, City', 2, 'sign2.png'),
(3, 103, 'S003', 'Charlie Brown', '081234567892', '789 Pine Road, City', 3, 'sign3.png'),
(4, 104, 'S004', 'David Williams', '081234567893', '321 Maple Lane, City', 4, 'sign4.png'),
(5, 105, 'S005', 'Eve Davis', '081234567894', '654 Elm Street, City', 5, 'sign5.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guidance`
--
ALTER TABLE `guidance`
  ADD PRIMARY KEY (`id_guidance`),
  ADD KEY `id_student` (`id_student`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_student`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `guidance`
--
ALTER TABLE `guidance`
  MODIFY `id_guidance` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id_student` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `guidance`
--
ALTER TABLE `guidance`
  ADD CONSTRAINT `guidance_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
