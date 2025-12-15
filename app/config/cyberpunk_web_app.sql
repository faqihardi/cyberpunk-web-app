-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Des 2025 pada 11.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cyberpunk_web_app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `characters`
--

CREATE TABLE `characters` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `characters`
--

INSERT INTO `characters` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'V (Male)', 'V is the customizable male protagonist of Cyberpunk 2077, a determined mercenary trying to rise within Night City\'s brutal streets. Known for his calm, low-toned voice and sharp attitude, he balances combat skill, cyberware upgrades, and street instincts. His life changes after the Relic implant binds his consciousness to Johnny Silverhand, pushing him into a struggle for identity, survival, and control. V\'s morality and personality shift based on player choices, making him a flexible and layered character.', '/img/vmale.png', '2025-12-15 02:24:56', NULL),
(2, 'V (Female)', 'V is a skilled mercenary navigating the ruthless streets of Night City. As the female version, she combines sharp instincts, adaptability, and a bold presence. After obtaining a dangerous biochip containing Johnny Silverhand\'s engram, V is forced into a fight not only against the city\'s power players but also for her own identity. Capable in gunplay, hacking, and close combat, Female V can shift from empathetic to ruthless depending on the player\'s choices. Her story often highlights loyalty, survival, and the emotional weight of her connections-especially with characters like Judy Alvarez and Panam Palmer. Stylish, cyber-enhanced, and fiercely determined, V stands as one of Night City\'s most versatile mercs.', '/img/vfemale.png', '2025-12-15 02:24:56', NULL),
(3, 'Judy Alvarez', 'Judy Alvarez is one of Night City\'s most talented braindance editors and a key member of the Mox. Brilliant, creative, and fiercely principled, she uses her technical mastery not for fame but to protect vulnerable people-especially workers exploited in the braindance industry. Judy is sharp-minded, emotionally intuitive, and unafraid to fight for what she believes in. Beneath her rebellious appearance lies a compassionate core, making her one of the most grounded and sincere allies V can have. Her relationship with V can develop into a deep, heartfelt romance-only available for Female V.', '/img/img2.png', '2025-12-15 02:24:56', NULL),
(4, 'Panam Palmer', 'Panam Palmer is a bold, resourceful nomad from the Aldecaldos clan. Known for her sharp instincts, exceptional combat skills, and unmatched driving and sniping abilities, Panam embodies the spirit of independence that defines the Badlands. Headstrong and deeply loyal, she often clashes with authority but fiercely protects those she considers family. Her partnership with V can grow into a strong bond built on trust, shared fights, and mutual respect-developing into a romantic relationship for Male V. Panam represents freedom, loyalty, and the promise of life beyond Night City\'s chaos.', '/img/img3.png', '2025-12-15 02:24:56', NULL),
(5, 'Alt Cunningham', 'Alt Cunningham is one of the most brilliant netrunners in history and the creator of the legendary Soulkiller program. Once a rising star in Night City\'s tech scene, she became the target of Arasaka, who forcibly digitized her consciousness. Now existing as a post-human entity within the Old Net, Alt is powerful, enigmatic, and far beyond human limitations. Her connection to Johnny Silverhand is emotional yet complicated, shaped by loss, memory, and the evolution of her digital self.', '/img/img5.png', '2025-12-15 02:24:56', NULL),
(6, 'Viktor Vektor', 'Viktor Vektor is a trusted ripperdoc in Watson and one of the few people in Night City who genuinely cares about his clients. Known for his calm demeanor, steady hands, and old-school ethics, Viktor offers high-quality cyberware without the predatory practices seen elsewhere in the city. He becomes a mentor and father-figure to V, providing guidance, medical support, and grounded wisdom amid the chaos of Night City.', '/img/img6.png', '2025-12-15 02:24:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `character_facts`
--

CREATE TABLE `character_facts` (
  `id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  `fact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `character_facts`
--

INSERT INTO `character_facts` (`id`, `character_id`, `fact`) VALUES
(1, 1, 'Voiced by Gavin Drea.'),
(2, 1, 'Male V\'s dialogue often has a drier, more sarcastic tone.'),
(3, 1, 'Some interactions and romance options differ from the female version.'),
(4, 2, '\"V\" isn\'t an acronym-her full name is intentionally left undefined.'),
(5, 2, 'Voiced by Cherami Leigh, known for major game and anime roles.'),
(6, 2, 'Female V has unique mocap animations, giving her distinct movement and personality.'),
(7, 3, 'Judy is considered one of the best braindance specialists in Night City, with skills rivaling corporate-level technicians.'),
(8, 3, 'Judy\'s voice actress is Carla Tassara, praised for emotional and nuanced performances.'),
(9, 3, 'Her background in Laguna Bend, a town flooded due to megacorporate expansion, shaped her distrust of big corporations.'),
(10, 4, 'Her voice actress, Emily Woo Zeller, is praised for making Panam feel grounded, emotional, and authentic.'),
(11, 4, 'Panam\'s iconic Quadra Type-66 \"Javelina\" is one of the best off-road vehicles in the game.'),
(12, 4, 'Panam is a former Aldecaldos scout and one of the most skilled drivers and sharpshooters in the Badlands.'),
(13, 5, 'Alt was originally a gifted netrunner working for ITS, long before becoming a digital consciousness.'),
(14, 5, 'Soulkiller-her creation-can copy and destroy minds, and changed the future of the Net forever.'),
(15, 5, 'Alt\'s influence extends into multiple endings, especially involving V\'s fate.'),
(16, 6, 'Viktor is an old-school ripperdoc, preferring reliable tech over flashy experimental implants.'),
(17, 6, 'He used to be an underground boxer, giving him his strong, calm presence.'),
(18, 6, 'Unlike many ripperdocs, Viktor prioritizes safety and trust over profit.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `version` varchar(255) NOT NULL,
  `header` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id`, `version`, `header`, `content`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Update 2.3 Patch Notes', 'Added 4 new vehicles', 'Update 2.3 lands tomorrow on PC, PlayStation 5, and Xbox Series X|S! The update will also be hitting Cyberpunk 2077: Ultimate Edition on Nintendo Switch 2 at a later date — stay tuned for more detes!\r\n\r\nExperience Night City in a whole new way — this patch introduces 4 new vehicles,  the AutoDrive feature, self-driving Delamain cabs and more! It also  contains updates for CrystalCoat™ and Photo Mode, as well as support for AMD FSR 3.1 Frame Generation, Intel XeSS 2.0 and HDR10+ Gaming on PC,  among others. Find out more at https://www.cyberpunk.net/en/news/51674/update-2-3-patch-notes', 4, '2025-12-14 12:58:25', '2025-12-15 07:43:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `resolution` varchar(50) DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `submissions`
--

INSERT INTO `submissions` (`id`, `title`, `image`, `resolution`, `theme`, `author`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Default Art', '/img/1.png', '1920 x 1080', 'Default Theme', 'Admin', NULL, '2025-12-14 14:06:03', NULL),
(5, 'Aku Hilmong', '/uploads/submission/submission_1765784462_4282.png', '3840 x 2160', 'Cyberpunk', 'Himi Mawla Wiedya', 4, '2025-12-15 07:41:02', NULL),
(6, 'Faqih City', '/uploads/submission/submission_1765784524_7533.png', '3840 x 2160', 'City of Satan', 'Faqih Ardiansyah', 4, '2025-12-15 07:42:04', NULL),
(9, 'Backgound Cyberpunk', '/uploads/submissions/sub_693fc3bb74e21.jpg', '3840 x 2160', 'Yello Red', 'Joko Ibrahim', 7, '2025-12-15 08:15:55', NULL),
(10, 'Johny Silverhand', '/uploads/submissions/sub_693fd7f18fc43.jpg', '3180 x 2160', 'Characters', 'Anjayani', 8, '2025-12-15 09:42:09', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `is_admin` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `password`, `is_admin`) VALUES
(4, 'Sir Hilmi', 'rajajawa', 'admin1@cyberpunk.com', '$2y$10$TriSUCfW8.8Wc/c976VuXe0EAfwXbwvYE6d4o.VE32Sko2t0r1QC6', 1),
(7, 'Joko Parsinta', 'jokosaja', 'jokodamn@gmail.com', '$2y$10$sn3IIRZ6Tdq2VUVVmtLVh.bpErholjNGMfggsDnCVBgGVGRgtEaLO', 0),
(8, 'Anjay Suranjay', 'anjayani', 'anjay@gmail.com', '$2y$10$HMSSubBoERpAqWnun94LE.WjlhVnVYRykXKvtNIA5mqK0WGE5woPG', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `character_facts`
--
ALTER TABLE `character_facts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `character_id` (`character_id`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_news_updated_by` (`updated_by`);

--
-- Indeks untuk tabel `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_submission_user` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `character_facts`
--
ALTER TABLE `character_facts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `character_facts`
--
ALTER TABLE `character_facts`
  ADD CONSTRAINT `character_facts_ibfk_1` FOREIGN KEY (`character_id`) REFERENCES `characters` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `fk_submission_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
