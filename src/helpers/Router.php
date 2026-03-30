<?php

namespace App\Helpers;

class Router
{
    private array $routes = [];
    private array $matchedParams = [];
    private ?array $matchedRoute = null;

    public function __construct()
    {
        $this->routes = require __DIR__ . '/../config/routes.php';
    }

    /**
     * Rezolva ruta curenta pe baza URL-ului
     */
    public function resolve(string $uri): ?array
    {
        $uri = $this->cleanUri($uri);

        // 1. Cauta match exact
        if (isset($this->routes[$uri])) {
            $this->matchedRoute = $this->routes[$uri];
            $this->matchedParams = [];
            return $this->matchedRoute;
        }

        // 2. Cauta match cu parametri dinamici
        foreach ($this->routes as $pattern => $route) {
            if (strpos($pattern, '{') === false) {
                continue;
            }

            $regex = $this->patternToRegex($pattern);
            if (preg_match($regex, $uri, $matches)) {
                // Extrage parametrii numiti
                preg_match_all('/\{(\w+)\}/', $pattern, $paramNames);
                $params = [];
                foreach ($paramNames[1] as $i => $name) {
                    $params[$name] = $matches[$i + 1];
                }

                $this->matchedRoute = $route;
                $this->matchedParams = $params;
                return $this->matchedRoute;
            }
        }

        return null;
    }

    /**
     * Returneaza parametrii rutei gasite
     */
    public function getParams(): array
    {
        return $this->matchedParams;
    }

    /**
     * Returneaza ruta gasita
     */
    public function getRoute(): ?array
    {
        return $this->matchedRoute;
    }

    /**
     * Converteste un pattern de ruta in regex
     */
    private function patternToRegex(string $pattern): string
    {
        $regex = preg_replace('/\{(\w+)\}/', '([a-zA-Z0-9\-_]+)', $pattern);
        return '#^' . $regex . '$#';
    }

    /**
     * Curata URI-ul de query string si trailing slash
     */
    private function cleanUri(string $uri): string
    {
        $uri = parse_url($uri, PHP_URL_PATH) ?: '/';
        $uri = rtrim($uri, '/') ?: '/';
        return $uri;
    }
}
