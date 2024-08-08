# FitForm Innovations Deployment Guide

This guide provides detailed instructions for deploying the FitForm Innovations web application.

## Table of Contents
1. [Prerequisites](#prerequisites)
2. [Installation Steps](#installation-steps)
3. [Configuration](#configuration)
4. [Database Setup](#database-setup)
5. [Web Server Configuration](#web-server-configuration)
6. [SSL Setup (Optional)](#ssl-setup-optional)
7. [Final Checks](#final-checks)
8. [Launching the Application](#launching-the-application)
9. [Troubleshooting](#troubleshooting)
10. [Updating the Application](#updating-the-application)

## Prerequisites

Ensure you have the following installed:
- XAMPP (or similar PHP development environment)
- Git
- MySQL database (included with XAMPP)

## Installation Steps

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/fitform-innovations.git
    cd fitform-innovations
    ```
2. Move the project to your web server directory:
    ```bash
    mv fitform-innovations /path/to/xampp/htdocs/
    ```

## Configuration

1. **Navigate to the project's root directory:**
    ```bash
    cd /path/to/xampp/htdocs/fitform-innovations
    ```

2. **Update Database Connection Settings:**
    - The project uses a database connection class. Use Azure settings with SSL if required.
    ```

3. **Local Deployment:**
    - For local deployment, adjust the connection settings in the class to match your local database configuration. Update settings as needed for local deployments.
---


## Database Setup

1. Start Apache and MySQL services in XAMPP.
2. Open phpMyAdmin (usually at [http://localhost/phpmyadmin](http://localhost/phpmyadmin)).
3. Create a new database named `fitform_db`.
4. Import the SQL schema:
    - Locate `db_fitform_CreationQuery.sql` in the project folder.
    - In phpMyAdmin, select the `fitform_db` database.
    - Go to the "Import" tab and upload the SQL file.

## Web Server Configuration

1. Ensure Apache is configured to serve PHP files.
2. If using virtual hosts, add the following to your Apache configuration:
    ```apache
    <VirtualHost *:80>
        ServerName fitform.local
        DocumentRoot "/path/to/xampp/htdocs/fitform-innovations"
        <Directory "/path/to/xampp/htdocs/fitform-innovations">
            AllowOverride All
            Require all granted
        </Directory>
    </VirtualHost>
    ```
3. Add `fitform.local` to your hosts file:
    ```plaintext
    127.0.0.1 fitform.local
    ```

## SSL Setup (Optional)

1. Generate an SSL certificate using OpenSSL or obtain one from a certificate authority.
2. Configure Apache to use HTTPS:
    - Edit the Apache configuration file (`httpd-ssl.conf`).
    - Add your SSL certificate details.
    - Enable the SSL module in Apache.

## Final Checks

1. Set correct file permissions:
    ```bash
    chmod -R 755 /path/to/xampp/htdocs/fitform-innovations
    chmod -R 777 /path/to/xampp/htdocs/fitform-innovations/logs  # If applicable
    ```
2. Verify PHP extensions:
    - Open `php.ini` and ensure required extensions are enabled (e.g., `mysqli`, `pdo_mysql`).

## Launching the Application

1. Restart Apache and MySQL services.
2. Access the application at [http://fitform.local](http://fitform.local) or [http://localhost/fitform-innovations](http://localhost/fitform-innovations)

## Troubleshooting

- **Database Connection Issues:**
  - Verify database credentials in `config.php`.
  - Ensure MySQL service is running.

- **File Not Found Errors:**
  - Check file permissions.
  - Verify all paths in the application code.

- **Server Errors:**
  - Check Apache error logs (usually in XAMPP's logs directory).

## Updating the Application

To update the application:

1. Pull the latest changes:
    ```bash
    git pull origin main
    ```
2. Check for any new configuration requirements in `config.sample.php`.
3. Re-import the SQL file if there are database schema changes.
4. Clear any application caches.
5. Restart Apache.

For any additional help or issues, please refer to our GitHub Issues page or contact the development team.

This `DEPLOYMENT.md` file provides comprehensive instructions for deploying the FitForm Innovations project. It covers all the necessary steps from cloning the repository to launching the application, including database setup, configuration, and troubleshooting tips. You can place this file in the root directory of your project and link to it from your main `README.md` file.