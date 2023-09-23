<?php

declare(strict_types=1);

function dd(mixed $value): mixed
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function htmlChars(string $value): string
{
    return htmlspecialchars((string) $value);
}

function abort(string $message, int $status)
{
    throw new \Exception(message: $message, code: $status);
}


function redirect(string $path, int $statusCode = 302)
{
    header("Location: {$path}");
    http_response_code($statusCode);
    exit();
}
