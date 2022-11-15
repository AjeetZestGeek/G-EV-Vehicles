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