# API Documentation

## 1. Introduction

This document provides detailed information about the APIs available in the FitForm Innovations web application. The APIs facilitate functionalities such as caloric and macronutrient calculations, user registration, and account management.

## 2. API Endpoints

Base URL: `http://localhost` (or your deployed server address)

### 2.1. Caloric and Macro Nutritional Calculator

- **Endpoint**: `/controllers/calculate_calories.php`
- **Method**: POST
- **Description**: Calculates daily caloric needs based on user inputs.
- **Request Parameters**:
  - `age` (integer): Age of the user (must be between 16 and 80).
  - `gender` (string): Gender of the user (male or female).
  - `height` (float): Height of the user in centimeters.
  - `weight` (float): Weight of the user in kilograms.
  - `activity` (string): Activity level of the user (e.g., 1.2, 1.375, 1.55, 1.725, 1.9).
- **Response Format**:
  - **Success**:
    ```json
    {
      "status": "success",
      "calories": {
        "maintenance": 2500,
        "weightLoss": 2000,
        "muscleGain": 3000
      },
      "macros": {
        "protein": "150g",
        "carbs": "200g",
        "fats": "70g"
      }
    }
    ```
  - **Error**:
    ```json
    {
      "status": "error",
      "message": "Invalid input parameters."
    }
    ```

### 2.2. User Registration

- **Endpoint**: `/controllers/register_confirmation.php`
- **Method**: POST
- **Description**: Registers a new user account.
- **Request Parameters**:
  - `username` (string): Username for the account.
  - `email` (string): User's email address.
  - `password` (string): Password for the account (minimum 8 characters, including at least one special character).
  - `confirm_password` (string): Confirmation of the password.
  - `first_name` (string): User's first name.
  - `last_name` (string): User's last name.
- **Response Format**:
  - **Success**:
    ```json
    {
      "status": "success",
      "message": "User registered successfully."
    }
    ```
  - **Error**:
    ```json
    {
      "status": "error",
      "message": "Registration failed. Please check your input."
    }
    ```

### 2.3. User Login

- **Endpoint**: `/controllers/login.php` (if you add this in the future)
- **Method**: POST
- **Description**: Authenticates a user and provides a session.
- **Request Parameters**:
  - `username` (string): Username for the account.
  - `password` (string): Password for the account.
- **Response Format**:
  - **Success**:
    ```json
    {
      "status": "success",
      "message": "Login successful.",
      "user_id": "123",
      "token": "abcd1234" // If you choose to implement token-based authentication
    }
    ```
  - **Error**:
    ```json
    {
      "status": "error",
      "message": "Invalid username or password."
    }
    ```

## 3. Testing with Postman

To test these endpoints, you can use tools like Postman:

1. **Set Up Postman Collection**:
   - Create a collection with requests corresponding to each endpoint.
   - Include required headers and request bodies.

2. **Define Environment Variables**:
   - Configure variables for base URL and any other dynamic values.

3. **Execute and Validate**:
   - Send requests to the API endpoints.
   - Validate responses against the expected formats.

## 4. Error Handling

- **Common Errors**:
  - `400 Bad Request`: Invalid input parameters.
  - `401 Unauthorized`: Authentication failure.
  - `404 Not Found`: Endpoint does not exist.
  - `500 Internal Server Error`: Server-side issue.

## 5. Security Considerations

Ensure that sensitive information (like passwords) is handled securely:

- Use HTTPS for secure communication.
- Validate and sanitize user inputs to prevent injection attacks.