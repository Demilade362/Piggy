<?php

declare(strict_types=1);

use Framework\Http;

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


function redirect(string $path)
{
    header("Location: {$path}");
    http_response_code(Http::REDIRECT_STATUS_CODE);
    die();
}

function env(string $value)
{
    return $_ENV[$value];
}
