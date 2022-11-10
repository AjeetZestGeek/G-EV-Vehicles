CREATE DATABASE gevvehicles;

CREATE TABLE users(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) UNIQUE,
	email VARCHAR(255) UNIQUE,
	phone VARCHAR(255) UNIQUE,
	password VARCHAR(255),
	status int(6),
	created_date VARCHAR(255),
	updated_date VARCHAR(255)
);