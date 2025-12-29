<?php

namespace App\Controllers;

interface IController {
    public function index();
    public function show(array $params);
    public function create();
    public function store();
    public function edit(array $params);
    public function update(array $params);
    public function delete(array $params);
    public function destroy(array $params);

}
