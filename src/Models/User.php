<?php

namespace App\Models;

use PDO;
use Config\DataBase;

class User
{
    protected ?int $id;
    protected ?string $name;
    protected ?string $surname;
    protected ?string $email;
    protected ?string $password;
    protected ?string $birth_date;
    protected int|string|null $id_role;

    public function __construct(?int $id, ?string $name, ?string $surname, ?string $email, ?string $password, ?string $birth_date, int|string|null $id_role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->birth_date = $birth_date;
        $this->id_role = $id_role;
    }

    public function save(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "INSERT INTO user (surname, name, email, password, id_role, birth_date) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $pdo->prepare($sql);

        return $statement->execute([
            $this->surname,
            $this->name,
            $this->email,
            $this->password,
            $this->id_role,
            $this->birth_date
        ]);
    }

    public function login($email)
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM `user` WHERE `email` = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$email]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            if ($row['id_role'] == 1) {
                return new UserAdmin($row['id'], $row['name'], $row['surname'], $row['email'], $row['password'],$row['birth_date'], $row['id_role']);
            } elseif ($row['id_role'] == 2) {
                return new UserClient($row['id'], $row['name'], $row['surname'], $row['email'], $row['password'],$row['birth_date'], $row['id_role']);
            }
        }
        return null;  // Aucun utilisateur trouvé
    }

    public function getClient()
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT `user`.`id`, `user`.`name`, `user`.`surname` FROM `user` WHERE `user`.`id_role` = 2";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $resultKids = $statement->fetchAll(PDO::FETCH_ASSOC);
        $kids = [];

        foreach ($resultKids as $row) {
            $kid = new User($row['id'], $row['name'], $row['surname'], null, null, null, null);
            $kids[] = $kid;
        }
        return $kids;
    }

    // Getters et Setters...

}
