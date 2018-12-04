<?php
$app->group('', function (){
    //routers for user management
    $this->group('/user', function (){
        //Add new User
        $this->post('/add', 'AuthController:postUser');
        //Post login
        $this->post('/login', 'AuthController:postLogin');
        //Check if user exists
        $this->post('/email/validate', 'AuthController:emailValidation');
        //Edit password
        $this->put('/password/change', 'PassController:postEditPassword');
    });
});

