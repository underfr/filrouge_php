<?php

namespace App\Model;
use App\Utils\Bdd;
class User
{
    private int $idUser;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;

    private \PDO $connexion;

    public function __construct(){
        $this->connexion= (new Bdd())->connectBDD();
    }

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    //Méthode hash pass
    public function hashPassword():void{
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }
    public function passwordVerify(string $hash):bool{
        return password_verify($this->password, $hash);
    }

    //SQL
    public function saveUser():User{
        try {
            $firstname = $this->firstname;
            $lastname = $this->lastname;
            $email = $this->email;
            $password = $this->password;
            $request = "INSERT INTO users (firstname,lastname,email,password) VALUE (?,?,?,?)";
            $req = $this->connexion;
            $sqlRequest = $req->prepare($request);
            $sqlRequest->bindParam(1,$firstname, \PDO::PARAM_STR);
            $sqlRequest->bindParam(2,$lastname,\PDO::PARAM_STR);
            $sqlRequest->bindParam(3,$email, \PDO::PARAM_STR);
            $sqlRequest->bindParam(4,$password, \PDO::PARAM_STR);
            $sqlRequest->execute();
            $id = $req->lastInsertId('users');
            $this->idUser = $id;
            return $this;
        } catch (\Exception $e) {
            //throw $th;
            throw new \Exception($e->getMessage());
        }
    }
}
