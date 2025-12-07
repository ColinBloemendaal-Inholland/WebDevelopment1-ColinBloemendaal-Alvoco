<?php 

namespace App\Controllers;

interface IController {
    public function index(): void;
    public function show(array $params): void;
    public function create(): void;
    public function store(): void;
    public function edit(array $params): void;
    public function update(): void;
    public function delete(array $params): void;
    public function destroy(array $params): void;

}