<?php

namespace App\Services;



class UserService
{
    private $name;
    private $email;
    private $password;
    private $profile;
    private $errors = [];

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        if($name == ""){
           $this->errors["name"] = "the name must not be empty";
        }else if(!preg_match('/^[a-zA-Z]+$/', $name)){
            $this->errors["name"] = "the name must content just charachters";
        }else if(strlen($name) <= 3){
            $this->errors["name"] = "the name must be more than 3 chars";
        }else{
            $this->name = $name;
        }
    }

    // Getter and Setter for $email
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors["email"] = "the email is not valid";
        } else {
            $this->email = $email;
        }
    }

    // Getter and Setter for $password
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        if (strlen($password) < 8 || strlen($password) > 20) {
            $this->errors["password"][0] = "the password must be between 8 and 20";
        }

        if (!preg_match('/[A-Z]/', $password)) {
            $this->errors["password"][1] = "the password must contain at least 1 capital chars";
        }


        if (!preg_match('/[a-z]/', $password)) {
            $this->errors["password"][2] = "the password must contain at least 1 lower chars";
        }


        if (!preg_match('/[0-9]/', $password)) {
            $this->errors["password"][3] = "the password must contain at least 1 number";
        }


        if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            $this->errors["password"][4] = "the password must contain at least 1 special chars";
        }



        if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9])[\w\W]{8,20}$/', $password)){
            $this->password = $password;
        }


    }

    // Getter and Setter for $profile
    public function getProfile() {
        return $this->profile;
    }

    public function setProfile($profile) {
        if ($profile->hasFile('profile')) {
            $imagePath = $profile->file('profile')->store('images', 'public');
            $this->profile = $imagePath;
        }else{
            $this->errors["profile"] = "No profile image uploaded.";
        }
    }

    public function getValidationErrors(){
        return $this->errors;
    }

    public function validate($request){
        $this->setName($request->name);
        $this->setEmail($request->email);
        $this->setPassword($request->password);
        $this->setProfile($request);
        return $this->errors;
    }
}

