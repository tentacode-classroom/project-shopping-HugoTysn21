<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements  UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=6)
     * @Assert\IsTrue(message="The password cannot match your first name or last name")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     */
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $lastname;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Travel", mappedBy="user", orphanRemoval=true)
     */
    private $travels;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     */
    private $avatarFileName;

    private $avatar;

    /**
     * @ORM\Column(type="simple_array")
     */
    //pour lors de l'instanciation on defined le role user
    private $roles = ['ROLE_USER'];

    public function __construct()
    {
        $this->travels = new ArrayCollection();
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection|Travel[]
     */
    public function getTravels(): Collection
    {
        return $this->travels;
    }

    public function addTravel(Travel $travel): self
    {
        if (!$this->travels->contains($travel)) {
            $this->travels[] = $travel;
            $travel->setUser($this);
        }

        return $this;
    }

    public function removeTravel(Travel $travel): self
    {
        if ($this->travels->contains($travel)) {
            $this->travels->removeElement($travel);
            // set the owning side to null (unless already changed)
            if ($travel->getUser() === $this) {
                $travel->setUser(null);
            }
        }

        return $this;
    }

    public function getAvatarFileName(): ?string
    {
        return $this->avatarFileName;
    }

    public function setAvatarFileName(string $avatarFileName): self
    {
        $this->avatarFileName = $avatarFileName;

        return $this;
    }

    public function getAvatar(): ?UploadedFile
    {
        return $this->avatar;
    }

    public function setAvatar(UploadedFile $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
    public function getUsername()
    {
        return $this->email;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
    /**
     * @Assert\IsTrue(message="The password cannot match your first name or last name")
     */
    public function isPasswordSafe()
    {

        return $this->firstname !== $this->password && $this->lastname !== $this->password;
    }
}
