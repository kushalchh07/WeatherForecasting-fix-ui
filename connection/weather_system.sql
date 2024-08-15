CREATE TABLE users (
  uid int(11) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
);

INSERT INTO users (uid, email, password) VALUES
(1, 'admin@test.com', '7c222fb2927d828af22f592134e8932480637c0d'); 
-- used sha1 hashing function password admin123

show tables;  

 Select * from users;  
ALTER TABLE users
ADD username VARCHAR(20);
