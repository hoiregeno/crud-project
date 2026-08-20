# PHP User CRUD

A simple CRUD (Create, Read, Update, Delete) app for managing users, built with PHP and MySQL.

## Features

- List all users in a table
- Add a new user
- Edit an existing user
- Delete a user
- Basic form validation and error messages

## Tech Stack

- PHP (mysqli, procedural)
- MySQL
- HTML / CSS (vanilla)

## Setup

1. Clone the repo into your local server directory (e.g. `htdocs` for XAMPP).
2. Create a database and table:

   ```sql
   CREATE DATABASE user_db;

   USE user_db;

   CREATE TABLE users (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(100) NOT NULL,
     email VARCHAR(100) NOT NULL,
     phone VARCHAR(20) NOT NULL,
     address TEXT NOT NULL
   );
   ```

3. Update `config.php` with your own database credentials.
4. Start Apache and MySQL, then visit `index.php` in your browser.

## Project Structure

```
├── index.php     # List all users
├── add.php       # Add-user form
├── edit.php      # Edit-user form
├── actions.php   # Handles insert / update / delete
├── config.php    # Database connection
└── style.css     # Styling
```

## Notes

This project doesn't use prepared statements or input sanitization yet — planned as a next step.
