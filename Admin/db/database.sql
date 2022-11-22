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
INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `status`, `created_date`, `updated_date`) VALUES (NULL, 'admintesla', 'admin@tesla.com', '+128765432109', 'bbc673f2c98aa0c47f2a2afe76ba8918', '1', NULL, NULL);
-- Admin Credential
-- User name :- admintesla
-- Password :- tesla@123
CREATE TABLE blog_categary(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) UNIQUE,
	status int(6),
	created_by_id BIGINT,
	created_date VARCHAR(255),
	updated_date VARCHAR(255),
	FOREIGN KEY (created_by_id) REFERENCES users(id)
);

CREATE TABLE blog_post(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	category_id BIGINT(255),
	title VARCHAR(255) UNIQUE,
	content LONGTEXT,
	image VARCHAR(255),
	created_by_id BIGINT,
	created_date VARCHAR(255),
	updated_date VARCHAR(255),
	status int(6),
	FOREIGN KEY (category_id) REFERENCES blog_categary(id),
	FOREIGN KEY (created_by_id) REFERENCES users(id)
);

CREATE TABLE blog_files(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	blog_id BIGINT(255),
	title VARCHAR(255) UNIQUE,
	content LONGTEXT,
	image VARCHAR(255),
	created_by_id BIGINT,
	created_date VARCHAR(255),
	updated_date VARCHAR(255),
	status int(6),
	FOREIGN KEY (blog_id) REFERENCES blog_post(id),
	FOREIGN KEY (created_by_id) REFERENCES users(id)
);

CREATE TABLE blog_comment(
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	blog_id BIGINT,
	name VARCHAR(255),
	email VARCHAR(255),
	content LONGTEXT,
	created_by_id BIGINT,
	created_date VARCHAR(255),
	updated_date VARCHAR(255),
	status int(6),
	FOREIGN KEY (blog_id) REFERENCES blog_post(id),
	FOREIGN KEY (created_by_id) REFERENCES users(id)
);
