<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
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
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $department;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $team;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $bio;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $timezone;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $language;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $profileVisibility;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $headerImage;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Projects", mappedBy="Users")
     */
    private $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->userName;
    }

    /**
     * @param string $userName
     * @return User
     */
    public function setUsername(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Projects[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Projects $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addUser($this);
        }

        return $this;
    }

    public function removeProject(Projects $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            $project->removeUser($this);
        }

        return $this;
    }

}
