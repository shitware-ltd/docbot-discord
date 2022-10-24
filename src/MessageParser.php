<?php
namespace Docbot;

class MessageParser {
    protected $docs = [
                "artisan",
                "authentication",
                "authorization",
                "billing",
                "blade",
                "broadcasting",
                "cache",
                "cashier-paddle",
                "collections",
                "configuration",
                "console-tests",
                "container",
                "contracts",
                "contributions",
                "controllers",
                "csrf",
                "database-testing",
                "database",
                "deployment",
                "documentation",
                "dusk",
                "eloquent-collections",
                "eloquent-mutators",
                "eloquent-relationships",
                "eloquent-resources",
                "eloquent-serialization",
                "eloquent",
                "encryption",
                "envoy",
                "errors",
                "events",
                "facades",
                "filesystem",
                "fortify",
                "frontend",
                "hashing",
                "helpers",
                "homestead",
                "horizon",
                "http-client",
                "http-tests",
                "installation",
                "license",
                "lifecycle",
                "localization",
                "logging",
                "mail",
                "middleware",
                "migrations",
                "mix",
                "mocking",
                "notifications",
                "octane",
                "packages",
                "pagination",
                "passport",
                "passwords",
                "pint",
                "providers",
                "queries",
                "queues",
                "rate-limiting",
                "readme",
                "redirects",
                "redis",
                "releases",
                "requests",
                "responses",
                "routing",
                "sail",
                "sanctum",
                "scheduling",
                "scout",
                "seeding",
                "session",
                "socialite",
                "starter-kits",
                "structure",
                "telescope",
                "testing",
                "upgrade",
                "urls",
                "valet",
                "validation",
                "verification",
                "views",
                "vite",
            ];

    public function __invoke($message)
    {
        $content = strtolower($message->content);

        // Grab the first 4 chars for our trigger
        $trigger = substr($content, 0, 5);

        // Grab everything after the first 5 chars
        $query = substr($content, 5);

        // Check if version is available in command
        $pattern = '/\b([6-9]\.x)\b/'; // only match 6.x to 9.x
        preg_match($pattern, $query, $matches);
        if ($version = $matches[0] ?? "9.x") // default to 9.x if no version is given
            $query = preg_replace($pattern, '', $query);

        $query = trim($query);

        if($trigger === "docs ")
        {
            if(in_array($query, $this->docs)){

                return "<https://laravel.com/docs/$version/$query>";
            }
        }

        return false;
    }
}