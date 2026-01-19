<?php
// check_models.php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$apiKey = env('GEMINI_API_KEY');
echo "API Key Length: " . strlen($apiKey) . "\n";

$url = "https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}";
$response = Illuminate\Support\Facades\Http::withoutVerifying()->get($url);

if ($response->successful()) {
    echo "Models Found:\n";
    foreach ($response->json('models', []) as $model) {
        if (strpos($model['name'], 'generateContent') !== false || strpos($model['supportedGenerationMethods'][0] ?? '', 'generateContent') !== false) {
             echo "- " . $model['name'] . "\n";
        }
    }
} else {
    echo "Error: " . $response->status() . "\n";
    echo $response->body() . "\n";
}
