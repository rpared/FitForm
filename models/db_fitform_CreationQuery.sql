CREATE database db_fitform;

USE db_fitform;
CREATE TABLE Users (
  user_id INT NOT NULL AUTO_INCREMENT,  -- Auto-incrementing primary key
  username VARCHAR(255) NOT NULL UNIQUE, -- Username (unique)
  password VARCHAR(255) NOT NULL,  -- Password
  email VARCHAR(255) NOT NULL UNIQUE, -- Email (unique)
  first_name VARCHAR(255) NOT NULL,  -- User's first name
  last_name VARCHAR(255) NOT NULL,  -- User's last name
  PRIMARY KEY (user_id)  -- Define user_id as the primary key
);

CREATE TABLE Profiles (
  profile_id INT NOT NULL AUTO_INCREMENT,  -- Auto-incrementing primary key
  user_id INT NOT NULL,  -- Foreign key referencing User.user_id
  age INT NOT NULL, -- Age
  gender ENUM('Male', 'Female'),  -- User's gender
  height DECIMAL(5, 2) NOT NULL,  -- Height in decimal format
  weight DECIMAL(5, 2) NOT NULL,  -- Weight in decimal format
  activity_level ENUM('Sedentary', 'Lightly Active', 'Moderately Active', 'Very Active', 'Extremely Active'),  -- Activity level with various options
  desired_objective ENUM('Weight Loss', 'Muscle Gain', 'Maintain Weight'),  -- Desired objective with various options
  PRIMARY KEY (profile_id),  -- Define profile_id as the primary key
  FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE  -- Foreign key constraint referencing User table, with cascade delete on User record deletion
);

CREATE TABLE Statistics (
  stat_id INT NOT NULL AUTO_INCREMENT,  -- Auto-incrementing primary key, must be autofilled
  user_id INT NOT NULL,                 -- Foreign key referencing User.user_id, must be autofilled for the user
  date DATE NOT NULL,                   -- Date of the statistic, must be autofilled
  weight DECIMAL(6, 2) NOT NULL,        -- Weight KG in decimal format
  calorie_intake INT (5) NULL,          -- Calorie intake, not mandatory
  protein DECIMAL(5, 2) NULL, 			 -- Macro-nutrient: Protein (grams), not mandatory
  carbs DECIMAL(5, 2) NULL,  			 -- Macro-nutrient: Carbs (grams), not mandatory
  fats DECIMAL(5, 2) NULL,    			 -- Macro-nutrient: Fats (grams), must be automatically calculated to fit this: calorie_intake = carbs*4 + proteins*4 + fats*9
  PRIMARY KEY (stat_id),                 -- Define stat_id as the primary key
  FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE  -- Foreign key constraint referencing User table, with cascade delete on User record deletion
);

-- Avoid any insertion operations as they are not validated, only use prepared statements!
-- The following are just for testing purposes

-- Inserting 2 users
-- INSERT INTO User (username, password, email, first_name, last_name)
-- VALUES ("roger", "secure_password123", "somemail@example.com", "Roger", "Paredes");

-- INSERT INTO User (username, password, email, first_name, last_name)
-- VALUES ("jane_smith", "another_secure_password", "jane.smith@example.com", "Jane", "Smith");

-- SELECT * FROM User;

-- -- Insert profile data for "roger" using the user ID
-- INSERT INTO Profile (user_id, age, gender, height, weight, activity_level, desired_objective)
-- VALUES (1, 41, "Male", 172.00, 65.00, 'Moderately Active', 'Muscle Gain');

-- INSERT INTO Profile (user_id, age, gender, height, weight, activity_level, desired_objective)
-- VALUES (2, 28, "Female", 158.00, 66.00, 'Lightly Active', 'Weight Loss');


-- SELECT * FROM Profile;

-- -- Insert statistics data for "roger" using the user ID

-- INSERT INTO Statistics (user_id, date, weight, calorie_intake, protein)
-- VALUES (1, '2024-07-12', 65.00, 2700, 100);

-- INSERT INTO Statistics (user_id, date, weight, calorie_intake)
-- VALUES (2, '2024-07-12', 62.00, 2500);

-- SELECT * FROM statistics;
