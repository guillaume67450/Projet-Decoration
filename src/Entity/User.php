<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields= {"email"}, 
 * message= "l'email que vous avez indiqué est déjà utilisé !")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage = "votre mot de passe doit faire 8 caractères minimum")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message = "vous n'avez pas tapé le même mot de passe")
     */

    public $confirm_password;


    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Email()
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", mappedBy="users")
     */
    private $userRoles;

    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
    }


    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function eraseCredentials() {} 
        
    public function getSalt() {} 
        
    public function getRoles() { // on utilise ici la fonction map pour transformer la collection de rôles en tableau afin de pouvoir exploiter les rôles sous forme de chaines de caractères
        // il n'y a pas besoin d'insérer les rôles utilisateurs dans la base de données : ils sont insérés automatiquement ici
        $roles = $this->userRoles->map(function($role){
            return $role->getTitle();
        })->toArray();

        $roles[] = 'ROLE_USER';

        return $roles;
    }

    /**
     * @return Collection|Role[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRoles->contains($userRole)) {
            $this->userRoles->removeElement($userRole);
            $userRole->removeUser($this);
        }

        return $this;
    }
}
