<?php declare(strict_types=1);

namespace Shopware\Core\Content\Category\Aggregate\CategoryTranslation;

use Shopware\Core\Content\Catalog\CatalogEntity;
use Shopware\Core\Content\Category\CategoryEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\System\Language\LanguageEntity;

class CategoryTranslationEntity extends Entity
{
    /**
     * @var string
     */
    protected $categoryId;

    /**
     * @var int
     */
    protected $catalogId;

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var string|null
     */
    protected $languageParentId;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $pathNames;

    /**
     * @var string|null
     */
    protected $metaKeywords;

    /**
     * @var string|null
     */
    protected $metaTitle;

    /**
     * @var string|null
     */
    protected $metaDescription;

    /**
     * @var string|null
     */
    protected $cmsHeadline;

    /**
     * @var string|null
     */
    protected $cmsDescription;

    /**
     * @var CategoryEntity|null
     */
    protected $category;

    /**
     * @var LanguageEntity|null
     */
    protected $language;

    /**
     * @var CatalogEntity|null
     */
    protected $catalog;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime|null
     */
    protected $updatedAt;

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function setCategoryId(string $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    public function setLanguageId(string $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function getLanguageParentId(): ?string
    {
        return $this->languageParentId;
    }

    public function setLanguageParentId(?string $languageParentId): void
    {
        $this->languageParentId = $languageParentId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getPathNames(): ?string
    {
        return $this->pathNames;
    }

    public function setPathNames(?string $pathNames): void
    {
        $this->pathNames = $pathNames;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords(?string $metaKeywords): void
    {
        $this->metaKeywords = $metaKeywords;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(?string $metaTitle): void
    {
        $this->metaTitle = $metaTitle;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): void
    {
        $this->metaDescription = $metaDescription;
    }

    public function getCmsHeadline(): ?string
    {
        return $this->cmsHeadline;
    }

    public function setCmsHeadline(?string $cmsHeadline): void
    {
        $this->cmsHeadline = $cmsHeadline;
    }

    public function getCmsDescription(): ?string
    {
        return $this->cmsDescription;
    }

    public function setCmsDescription(?string $cmsDescription): void
    {
        $this->cmsDescription = $cmsDescription;
    }

    public function getCategory(): ?CategoryEntity
    {
        return $this->category;
    }

    public function setCategory(CategoryEntity $category): void
    {
        $this->category = $category;
    }

    public function getLanguage(): ?LanguageEntity
    {
        return $this->language;
    }

    public function setLanguage(LanguageEntity $language): void
    {
        $this->language = $language;
    }

    public function getCatalogId(): int
    {
        return $this->catalogId;
    }

    public function setCatalogId(int $catalogId): void
    {
        $this->catalogId = $catalogId;
    }

    public function getCatalog(): ?CatalogEntity
    {
        return $this->catalog;
    }

    public function setCatalog(CatalogEntity $catalog): void
    {
        $this->catalog = $catalog;
    }
}