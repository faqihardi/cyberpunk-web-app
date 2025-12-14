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
