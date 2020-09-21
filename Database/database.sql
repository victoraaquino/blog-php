CREATE DATABASE blog;

USE blog;

CREATE TABLE author (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE post (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author_id INT NOT NULL,
    text TEXT NOT NULL,
    time DATETIME NOT NULL,
    FOREIGN KEY (author_id) REFERENCES author(id)
);

CREATE TABLE tag (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE post_tag (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (post_id) REFERENCES post(id),
    FOREIGN KEY (tag_id) REFERENCES tag(id)
);

-- Tags pré existentes
INSERT INTO tag (name) VALUES ("Games");
INSERT INTO tag (name) VALUES ("Animes");
INSERT INTO tag (name) VALUES ("Heróis");
INSERT INTO tag (name) VALUES ("Mangá");
INSERT INTO tag (name) VALUES ("HQ");