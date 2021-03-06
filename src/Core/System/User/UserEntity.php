<?php declare(strict_types=1);

namespace Shopware\Core\System\User;

use Shopware\Core\Content\Media\MediaCollection;
use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\Locale\LocaleEntity;
use Shopware\Core\System\StateMachine\Aggregation\StateMachineHistory\StateMachineHistoryCollection;
use Shopware\Core\System\User\Aggregate\UserAccessKey\UserAccessKeyCollection;
use Shopware\Core\System\User\Aggregate\UserRecovery\UserRecoveryEntity;

class UserEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $localeId;

    /**
     * @var string|null
     */
    protected $avatarId;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var \DateTimeInterface|null
     */
    protected $createdAt;

    /**
     * @var \DateTimeInterface|null
     */
    protected $updatedAt;

    /**
     * @var LocaleEntity|null
     */
    protected $locale;

    /**
     * @var MediaEntity|null
     */
    protected $avatarMedia;

    /**
     * @var MediaCollection|null
     */
    protected $media;

    /**
     * @var UserAccessKeyCollection|null
     */
    protected $accessKeys;

    /**
     * @var StateMachineHistoryCollection|null
     */
    protected $stateMachineHistoryEntries;

    /**
     * @var UserRecoveryEntity|null
     */
    protected $recoveryUser;

    /**
     * @var string|null
     */
    protected $storeToken;

    /**
     * @var array|null
     */
    protected $attributes;

    public function getStateMachineHistoryEntries(): ?StateMachineHistoryCollection
    {
        return $this->stateMachineHistoryEntries;
    }

    public function setStateMachineHistoryEntries(?StateMachineHistoryCollection $stateMachineHistoryEntries): void
    {
        $this->stateMachineHistoryEntries = $stateMachineHistoryEntries;
    }

    public function getLocaleId(): string
    {
        return $this->localeId;
    }

    public function setLocaleId(string $localeId): void
    {
        $this->localeId = $localeId;
    }

    public function getAvatarId(): ?string
    {
        return $this->avatarId;
    }

    public function setAvatarId(string $avatarId): void
    {
        $this->avatarId = $avatarId;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getLocale(): ?LocaleEntity
    {
        return $this->locale;
    }

    public function setLocale(LocaleEntity $locale): void
    {
        $this->locale = $locale;
    }

    public function getAvatarMedia(): ?MediaEntity
    {
        return $this->avatarMedia;
    }

    public function setAvatarMedia(MediaEntity $avatarMedia): void
    {
        $this->avatarMedia = $avatarMedia;
    }

    public function getMedia(): ?MediaCollection
    {
        return $this->media;
    }

    public function setMedia(MediaCollection $media): void
    {
        $this->media = $media;
    }

    public function getAccessKeys(): ?UserAccessKeyCollection
    {
        return $this->accessKeys;
    }

    public function setAccessKeys(UserAccessKeyCollection $accessKeys): void
    {
        $this->accessKeys = $accessKeys;
    }

    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    public function setAttributes(?array $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function getRecoveryUser(): ?UserRecoveryEntity
    {
        return $this->recoveryUser;
    }

    public function setRecoveryUser(UserRecoveryEntity $recoveryUser): void
    {
        $this->recoveryUser = $recoveryUser;
    }

    public function getStoreToken(): ?string
    {
        return $this->storeToken;
    }

    public function setStoreToken(?string $storeToken): void
    {
        $this->storeToken = $storeToken;
    }
}
