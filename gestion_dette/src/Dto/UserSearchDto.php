<?php
namespace App\Dto;

use App\Enums\Role;

class UserSearchDto
{
    private ?string $nom = null;
    private ?string $telephone = null;
    private ?string $email = null;
    private ?Role $role = null;
    private ?string $status = null;

    // Getters and Setters

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role->value;
    }

    public function setRole(?string $role): self
    {
        $this->role = Role::fromValue($role);
        $this->role = $role;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function __construct(){
        $this->telephone = '';
        $this->nom = '';
        $this->email = '';
        $this->role = Role::CLIENT;
        $this->status = '';
    }
}
