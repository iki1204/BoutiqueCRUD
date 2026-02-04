<?php

declare(strict_types=1);

class BaseController
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = $view;
        require __DIR__ . '/../views/layout.php';
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}
