<?php

namespace App\Services;

interface IServices {
    public function get(int $id): array;
    public function getAll(): array;
    public function create(array $data): array;
    public function update(int $id, array $data): array;
    public function delete(int $id): array;
    public function destroy(int $id): array;
    public function datatables(array $filters, int $start, int $length, int $draw): array;
    public function format(array $data): array;

}