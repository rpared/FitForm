# FitForm Innovations

Welcome to FitForm Innovations, a web application designed to help you calculate your caloric and macronutrient needs based on your individual fitness goals. Whether you're looking to lose weight, gain muscle, or maintain your current weight, FitForm Innovations provides personalized recommendations to support your fitness journey.

## Table of Contents

- [Features](#features)
- [Getting Started](#getting-started)
- [Usage](#usage)
- [User Guides](#user-guides)
- [Developer Guides](#developer-guides)
- [FAQs](#faqs)
- [Contributing](#contributing)
- [License](#license)

## Features

- **Caloric and Macro Nutritional Calculator**: Calculates daily caloric needs and macronutrient distribution based on user inputs.
- **User Account Management (Optional)**: Allows users to create accounts and track their progress over time.
- **Progress Tracking (Optional)**: Enables users to log their weight and caloric intake to monitor their fitness journey.

## Getting Started

To run FitForm Innovations locally:

1. **Clone the Repository**:
    ```bash
    git clone https://github.com/yourusername/fitform-innovations.git
    cd fitform-innovations
    ```

2. **Install Dependencies**:
   Make sure you have XAMPP installed. Place the project folder in the `htdocs` directory of XAMPP.

3. **Set Up the Database**:   
   - Create a new database (e.g., `fitform_db`).
   - Import the SQL schema file located in `db_fitform_CreationQuery.sql` to set up the database tables.

4. **Configure Your Environment**:
   - Update any necessary configurations  to match your local setup.

5. **Run the Application**:
   - Start Apache and MySQL through the XAMPP control panel.
   - Access the application at [http://localhost/fitform](http://localhost/FitForm/).

## Usage

1. **Access the Calculator**:
   - Go to the main page at [http://localhost/fitform](http://localhost/FitForm/).
   - Use the provided forms to input your weight, height, age, gender, activity level, and fitness goals.

2. **View Results**:
   - Submit the form to get your daily caloric needs and macronutrient breakdown.
   - If registered, you can log and track your progress through your account.


## User Guides

For detailed instructions on how to use the application, see [User Guides](docs/user_guides/User_Guides.md).

## Developer Guides

If you wish to modify or extend the application, refer to [Developer Guides](docs/developer_guides/Developer_Guides.md) for information on coding standards and best practices.

## FAQs

Find answers to common questions in the [FAQs](docs/faqs/FAQs.md) document.

## Contributing

We welcome contributions to improve FitForm Innovations. If you’d like to contribute:
1. Fork the repository.
2. Create a new branch for your changes.
3. Submit a pull request with a description of your changes.


## License

FitForm Innovations is licensed under the MIT License.