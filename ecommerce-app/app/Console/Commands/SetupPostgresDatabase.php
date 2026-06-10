<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use PDO;
use PDOException;

class SetupPostgresDatabase extends Command
{
    protected $signature = 'db:setup-postgres';

    protected $description = 'Create the bilal PostgreSQL database on Railway and run migrations';

    public function handle(): int
    {
        $host = env('DB_PUBLIC_HOST') ?: env('DB_HOST');
        $port = env('DB_PORT', '5432');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE', 'bilal');
        $adminDatabase = env('DB_ADMIN_DATABASE', 'railway');

        if (! $host || ! $username) {
            $this->error('DB_HOST and DB_USERNAME must be set in .env');

            return self::FAILURE;
        }

        try {
            $pdo = new PDO(
                "pgsql:host={$host};port={$port};dbname={$adminDatabase}",
                $username,
                $password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
            );
        } catch (PDOException $exception) {
            $this->error('PostgreSQL bağlantısı kurulamadı: '.$exception->getMessage());
            $this->line('Yerel geliştirmede Railway Public TCP Proxy host adresini DB_PUBLIC_HOST olarak .env dosyasına ekleyin.');

            return self::FAILURE;
        }

        $exists = $pdo->query(
            "SELECT 1 FROM pg_database WHERE datname = ".$pdo->quote($database)
        )->fetchColumn();

        if ($exists) {
            $this->info("Veritabanı zaten mevcut: {$database}");
        } else {
            $pdo->exec("CREATE DATABASE \"{$database}\" ENCODING 'UTF8'");
            $this->info("Veritabanı oluşturuldu: {$database}");
        }

        $this->info('Migration çalıştırılıyor...');

        Artisan::call('migrate', ['--force' => true]);
        $this->output->write(Artisan::output());

        $this->info('Kurulum tamamlandı.');

        return self::SUCCESS;
    }
}
