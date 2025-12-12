CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100)
);

INSERT INTO users (name, email) VALUES
('Max Muster', 'max@example.com'),
('Erika Beispiel', 'erika@example.com');
