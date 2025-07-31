CREATE DATABASE IF NOT EXISTS tasks CHARSET utf8mb4;
USE tasks;

CREATE TABLE IF NOT EXISTS users (
	id_users INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS task (
	id_task INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    description VARCHAR(255),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    end_date DATETIME NOT NULL,
    status BOOLEAN NOT NULL,
    id_users INT NOT NULL,
    CONSTRAINT fk_users_task FOREIGN KEY(id_users) REFERENCES users(id_users) ON DELETE CASCADE
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS category(
	id_category INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS task_category(
	id_task INT,
    id_category INT,
    PRIMARY KEY(id_task,id_category),
    CONSTRAINT fk_task_task_category FOREIGN KEY(id_task) REFERENCES task(id_task) ON DELETE CASCADE,
    CONSTRAINT fk_category_task_category FOREIGN KEY (id_category) REFERENCES category(id_category)
)ENGINE=innoDB;
