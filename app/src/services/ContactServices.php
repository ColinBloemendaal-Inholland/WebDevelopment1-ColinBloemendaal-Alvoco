<?php
namespace App\Services;

use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContactServices implements IServices {
    use SoftDeletes;
    private ContactRepository $contactRepository;

    public function __construct()
    {
        $this->contactRepository = new ContactRepository(new Contact());
    }

    public function verstuurContactFormulier(array $data)
    {
        return $this->contactRepository->create($data);
    }
    public function getAll()
    {
        return $this->contactRepository->getAll();
    }

    public function get(int $id)
    {
        return $this->contactRepository->get($id);
    }
    public function update(int $id, array $data)
    {
        return $this->contactRepository->update($id, $data);
    }
    public function delete(int $id): bool
    {
        return $this->contactRepository->delete($id);
    }
    public function destroy(int $id): bool
    {
        return $this->contactRepository->destroy($id);
    }
    public function create(array $data)
    {
        return $this->contactRepository->create($data);
    }
}
