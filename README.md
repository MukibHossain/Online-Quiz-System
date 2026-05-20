Online Quiz System
==================

A role-based web application for conducting online quizzes. Built with PHP and MySQL on the backend, Bootstrap 5 for responsive design, and JavaScript for client-side features like countdown timers. The UI follows a white and purple premium theme with background images and glassmorphism card effects.


Project Structure
-----------------

online_quiz_system/
├── index.php                   Landing page (Login / Register buttons)
├── config/
│   └── database.php            Database connection and session start
├── database/
│   └── db.sql                  Full schema with sample data
├── auth/
│   ├── login.php               Login form with role-based redirect
│   ├── register.php            Student self-registration
│   ├── logout.php              Session destroy and redirect
│   └── forgot_password.php     Password reset placeholder
├── admin/
│   ├── dashboard.php           Analytics overview with Chart.js
│   ├── quiz_management.php     Create and delete quizzes
│   ├── question_management.php Add and delete quiz questions
│   ├── user_management.php     View all registered users
│   └── reports.php             Result reports per quiz
├── student/
│   ├── dashboard.php           Student home with stats
│   ├── quiz_list.php           Browse available quizzes
│   ├── quiz_play.php           Take a quiz with countdown timer
│   ├── result.php              View latest result after submission
│   ├── leaderboard.php         Top scores across all quizzes
│   ├── certificate.php         Downloadable certificate on pass
│   └── profile.php             Edit name, email, and profile photo
├── includes/
│   ├── header.php              Shared navbar with role-aware links
│   └── footer.php              Shared footer
├── assets/
│   ├── style.css               Global custom styles
│   └── images/                 Background images for each page
├── ajax/                       AJAX handler scripts
├── exports/
│   └── excel_export.php        Export results to Excel (placeholder)
└── uploads/                    Stores user profile photo uploads


Tech Stack
----------

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Bootstrap 5.3
- Font Awesome 6.5
- Chart.js (admin dashboard charts)
- Vanilla JavaScript (countdown timer, auto-submit)


Database
--------

Database name: quiz_system_mukib

Tables:

  users         id, name, email, password, role (admin/student), photo
  quizzes       id, title, time_limit (in minutes)
  questions     id, quiz_id, question, option1-4, correct_answer
  results       id, user_id, quiz_id, score, total, created_at
  leaderboard   id, user_id, quiz_id, score


Installation
------------

1. Clone or extract the project into your web server's root directory.
   For XAMPP: C:/xampp/htdocs/online_quiz_system
   For WAMP:  C:/wamp64/www/online_quiz_system

2. Start Apache and MySQL from your control panel.

3. Open phpMyAdmin at http://localhost/phpmyadmin

4. Create a new database named:  quiz_system_mukib

5. Import the schema and sample data:
   Go to Import tab, choose database/db.sql, and click Go.

6. Open the project in your browser:
   http://localhost/online_quiz_system/

7. If your MySQL username or password is different from the default,
   edit config/database.php and update the credentials:

   new mysqli("localhost", "your_username", "your_password", "quiz_system_mukib");


Sample Login Credentials
------------------------

Admin accounts:
  Email: admin1@gmail.com   Password: admin123
  Email: admin2@gmail.com   Password: admin123

Student accounts:
  Email: rahim@gmail.com    Password: 123456
  Email: karim@gmail.com    Password: 123456
  Email: sakib@gmail.com    Password: 123456


Features
--------

Authentication
  - Student self-registration with email and password
  - Secure login with role detection (admin vs student)
  - Session-based access control on every page
  - Logout clears session and redirects to landing page

Admin Panel
  - Dashboard showing total users, quizzes, questions, and results with Chart.js graphs
  - Create new quizzes with title and time limit
  - Add multiple-choice questions (4 options) to any quiz
  - Delete quizzes and questions
  - View all registered users
  - Browse result reports per quiz

Student Panel
  - Personal dashboard with quiz attempt stats
  - Browse all available quizzes with time limits
  - Take a quiz with a live countdown timer that auto-submits on expiry
  - Each quiz can only be attempted once per student
  - View score and result immediately after submission
  - Global leaderboard showing top performers
  - Download a certificate on passing a quiz
  - Edit profile: name, email, and upload a profile photo


Known Limitations
-----------------

- No email functionality is implemented for forgot_password.php.
- The Excel export in exports/excel_export.php is a placeholder and not fully implemented.


Author
------

MukibHossain [Github: https://github.com/MukibHossain]