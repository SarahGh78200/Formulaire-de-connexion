<?php

namespace App\Models;

use PDO;
use Config\DataBase;

class User
{
    protected ?int $id;
    protected ?string $surname;
    protected ?string $name;
    protected ?string $birth_date;
    protected ?string $password;
    protected int|string|null $id_role;
    protected ?string $email;

    public function __construct(?int $id, ?string $surname, ?string $name, ?string $birth_date, ?string $password, int|string|null $id_role, ?string $email)
    {
        $this->id = $id;
        $this->surname = $surname;
        $this->name = $name;
        $this->birth_date = $birth_date;
        $this->password = $password;
        $this->id_role = $id_role;
        $this->email = $email;
    }

    public function save(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "INSERT INTO user (id, surname, name, birth_date, password, id_role, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $pdo->prepare($sql);

        return $statement->execute([
            $this->id,
            $this->surname,
            $this->name,
            $this->birth_date,
            $this->password,
            $this->id_role,
            $this->email,
        ]);
    }

    public static function findByEmail(string $email): ?User {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM user WHERE email = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$email]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            return new User($row['id'],  $row['surname'], $row['name'],$row['password'],$row['birth_date'], $row['id_role'], $row['email']  
            );
        }
        return null; // Retourne null si aucun utilisateur n'a été trouvé
    }
    

    public function login($email)
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM user WHERE email = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$email]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if ($row['id_role'] == 1) {
                return new UserAdmin($row['id'], $row['surname'], $row['name'], $row['birth_date'], $row['password'], $row['id_role'], $row['email']);
            } elseif ($row['id_role'] == 2) {
                return new UserClient($row['id'], $row['surname'], $row['name'], $row['birth_date'], $row['password'], $row['id_role'], $row['email']);
            }
        }
        return null;  // Aucun utilisateur trouvé
    }

    public function getClient()
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT id, surname, name FROM user WHERE id_role = 2";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $resultClients = $statement->fetchAll(PDO::FETCH_ASSOC);
        $clients = [];

        foreach ($resultClients as $row) {
            $client = new User($row['id'], $row['surname'], $row['name'], null, null, null, null);
            $clients[] = $client;
        }
        return $clients;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
    public function getSurname(): ?string
    {
        return $this->surname;
    }
    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }
    public function getBirthDate(): ?string
    {
        return $this->birth_date;
    }
    public function setBirthDate(?string $birth_date): void
    {
        $this->birth_date = $birth_date;
    }
    public function getIdRole(): int|string|null
    {
        return $this->id_role;
    }
    public function setIdRole(int|string|null $id_role): void
    {
        $this->id_role = $id_role;
    }
    public function getfindByEmail(): ?string
    {
        return $this->email;
    }
    public function setffindByEmail(?string $email): void
    {
        $this->email = $email;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
}
