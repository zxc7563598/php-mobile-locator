# hejunjie/mobile-locator

<div align="center">
  <a href="./README.md">English</a>｜<a href="./README.zh-CN.md">简体中文</a>
  <hr width="50%"/>
</div>

A mobile number lookup library based on Chinese carrier rules. Identifies carriers and regions, suitable for registration checks, user profiling, and data archiving.

> Current data entries: 481,615

---

This is a mobile number attribution dataset I compiled myself. It allows you to look up the location and carrier information of Chinese mobile numbers based on segment rules. Just like my other data repositories, this one is regularly updated.

In short, it consolidates all those scattered and complicated segment details into a single, easy-to-use JSON file—making lookups fast and straightforward.

If you don’t want to deploy anything and just want to use it directly, you can 👉 [click here to use it](https://tools.hejunjie.life/#/external/mobile-locator).

Bulk lookup is supported.

## Installation

Install via Composer:

```bash
composer require hejunjie/mobile-locator
```

## Included Data Files

`data.json`：All data, with a total of **481,615** number segments.

You can directly import the JSON file for processing. The structure is clear, so you can use it right away.

## Usage

I wrote a simple helper class `MobileLocator` to make it easier to access the data and perform common processing.：

```php
<?php
use Hejunjie\MobileLocator\MobileLocator;

// Retrieve all data.
$data = MobileLocator::getData();
```

Additionally, I provide some commonly used methods that you can use directly. However, if you have performance requirements, I strongly recommend caching the data and implementing it yourself.

```php
<?php
use Hejunjie\MobileLocator\MobileLocator;

// Get carrier information based on the phone number.
$info = MobileLocator::getCarrierInfo('16601750925');
```

## Update Notes

The data is regularly updated to ensure you always get the latest information. If you notice any missing or inaccurate data, feel free to open an Issue or PR to help improve it together!

## Purpose & Motivation

It all started with a simple need: I just wanted to check a phone number's carrier and location in a project.

Most open-source libraries I found were outdated, relied on third-party APIs, had rate limits, or used legacy .dat files.

So, I decided to build my own.

This library is based on up-to-date number segment data, categorized by province, city, and carrier. It allows you to quickly look up phone number attribution with no external dependencies. The data is regularly updated, and the library is kept as simple and practical as possible—because honestly, I built it for my own convenience ❤️

## 🔧 Additional Toolkits (Can be used independently or installed together)

This project was originally extracted from [hejunjie/tools](https://github.com/zxc7563598/php-tools).
To install all features in one go, feel free to use the all-in-one package:

```bash
composer require hejunjie/tools
```

Alternatively, feel free to install only the modules you need：

[hejunjie/utils](https://github.com/zxc7563598/php-utils) - A lightweight and practical PHP utility library that offers a collection of commonly used helper functions for files, strings, arrays, and HTTP requests—designed to streamline development and support everyday PHP projects.

[hejunjie/cache](https://github.com/zxc7563598/php-cache) - A layered caching system built with the decorator pattern. Supports combining memory, file, local, and remote caches to improve hit rates and simplify cache logic.

[hejunjie/china-division](https://github.com/zxc7563598/php-china-division) - Regularly updated dataset of China's administrative divisions with ID-card address parsing. Distributed via Composer and versioned for use in forms, validation, and address-related features

[hejunjie/error-log](https://github.com/zxc7563598/php-error-log) - An error logging component using the Chain of Responsibility pattern. Supports multiple output channels like local files, remote APIs, and console logs—ideal for flexible and scalable logging strategies.

[hejunjie/mobile-locator](https://github.com/zxc7563598/php-mobile-locator) - A mobile number lookup library based on Chinese carrier rules. Identifies carriers and regions, suitable for registration checks, user profiling, and data archiving.

[hejunjie/address-parser](https://github.com/zxc7563598/php-address-parser) - An intelligent address parser that extracts name, phone number, ID number, region, and detailed address from unstructured text—perfect for e-commerce, logistics, and CRM systems.

[hejunjie/url-signer](https://github.com/zxc7563598/php-url-signer) - A PHP library for generating URLs with encryption and signature protection—useful for secure resource access and tamper-proof links.

[hejunjie/google-authenticator](https://github.com/zxc7563598/php-google-authenticator) - A PHP library for generating and verifying Time-Based One-Time Passwords (TOTP). Compatible with Google Authenticator and similar apps, with features like secret generation, QR code creation, and OTP verification.

[hejunjie/simple-rule-engine](https://github.com/zxc7563598/php-simple-rule-engine) - A lightweight and flexible PHP rule engine supporting complex conditions and dynamic rule execution—ideal for business logic evaluation and data validation.

👀 All packages follow the principles of being lightweight and practical — designed to save you time and effort. They can be used individually or combined flexibly. Feel free to ⭐ star the project or open an issue anytime!

---

This library will continue to be updated with more practical features. Suggestions and feedback are always welcome — I’ll prioritize new functionality based on community input to help improve development efficiency together.
