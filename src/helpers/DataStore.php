<?php

namespace App\Helpers;

/**
 * DataStore — CRUD pe fisiere JSON
 * Va fi inlocuit cu ORM/DB in Etapa 18
 */
class DataStore
{
    private string $file;
    private array $data;

    public function __construct(string $filename)
    {
        $this->file = ROOT_PATH . '/data/' . $filename . '.json';
        $this->load();
    }

    private function load(): void
    {
        if (file_exists($this->file)) {
            $json = file_get_contents($this->file);
            $this->data = json_decode($json, true) ?: [];
        } else {
            $this->data = [];
        }
    }

    private function save(): void
    {
        $dir = dirname($this->file);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents(
            $this->file,
            json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            LOCK_EX
        );
    }

    /**
     * Returneaza toate inregistrarile
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * Gaseste dupa ID
     */
    public function find(int $id): ?array
    {
        foreach ($this->data as $item) {
            if (($item['id'] ?? 0) === $id) {
                return $item;
            }
        }
        return null;
    }

    /**
     * Gaseste dupa slug
     */
    public function findBySlug(string $slug): ?array
    {
        foreach ($this->data as $item) {
            if (($item['slug'] ?? '') === $slug) {
                return $item;
            }
        }
        return null;
    }

    /**
     * Filtreaza dupa un camp
     */
    public function where(string $field, mixed $value): array
    {
        return array_values(array_filter($this->data, fn($item) => ($item[$field] ?? null) === $value));
    }

    /**
     * Returneaza sortate dupa camp
     */
    public function orderBy(string $field = 'sort_order', string $dir = 'asc'): array
    {
        $data = $this->data;
        usort($data, function ($a, $b) use ($field, $dir) {
            $va = $a[$field] ?? 0;
            $vb = $b[$field] ?? 0;
            return $dir === 'asc' ? $va <=> $vb : $vb <=> $va;
        });
        return $data;
    }

    /**
     * Numara inregistrarile
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * Numara cu filtru
     */
    public function countWhere(string $field, mixed $value): int
    {
        return count($this->where($field, $value));
    }

    /**
     * Urmatorul ID disponibil
     */
    public function nextId(): int
    {
        $maxId = 0;
        foreach ($this->data as $item) {
            $maxId = max($maxId, $item['id'] ?? 0);
        }
        return $maxId + 1;
    }

    /**
     * Creeaza inregistrare noua
     */
    public function create(array $item): array
    {
        $item['id'] = $this->nextId();
        $now = date('Y-m-d H:i:s');
        $item['created_at'] = $item['created_at'] ?? $now;
        $item['updated_at'] = $now;
        $this->data[] = $item;
        $this->save();
        return $item;
    }

    /**
     * Actualizeaza inregistrare existenta
     */
    public function update(int $id, array $fields): ?array
    {
        foreach ($this->data as &$item) {
            if (($item['id'] ?? 0) === $id) {
                foreach ($fields as $k => $v) {
                    $item[$k] = $v;
                }
                $item['updated_at'] = date('Y-m-d H:i:s');
                $this->save();
                return $item;
            }
        }
        return null;
    }

    /**
     * Sterge inregistrare
     */
    public function delete(int $id): bool
    {
        $count = count($this->data);
        $this->data = array_values(array_filter($this->data, fn($item) => ($item['id'] ?? 0) !== $id));
        if (count($this->data) < $count) {
            $this->save();
            return true;
        }
        return false;
    }

    /**
     * Actualizeaza ordinea (array de [id => sort_order])
     */
    public function reorder(array $order): void
    {
        foreach ($this->data as &$item) {
            $id = $item['id'] ?? 0;
            if (isset($order[$id])) {
                $item['sort_order'] = (int) $order[$id];
            }
        }
        $this->save();
    }

    /**
     * Verifica daca un slug exista (exclude un ID optional)
     */
    public function slugExists(string $slug, ?int $excludeId = null): bool
    {
        foreach ($this->data as $item) {
            if (($item['slug'] ?? '') === $slug && ($item['id'] ?? 0) !== $excludeId) {
                return true;
            }
        }
        return false;
    }
}
