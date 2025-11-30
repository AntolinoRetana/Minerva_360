<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;

class SupabaseStorageService
{
    protected $client;
    protected $url;
    protected $key;
    protected $bucket;

    public function __construct()
    {
        $this->client = new Client(['verify' => false]);
        $this->url    = rtrim(config('services.supabase.url'), '/');
        $this->key    = config('services.supabase.key');
        $this->bucket = config('services.supabase.bucket');
    }

    /**
     * Sube un archivo a Supabase y retorna la URL pública.
     */
    public function upload(UploadedFile $file, string $path): string
    {
        $endpoint = "{$this->url}/storage/v1/object/{$this->bucket}/{$path}";

        // Subir archivo
        $this->client->post($endpoint, [
            'headers' => [
                'apikey'        => $this->key,
                'Authorization' => "Bearer {$this->key}",
                'Content-Type'  => $file->getClientMimeType(),
            ],
            'body' => fopen($file->getRealPath(), 'r'),
        ]);

        // Retornar URL pública
        return "{$this->url}/storage/v1/object/public/{$this->bucket}/{$path}";
    }
}
