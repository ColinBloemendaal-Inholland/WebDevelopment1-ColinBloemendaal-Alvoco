<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository extends BaseRepository implements IBaseRepository
{
	public function __construct()
	{
		parent::__construct(new Contact());
	}
	// Voeg hier eventueel extra contact-specifieke methodes toe
}
