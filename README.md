# LearnHub – Student Learning and Academic Portal

A web-based Student Learning and Academic Portal developed using Laravel. LearnHub provides students with a centralized platform to manage their academic profiles, explore courses, enroll in available courses, and participate in academic discussions.

## Project Overview

The Student Learning and Academic Portal aims to organize student-related information and provide a simple, accessible environment for academic interaction.

The system integrates different database relationships, authentication, session management, and security features into one application.

## Features

### 1. User Authentication
- Student registration and login.
- Secure password hashing.
- Logout functionality.
- Login lockout after 5 consecutive failed attempts.
- Temporary 60-second lockout with a warning message.

### 2. Dashboard
- Personalized student welcome message.
- Overview of enrolled courses.
- Available course statistics.
- Discussion and student statistics.
- Recent discussions and quick navigation.

### 3. Course Management
- View available courses.
- Enroll in courses.
- Unenroll from courses.
- View currently enrolled courses.

### 4. Academic Discussions
- Create discussion posts.
- View discussions from other students.
- Open individual discussion pages.
- Add comments to discussions.
- Delete your own posts and comments.

### 5. Student Profile
- View and update student information.
- Update contact details.
- Manage phone information.

### 6. Security and Data Integrity
- Authentication middleware protects student pages.
- Guest middleware prevents authenticated users from accessing login and registration pages.
- Login rate limiting after five failed attempts.
- Submit buttons are disabled after submission to reduce accidental duplicate submissions.
- POST requests use redirects following the Post/Redirect/Get pattern.

## Database Relationships

The project demonstrates three major types of database relationships:

| Relationship | Models / Tables | Description |
|---|---|---|
| One-to-One | User, UserPhone, Phone | A user has one associated phone contact record. |
| One-to-Many | User, Post, Comment | A user can create multiple posts, and each post can have multiple comments. |
| Many-to-Many | Student, Course | A student can enroll in multiple courses, and a course can have multiple students. |

The many-to-many relationship uses the `course_student` pivot table.

## Technologies Used

- PHP
- Laravel 12
- MySQL
- HTML
- CSS
- JavaScript
- Blade Templates
- Tailwind CSS
- Vite
- Git and GitHub

## Installation and Setup

Follow these instructions to run the project on your local computer.

### Prerequisites
- PHP
- Composer
- Node.js and npm
- MySQL
- Git

### Step 1: Clone the Repository

```bash
git clone https://github.com/alanlabajo696-hub/student-learning-portal.git
cd student-learning-portal
```

### Step 2: Install Dependencies

```bash
composer install
npm install
```

### Step 3: Configure Environment

Create your environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### Step 4: Configure MySQL

Create a MySQL database named:

```text
student_learning_portal
```

Update the database settings in your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_learning_portal
DB_USERNAME=root
DB_PASSWORD=
```

Change the username and password if your MySQL configuration requires different credentials.

### Step 5: Run Migrations and Seeders

```bash
php artisan migrate --seed
```

This creates the required database tables and inserts the initial course and student records.

### Step 6: Build Frontend Assets

```bash
npm run build
```

### Step 7: Start the Application

```bash
php artisan serve
```

Open the application in your browser:

```text
http://127.0.0.1:8000
```

## Sample Seeded Account

The database seeder creates sample student accounts for testing.

| Email | Password |
|---|---|
| student1@example.com | Student123! |
| student2@example.com | Student123! |

**Security note:** These are demonstration credentials only. Change or remove seeded passwords before deploying the application publicly.

## Project Repository

GitHub: https://github.com/alanlabajo696-hub/student-learning-portal

## Developer

Developed as an academic project demonstrating Laravel development, database relationships, authentication, session management, and student-oriented web application functionality.

---

*LearnHub – Connecting Students, Courses, and Academic Discussions.*