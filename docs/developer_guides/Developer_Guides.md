# Developer Guide for FitForm Innovations

## 1. Introduction

This guide provides developers with the necessary information to modify, extend, or maintain the FitForm Innovations web application. It includes coding standards, best practices, and instructions on how to work with different parts of the application.

## 2. Project Structure

### 2.1. Directory Overview

- **`/public`**: Contains publicly accessible files such as images, CSS, and JavaScript.
  - **`/images`**: Image assets used in the application.
  - **`/css`**: CSS stylesheets for styling the application.
  - **`/js`**: JavaScript files for frontend functionality.
- **`/views`**: Contains view templates and HTML files.
  - **`/partials`**: Reusable partials like headers, footers, and sidebars.
  - **`/calories_form.html`**: Form for calorie calculations.
  - **`/calories_result.html`**: Results page for calorie calculations.
  - **`/register.php`**: User registration page.
- **`/controllers`**: Contains PHP scripts that handle user requests and interactions.
  - **`/calculate_calories.php`**: Script to process calorie calculation requests.
  - **`/calculate_macros.php`**: Script to process macronutrient calculation requests.
  - **`/register_confirmation.php`**: Script to handle user registration.
- **`/models`**: Contains PHP classes and business logic.
  - **`/Calorie_calculator_class.php`**: Class for performing calorie calculations.
- **`/config`**: Contains configuration files for database and application settings.
- **`/tests`**: Contains test scripts for unit and integration testing.

## 3. Coding Standards and Best Practices

### 3.1. Coding Standards

1. **PHP Coding Standards**:
   - Follow PSR-12 coding standards.
   - Use camelCase for variable names and method names.
   - Use PascalCase for class names.
   - Include meaningful comments and docblocks.

   ```php
   class CalorieCalculator {
       /**
        * Calculate daily caloric needs.
        *
        * @return int
        */
       public function calculateCalories() {
           // Code here...
       }
   }
2.	HTML/CSS:
o	Use semantic HTML5 elements.
o	Follow BEM (Block Element Modifier) methodology for CSS class names.
o	Ensure responsive design using media queries.
o	Avoid inline styles; use external stylesheets.
html
Copy code
<div class="cta-section">
    <h3 class="cta-section__title">Get your Calories</h3>
</div>
3.	JavaScript:
o	Use ES6+ syntax and features.
o	Avoid global variables; use modules or IIFE (Immediately Invoked Function Expressions).
o	Follow consistent naming conventions and use comments.
javascript
Copy code
// Function to validate form inputs
function validateForm() {
    // Validation logic...
}
3.2. Best Practices
1.	Version Control:
o	Use Git for version control.
o	Commit code changes with clear, descriptive messages.
o	Use feature branches for new development and bug fixes.
2.	Testing:
o	Write unit tests for critical business logic.
o	Perform integration testing for interactions between components.
o	Use PHPUnit for PHP testing and Jest for JavaScript testing.
3.	Security:
o	Validate and sanitize user inputs to prevent SQL injection and XSS attacks.
o	Use prepared statements for database queries.
o	Implement proper error handling and logging.
4.	Documentation:
o	Document code using PHPDoc for PHP classes and methods.
o	Maintain an updated README file with setup and usage instructions.
o	Keep API documentation up-to-date with changes to endpoints.
4. Extending the Application
4.1. Adding New Features
1.	Frontend:
o	Create new HTML files in the views directory for new pages.
o	Add new CSS rules in the public/css directory.
o	Add JavaScript functionality in the public/js directory.
2.	Backend:
o	Create new PHP classes in the models directory for additional business logic.
o	Add new controller scripts in the controllers directory.
o	Update existing forms and views to include new functionality.
3.	Database:
o	Update the database schema as needed.
o	Create new SQL migration scripts in the config directory.
o	Ensure compatibility with existing data.
4.2. Modifying Existing Functionality
1.	Update Business Logic:
o	Modify existing PHP classes in the models directory.
o	Ensure backward compatibility with existing features.
2.	Change User Interface:
o	Update HTML templates and CSS styles in the views and public/css directories.
o	Test changes across different devices and browsers.
3.	Adjust API Endpoints:
o	Modify or add new API endpoints in the controllers directory.
o	Update API documentation to reflect changes.
5. Development Environment Setup
5.1. Local Development
1.	Install XAMPP:
o	Download and install XAMPP from Apache Friends.
o	Start Apache and MySQL services from the XAMPP control panel.
2.	Set Up Project:
o	Place the project files in the htdocs directory within your XAMPP installation.
o	Access the application via http://localhost in your web browser.
3.	Configuration:
o	Update config/database.php with your local database credentials.
o	Ensure all dependencies are installed and configured.
5.2. Deployment
1.	Prepare for Deployment:
o	Ensure code is properly tested and reviewed.
o	Update environment variables and configuration files for production.
2.	Deploy to Server:
o	Upload files to the server using FTP/SFTP.
o	Configure server settings and deploy the application.
3.	Monitor and Maintain:
o	Monitor application performance and logs.
o	Regularly update and maintain the application.
6. Additional Resources
•	PHP Documentation: PHP Manual
•	HTML/CSS Standards: MDN Web Docs
•	JavaScript Guide: JavaScript Info
For any questions or further assistance, feel free to reach out to the development team or refer to the project's README and documentation.

