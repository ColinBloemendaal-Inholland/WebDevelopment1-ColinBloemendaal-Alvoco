<?php

namespace App\Services;

use App\Models\Nieuwsberichten;
use App\Repositories\NieuwsberichtenRepository;

class NieuwsberichtenServices implements IServices
{
    private NieuwsberichtenRepository $repository;
    public function __construct(?NieuwsberichtenRepository $nieuwsberichtenRepository = null)
    {
        $this->repository = $nieuwsberichtenRepository ?? new NieuwsberichtenRepository(new Nieuwsberichten());
    }

    public function get(int $id) {
        return $this->repository->get($id) ?? null;
    }
    public function getAll() {
        $nieuwsberichten = $this->repository->getAll();
        foreach ($nieuwsberichten as $nieuwsbericht) {
            $nieuwsbericht['preview'] = $this->getPreview($nieuwsbericht, 200);
        }
        return $nieuwsberichten;
    }
    public function create(array $data) {
        return $this->repository->create($data) ?? null;
    }
    public function update(int $id, array $data) {
        return $this->repository->update($id, $data) ?? null;
    }
    public function delete(int $id): bool {
        return $this->repository->delete($id) ?? false;
    }
    public function destroy(int $id): bool {
        return $this->repository->destroy($id) ?? false;
    }
    public function filter(array $filters, ?int $start = null, ?int $limit = null): array {
        return $this->repository->filter($filters, $start, $limit);
    }

    public function datatable(array $filters, int $start, int $length, int $draw)
    {
        $result = $this->filter($filters, $start, $length);
        $formattedResults = $result['data']->map(function ($row) { return $this->format($row);})->toArray();
        return [
            "draw" => $draw,
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" => $result['recordsFiltered'],
            "data" => $formattedResults,
        ];
    }

    public function format($row)
    {
        $leden = $row->Authur->lid ?? null;
        return [
            'fullname' => $leden ? trim($leden->firstname . ' ' . $leden->middlename . ' ' . $leden->lastname) : null,
            'title' => $row->Title,
            'id' => $row->id,
        ];
    }

    public function getPreview($artikel, int $length = 200): string
    {
        $content = $artikel['Message'] ?? '';
        if (strlen($content) > $length) {
            return substr($content, 0, $length) . '...';
        }
        return $content;
    }

    public function getRecent(int $limit = 5)
    {
        $nieuwsberichten = $this->repository->getRecent($limit);
        foreach ($nieuwsberichten as $nieuwsbericht) {
            $nieuwsbericht['preview'] = $this->getPreview($nieuwsbericht, 200);
        }
        return $nieuwsberichten;
    }
}
