<?php

namespace FondOfSpryker\Zed\CategoryPageSearchCategoryKey\Communication\Plugin\PageMapExpander;

use FondOfSpryker\Zed\CategoryPageSearchPlugable\Dependency\Plugin\CategoryPageMapExpanderInterface;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

class CategoryKeyPageMapExpanderPlugin extends AbstractPlugin implements CategoryPageMapExpanderInterface
{
    public const CATEGORY_KEY = 'category_key';
    public const SPY_CATEGORY = 'spy_category';

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $categoryData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function expandCategoryPageMap(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $categoryData, LocaleTransfer $localeTransfer): PageMapTransfer
    {
        $this->setCategoryKey($pageMapTransfer, $pageMapBuilder, $categoryData);

        return $pageMapTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $categoryData
     *
     * @return void
     */
    protected function setCategoryKey(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $categoryData): void
    {
        if (!array_key_exists(self::SPY_CATEGORY, $categoryData)) {
            return;
        }

        if (!array_key_exists(self::CATEGORY_KEY, $categoryData[self::SPY_CATEGORY])) {
            return;
        }

        $this->addCategoryKeyToPageMapTransfer($pageMapTransfer, $categoryData);
        $this->addCategoryKeyToSearchResult($pageMapTransfer, $pageMapBuilder, $categoryData);
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param array $categoryData
     *
     * @return void
     */
    protected function addCategoryKeyToPageMapTransfer(PageMapTransfer $pageMapTransfer, array $categoryData): void
    {
        if (!method_exists($pageMapTransfer, 'setCategoryKey')) {
            return;
        }

        $pageMapTransfer->setCategoryKey($categoryData[self::SPY_CATEGORY][self::CATEGORY_KEY]);
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $categoryData
     *
     * @return void
     */
    protected function addCategoryKeyToSearchResult(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $categoryData): void
    {
        $pageMapBuilder->addSearchResultData($pageMapTransfer, self::CATEGORY_KEY, $categoryData[self::SPY_CATEGORY][self::CATEGORY_KEY]);
    }
}
