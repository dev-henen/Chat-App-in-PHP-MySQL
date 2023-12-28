# Chat App Readme

## Application Overview

Welcome to the Chat App! This messaging application is built using PHP, primarily targeting PHP 8 but designed to be compatible with PHP versions 5, 6, 7, and 8. The application works seamlessly with any MySQL Database that supports PHP 5 and above. The front end incorporates HTML5, CSS, and JavaScript to provide an interactive user experience. The codebase follows PHP Object-Oriented Programming (OOP) principles for a modular and organized structure.

## Key Features

- **Programming Paradigm:** The application is predominantly coded using PHP Object-Oriented Programming for a modular and organized codebase.

- **PHP Compatibility:** The app is designed to work on PHP 5, 6, 7, and 8, providing flexibility for different server environments.

- **User Authentication:**
  - Users can log in using existing accounts or sign up to create new accounts.
    - **Sample User Credentials:**
      - Email: johndoe@gmail.com, Password: 12345678
      - Email: janedoe@gmail.com, Password: 12345678
      - Email: doo@gmail.com, Password: 12345678
      - Email: james@gmail.com, Password: 12345678
      - Email: lady@gmail.com, Password: 12345678

- **Chat Features:**
  - Users can send and receive messages.
  - Send images within the chat.
  - Reply to messages.
  - View active status.

- **Profile Management:**
  - Users can update their profile information.
  - Change profile photo.

- **User Interaction:**
  - Users can add other users as friends.
  - Block/unblock friends.
  - Search for friends.

## Getting Started

1. Clone the repository to your local machine.
2. Configure the database information in the "config.php" file.
3. Ensure your server environment supports PHP 5, 6, 7, or 8.

## User Registration

New users can sign up by providing their email and choosing a password.

## Sample User Accounts

For testing purposes, you can use the following sample user accounts:

- **John Doe's Account:**
  - Email: johndoe@gmail.com
  - Password: 12345678

- **Jane Doe's Account:**
  - Email: janedoe@gmail.com
  - Password: 12345678

- **Doo's Account:**
  - Email: doo@gmail.com
  - Password: 12345678

- **James's Account:**
  - Email: james@gmail.com
  - Password: 12345678

- **Lady's Account:**
  - Email: lady@gmail.com
  - Password: 12345678

## Application Features

Explore the following features:

- **Chat:**
  - Send and receive messages.
  - Share images.
  - Reply to messages.
  - View active status.

- **Profile:**
  - Update profile information.
  - Change profile photo.

- **User Interaction:**
  - Add friends.
  - Block/unblock friends.
  - Search for friends.

## Database Configuration

Ensure the correct database information is set in the "config.php" file to establish a connection with the MySQL database.

```php
// config.php

$host = "your_database_host";
$username = "your_database_username";
$password = "your_database_password";
$database = "your_database_name";
```

## Disclaimer

This application is designed for educational and testing purposes. Implement security measures before deploying for real-world use. Enjoy chatting!