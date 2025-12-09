<?php

namespace App\Services;

interface IServices {
    public function get(int $id): array;
    public function getAll(): array;
    public function create(array $data): array;
    public function update(int $id, array $data): array;
    public function delete(int $id): bool;
    public function destroy(int $id): bool;
    public function filter(array $filters, ?int $start = null, ?int $limit = null): array;
}