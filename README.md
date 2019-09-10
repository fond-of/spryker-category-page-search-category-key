# Extend catalog search results
[![Build Status](https://travis-ci.org/fond-of/spryker-category.svg?branch=master)](https://travis-ci.org/fond-of-spryker/category-page-search-category-map)
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/category-page-search-category-map)

Plugin expand catalog search results with category key

## Installation

```
composer require fond-of-spryker/category-page-search-category-map
```

Register the new Plugin into your CategoryPageSearchPlugableDependencyProvider (dependency package)

```
protected function createCategoryPageMapExpanderPlugin(): array
{
    return [
        new CategoryKeyPageMapExpanderPlugin(),
    ];
}
```