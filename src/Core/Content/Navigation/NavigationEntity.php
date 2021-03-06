<?php declare(strict_types=1);

namespace Shopware\Core\Content\Navigation;

use Shopware\Core\Content\Category\CategoryEntity;
use Shopware\Core\Content\Cms\CmsPageEntity;
use Shopware\Core\Content\Navigation\Aggregate\NavigationTranslation\NavigationTranslationCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\Framework\DataAbstractionLayer\Util\Tree\TreeAwareInterface;
use Shopware\Core\System\SalesChannel\SalesChannelCollection;

class NavigationEntity extends Entity implements TreeAwareInterface
{
    use EntityIdTrait;

    /**
     * @var string|null
     */
    protected $parentId;

    /**
     * @var string|null
     */
    protected $path;

    /**
     * @var int
     */
    protected $level;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var \DateTimeInterface|null
     */
    protected $createdAt;

    /**
     * @var \DateTimeInterface|null
     */
    protected $updatedAt;

    /**
     * @var NavigationEntity|null
     */
    protected $parent;

    /**
     * @var NavigationCollection|null
     */
    protected $children;

    /**
     * @var NavigationTranslationCollection|null
     */
    protected $translations;

    /**
     * @var int
     */
    protected $childCount;

    /**
     * @var string|null
     */
    protected $categoryId;

    /**
     * @var string|null
     */
    protected $cmsPageId;

    /**
     * @var array|null
     */
    protected $slotConfig;

    /**
     * @var CategoryEntity|null
     */
    protected $category;

    /**
     * @var CmsPageEntity|null
     */
    protected $cmsPage;

    /**
     * @var SalesChannelCollection|null
     */
    protected $salesChannelNavigations;

    public function getParentId(): ?string
    {
        return $this->parentId;
    }

    public function setParentId(?string $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
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

    public function getParent(): ?NavigationEntity
    {
        return $this->parent;
    }

    public function setParent(NavigationEntity $parent): void
    {
        $this->parent = $parent;
    }

    public function getTranslations(): ?NavigationTranslationCollection
    {
        return $this->translations;
    }

    public function setTranslations(NavigationTranslationCollection $translations): void
    {
        $this->translations = $translations;
    }

    public function getChildren(): ?NavigationCollection
    {
        return $this->children;
    }

    public function setChildren(NavigationCollection $children): void
    {
        $this->children = $children;
    }

    public function getChildCount(): int
    {
        return $this->childCount;
    }

    public function setChildCount(int $childCount): void
    {
        $this->childCount = $childCount;
    }

    public function getCategoryId(): ?string
    {
        return $this->categoryId;
    }

    public function setCategoryId(?string $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getCategory(): ?CategoryEntity
    {
        return $this->category;
    }

    public function setCategory(?CategoryEntity $category): void
    {
        $this->category = $category;
    }

    public function getSalesChannelNavigations(): ?SalesChannelCollection
    {
        return $this->salesChannelNavigations;
    }

    public function setSalesChannelNavigations(SalesChannelCollection $salesChannelNavigations): void
    {
        $this->salesChannelNavigations = $salesChannelNavigations;
    }

    public function getCmsPageId(): ?string
    {
        return $this->cmsPageId;
    }

    public function setCmsPageId(?string $cmsPageId): void
    {
        $this->cmsPageId = $cmsPageId;
    }

    public function getCmsPage(): ?CmsPageEntity
    {
        return $this->cmsPage;
    }

    public function setCmsPage(CmsPageEntity $cmsPage): void
    {
        $this->cmsPage = $cmsPage;
    }

    public function getSlotConfig(): ?array
    {
        return $this->slotConfig;
    }

    public function setSlotConfig(?array $slotConfig): void
    {
        $this->slotConfig = $slotConfig;
    }
}
