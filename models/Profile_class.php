<?php

class Profile {

private $weight;
private $height;
private $age;
private $activity_level;
private $desired_objective;

public function __construct($age, $gender, $height, $weight, $activity_level, $desired_objective) {

  $this->age = $age;
  $this->gender = $gender;
  $this->height = $height;
  $this->weight = $weight;
  $this->activity_level = $activity_level;
  $this->desired_objective = $desired_objective;
}

// Getters for each attribute

public function getWeight() {
  return $this->weight;
}

public function getHeight() {
  return $this->height;
}

public function getAge() {
  return $this->age;
}

public function getGender() {
  return $this->gender;
}

public function getActivityLevel() {
  return $this->activity_level;
}

public function getDesiredObjective() {
  return $this->desired_objective;
}

// Setters for each attribute (optional, need validation)
public function setWeight($weight) {
  $this->weight = $weight;
}

public function setHeight($height) {
  $this->height = $height;
}

public function setAge($age) {
  $this->age = $age;
}

public function setActivityLevel($activity_level) {
  $this->activity_level = $activity_level;
}

public function setDesiredObjective($desired_objective) {
  $this->desired_objective = $desired_objective;
}
}

?>