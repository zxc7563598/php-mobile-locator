# hejunjie/mobile-locator

[English](./README.md) ｜ 简体中文

基于国内手机号段规则的归属地查询库，支持运营商和地区识别，适用于注册校验、用户画像、数据归档等场景。

[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D%208.1-blue)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green)](./LICENSE)

> 当前收录号段数量：**483,709**

**本项目已经经由 Zread 解析完成，如果需要快速了解项目，可以点击此处进行查看：[了解本项目](https://zread.ai/zxc7563598/php-mobile-locator)**

## 特性

- **离线查询**：不依赖第三方 API，无需网络请求，数据全部内置
- **按需加载**：数据按号段前缀拆分到多个文件，查询时仅加载所需文件，降低内存占用
- **运营商识别**：自动识别中国移动、中国联通、中国电信等运营商
- **地区定位**：精确到省、市两级地理信息
- **数据更新**：号段数据定期更新，保持时效性

## 环境要求

- PHP >= 8.1

## 安装

```bash
composer require hejunjie/mobile-locator
```

## 快速开始

```php
<?php

use Hejunjie\MobileLocator\MobileLocator;

// 查询手机号归属地
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

根据手机号查询运营商和归属地信息。

| 参数 | 类型 | 说明 |
|------|------|------|
| `$phoneNumber` | `string` | 手机号码，需为纯数字且至少 7 位 |
| `$returnUnknown` | `string` | 未匹配时的默认返回值，默认为 `'未知'` |

**返回值**：

```php
[
    'province' => '上海',  // 省
    'city'     => '上海',  // 市
    'isp'      => '联通',  // 运营商
]
```

未匹配到时，三个字段均返回 `$returnUnknown` 的值。

**异常**：

- `InvalidArgumentException`：手机号格式不合法时抛出
- `Exception`：数据文件损坏或不存在时抛出

**实现细节**：方法内部使用单例模式，查询结果会缓存在内存中，同一进程内重复查询相同号码不会重复读取文件。

### `getData(): array`

获取全量号段数据。

> [!WARNING]
> 数据文件约 49MB，解码后内存占用约 200-500MB，方法内部会将 `memory_limit` 设置为 1024M。如需在生产环境使用，建议先调用此方法将数据导入 Redis 等外部缓存。

## 数据文件

项目中包含两类数据文件：

| 文件 | 说明 |
|------|------|
| `src/data.json` | 全量数据文件（~49MB），包含全部号段 |
| `src/carrier_data_{前缀}.json` | 按手机号前 3 位拆分的分片文件，共 56 个 |

数据格式：

```json
{
    "1660000": {
        "province": "北京",
        "city": "北京",
        "isp": "联通"
    }
}
```

每个号段（手机号前 7 位）对应一条记录，包含省份、城市和运营商信息。

## 性能建议

`getCarrierInfo()` 方法已做了基本的按需加载和内存缓存，足以应对低频查询场景。如果你有更高的性能要求（如高并发、批量查询），建议：

1. **缓存全量数据到 Redis**：使用 `getData()` 获取全部数据后导入 Redis，后续查询直接从 Redis 读取
2. **自行实现批量查询**：对大批量手机号的查询场景，可以预加载相关号段文件后批量匹配，避免单条查询时的重复 I/O

## 更新与贡献

号段数据会定期更新。如果你发现数据遗漏或不准确，欢迎提交 Issue 或 PR。
