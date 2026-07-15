# hejunjie/mobile-locator

English ｜ [简体中文](./README.zh-CN.md)

A mobile phone number location lookup library based on Chinese number segment rules. Supports carrier and region identification, suitable for registration validation, user profiling, and data archiving.

[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D%208.1-blue)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green)](./LICENSE)

> Number segments included: **483,709**

**This project has been parsed by Zread. Click here for a quick overview: [Understand this project](https://zread.ai/zxc7563598/php-mobile-locator)**

## Features

- **Offline lookup**: No third-party API dependencies or network requests — all data is bundled locally
- **On-demand loading**: Data is split across multiple files by number prefix, loading only what's needed per query to minimize memory usage
- **Carrier identification**: Automatically identifies China Mobile, China Unicom, China Telecom, and other carriers
- **Region resolution**: Pinpoints location down to province and city
- **Regular updates**: Number segment data is updated periodically to stay current

## Requirements

- PHP >= 8.1

## Installation

```bash
composer require hejunjie/mobile-locator
```

## Quick Start

```php
<?php

use Hejunjie\MobileLocator\MobileLocator;

// Look up a phone number's carrier and location
$info = MobileLocator::getCarrierInfo('16601750925');

print_r($info);
// Array
// (
//     [province] => 上海
//     [city]     => 上海
//     [isp]      => 联通
// )
```

## API

### `getCarrierInfo(string $phoneNumber, string $returnUnknown = '未知'): array`

Queries carrier and location information for a given phone number.

| Parameter | Type | Description |
|-----------|------|-------------|
| `$phoneNumber` | `string` | Phone number, must be numeric with at least 7 digits |
| `$returnUnknown` | `string` | Default value returned when no match is found, defaults to `'未知'` |

**Return value**:

```php
[
    'province' => '上海',  // Province
    'city'     => '上海',  // City
    'isp'      => '联通',  // Carrier / ISP
]
```

When no match is found, all three fields return the value of `$returnUnknown`.

**Exceptions**:

- `InvalidArgumentException`: thrown when the phone number format is invalid
- `Exception`: thrown when a data file is corrupted or missing

**Implementation**: Uses the singleton pattern internally, with query results cached in memory. Repeated queries for the same number within a single process will not trigger redundant file reads.

### `getData(): array`

Returns the full dataset of all number segments.

> [!WARNING]
> The data file is approximately 49MB, and decoding can consume 200–500MB of memory. The method sets `memory_limit` to 1024M internally. For production use, consider importing the data into an external cache such as Redis via this method.

## Data Files

The project includes two types of data files:

| File | Description |
|------|-------------|
| `src/data.json` | Full dataset (~49MB), containing all number segments |
| `src/carrier_data_{prefix}.json` | Sharded files split by the first 3 digits, 56 files in total |

Data format:

```json
{
    "1660000": {
        "province": "北京",
        "city": "北京",
        "isp": "联通"
    }
}
```

Each segment (first 7 digits of a phone number) maps to a record containing province, city, and carrier information.

## Performance Tips

The `getCarrierInfo()` method provides basic on-demand loading and in-memory caching, sufficient for low-frequency lookup scenarios. For higher performance requirements (high concurrency, batch queries), we recommend:

1. **Cache the full dataset in Redis**: Use `getData()` to retrieve all data and import it into Redis, then query directly from Redis
2. **Implement your own batch lookup**: For bulk phone number queries, preload the relevant segment files and perform batch matching to avoid repeated I/O overhead

## Updates & Contributing

Number segment data is updated periodically. If you find missing or inaccurate data, feel free to open an Issue or PR.
