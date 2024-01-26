<?php





class UserManager
{



    private array $users = [];




    public function __construct(private PDO $db)
    {

        $this->db = $db;
    }

    public function getUsers(): array
    {
        return $this->users;
    }
    public function setUsername(string $users): void
    {
        $this->users = $users;
    }

    public function getDb(): PDO
    {
        return $this->db;
    }
    public function setDb(string $db): void
    {
        $this->db = $db;
    }

    public function loadUsers(): void
    {
        try {
            $selctQuery = $this->db->prepare('SELECT * FROM users');
            $selctQuery->execute();
            $usersDatas = $selctQuery->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }

        $myUsers = [];

        foreach ($usersDatas as $key => $usersData) {
            $user = new User($usersData['username'], $usersData['password'], $usersData['email'], $usersData['role']);
            $myUsers[] = $user;
            $user->setID($usersData['id']);
        }
        $this->users = $myUsers;
    }

    public function saveUser(object $user): void
    {
        try {
            $saveQuery = $this->db->prepare('INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)');
            $parameters = [
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'role' => $user->getRole(),
            ];
            $saveQuery->execute($parameters);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function deleteUser(int $id): void
    {
        try {
            $deleteQuery = $this->db->prepare('DELETE FROM `users` WHERE `users`.`id` = :id');
            $parameters = [
                'id' => $id
            ];
            $deleteQuery->execute($parameters);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
};
