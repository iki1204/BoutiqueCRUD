<?php
class LoginController
{
    public function index(): void
    {
        render('login/index', [
            'title' => 'Acceso al Sistema',
        ]);
    }
}