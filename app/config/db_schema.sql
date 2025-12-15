-- Table for storing character facts (one-to-many with characters)
CREATE TABLE IF NOT EXISTS character_facts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  character_id INT NOT NULL,
  fact TEXT NOT NULL,
  FOREIGN KEY (character_id) REFERENCES characters(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Example facts for each character (assuming IDs 1-6 match your inserts)
INSERT INTO character_facts (character_id, fact) VALUES
-- V (Male)
(1, 'Voiced by Gavin Drea.'),
(1, 'Male V''s dialogue often has a drier, more sarcastic tone.'),
(1, 'Some interactions and romance options differ from the female version.'),
-- V (Female)
(2, '“V” isn’t an acronym—her full name is intentionally left undefined.'),
(2, 'Voiced by Cherami Leigh, known for major game and anime roles.'),
(2, 'Female V has unique mocap animations, giving her distinct movement and personality.'),
-- Judy Alvarez
(3, 'Judy is considered one of the best braindance specialists in Night City, with skills rivaling corporate-level technicians.'),
(3, 'Judy’s voice actress is Carla Tassara, praised for emotional and nuanced performances.'),
(3, 'Her background in Laguna Bend, a town flooded due to megacorporate expansion, shaped her distrust of big corporations.'),
-- Panam Palmer
(4, 'Her voice actress, Emily Woo Zeller, is praised for making Panam feel grounded, emotional, and authentic.'),
(4, 'Panam’s iconic Quadra Type-66 “Javelina” is one of the best off-road vehicles in the game.'),
(4, 'Panam is a former Aldecaldos scout and one of the most skilled drivers and sharpshooters in the Badlands.'),
-- Alt Cunningham
(5, 'Alt was originally a gifted netrunner working for ITS, long before becoming a digital consciousness.'),
(5, 'Soulkiller—her creation—can copy and destroy minds, and changed the future of the Net forever.'),
(5, 'Alt’s influence extends into multiple endings, especially involving V’s fate.'),
-- Viktor Vektor
(6, 'Viktor is an old-school ripperdoc, preferring reliable tech over flashy experimental implants.'),
(6, 'He used to be an underground boxer, giving him his strong, calm presence.'),
(6, 'Unlike many ripperdocs, Viktor prioritizes safety and trust over profit.');
-- Table for storing character information
CREATE TABLE IF NOT EXISTS characters (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Example insert data for characters
INSERT INTO characters (name, description, image) VALUES
('V', 'The main protagonist of Cyberpunk 2077, a mercenary in Night City.', '/uploads/characters/v.png'),
('Johnny Silverhand', 'A legendary rockerboy and central character in the story.', '/uploads/characters/johnny.png'),
('Judy Alvarez', 'A skilled braindance technician and member of the Moxes.', '/uploads/characters/judy.png');
create table users (
    -> user_id int not null primary key auto_increment,
    -> name varchar(255) not null,
    -> username varchar(255) not null,
    -> email varchar(255) not null,
    -> password text not null,
    -> is_admin int(1)
);

CREATE TABLE IF NOT EXISTS news (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  version VARCHAR(255) NOT NULL,
  header VARCHAR(255) NOT NULL,
  content TEXT,
  updated_by INT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_news_updated_by FOREIGN KEY (updated_by) REFERENCES users(user_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS submissions (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  image VARCHAR(255) NOT NULL,
  resolution VARCHAR(50) NULL,
  theme VARCHAR(255) NULL,
  author VARCHAR(255) NULL,
  user_id INT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_submission_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
