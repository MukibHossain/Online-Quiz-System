CREATE DATABASE IF NOT EXISTS quiz_system_mukib;

USE quiz_system_mukib;



DROP TABLE IF EXISTS leaderboard;
DROP TABLE IF EXISTS results;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS quizzes;
DROP TABLE IF EXISTS users;



CREATE TABLE users(

id INT AUTO_INCREMENT PRIMARY KEY,

name VARCHAR(100),

email VARCHAR(100) UNIQUE,

password VARCHAR(255),

role VARCHAR(20),

photo VARCHAR(255)

);



CREATE TABLE quizzes(

id INT AUTO_INCREMENT PRIMARY KEY,

title VARCHAR(100),

time_limit INT

);



CREATE TABLE questions(

id INT AUTO_INCREMENT PRIMARY KEY,

quiz_id INT,

question TEXT,

option1 VARCHAR(255),

option2 VARCHAR(255),

option3 VARCHAR(255),

option4 VARCHAR(255),

correct_answer VARCHAR(255)

);



CREATE TABLE results(

id INT AUTO_INCREMENT PRIMARY KEY,

user_id INT,

quiz_id INT,

score INT,

total INT,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);



CREATE TABLE leaderboard(

id INT AUTO_INCREMENT PRIMARY KEY,

user_id INT,

quiz_id INT,

score INT

);



INSERT INTO users(

name,
email,
password,
role

)

VALUES


(
'Admin One',
'admin1@gmail.com',
'admin123',
'admin'
),

(
'Admin Two',
'admin2@gmail.com',
'admin123',
'admin'
),


(
'Rahim',
'rahim@gmail.com',
'123456',
'student'
),

(
'Karim',
'karim@gmail.com',
'123456',
'student'
),

(
'Sakib',
'sakib@gmail.com',
'123456',
'student'
),

(
'Nafis',
'nafis@gmail.com',
'123456',
'student'
),

(
'Mim',
'mim@gmail.com',
'123456',
'student'
);



INSERT INTO quizzes(

title,
time_limit

)

VALUES


(
'Math Quiz',
10
),

(
'Python Quiz',
15
),

(
'AI Quiz',
20
);



INSERT INTO questions(

quiz_id,
question,
option1,
option2,
option3,
option4,
correct_answer

)

VALUES


(
1,
'2 + 2 = ?',
'3',
'4',
'5',
'6',
'4'
),

(
1,
'10 / 2 = ?',
'3',
'5',
'7',
'9',
'5'
),


(
2,
'Python creator?',
'Guido',
'Elon',
'Bill',
'Mark',
'Guido'
),

(
2,
'Python extension?',
'.java',
'.py',
'.cpp',
'.html',
'.py'
),


(
3,
'AI stands for?',
'Artificial Intelligence',
'Auto Input',
'App Interface',
'None',
'Artificial Intelligence'
);



INSERT INTO leaderboard(

user_id,
quiz_id,
score

)

VALUES


(
3,
1,
95
),

(
4,
1,
90
),

(
5,
2,
88
),

(
6,
3,
85
),

(
7,
2,
80
);