<?php

namespace App\Repository;

class UserRepository implements UserableRepository
{
    public function findAll(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'age' => 30,
            ],
            [
                'id' => 2,
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'age' => 25,
            ],
            [
                'id' => 3,
                'name' => 'Robert Brown',
                'email' => 'robert.brown@example.com',
                'age' => 28,
            ],
        ];
    }
}
