<?php

namespace App\Services;

interface IServices {
    public function get(int $id);
    public function getAll();
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id): bool;
    public function destroy(int $id): bool;
}
