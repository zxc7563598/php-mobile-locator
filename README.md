# hejunjie/mobile-locator

这是我自己整理的一份手机号码归属地数据包，基于国内号段规则来查询手机号码所属的位置和运营商信息。数据会定期更新，就像我维护的其他数据仓库一样。

简单来说，就是把那些繁琐的号段归属信息整合到一个 JSON 文件里，让你能方便地查询和使用。

## 安装方式

```bash
composer require hejunjie/mobile-locator
```

## 包含的数据文件

`data.json`：全部数据，共计 481,615 个号段

都可以直接引入 JSON 文件来处理，结构比较清晰，拿来用就行。

## 使用方式

我写了一个简单的辅助类 MobileLocator 来方便获取数据和常用处理：

```php
<?php
use Hejunjie\MobileLocator\MobileLocator;

// 获取全部数据
$data = MobileLocator::getData();
```

另外也提供了一些常用的方法，直接可以拿来用，但如果你对性能有要求，强烈建议对数据进行缓存后自行实现

```php
<?php
use Hejunjie\MobileLocator\MobileLocator;

// 根据手机号获取运营商信息
$info = MobileLocator::getCarrierInfo('16601750925');
```

## 更新说明

数据会定期更新，保证你拿到的都是最新的信息。如果你发现有遗漏或者数据不准确，欢迎提 Issue 或 PR，一起完善！

## 用途 & 初衷

最开始只是想在项目里简单查一下手机号归属地，网上的开源库很多年不更新，要么依赖第三方 API，要么接口限速，要么就得用老旧的 .dat 文件。

我就干脆自己搞了一个：
直接整理 最新号段数据，按省、市和运营商分类，支持通过手机号快速获取归属地信息，数据是定期更新的，库也尽量保持简单实用，毕竟我就是为了自己用得方便才写的 😅

## 🔧 更多工具包（可独立使用，也可统一安装）

本项目最初是从 [hejunjie/tools](https://github.com/zxc7563598/php-tools) 拆分而来，如果你想一次性安装所有功能组件，也可以使用统一包：

```bash
composer require hejunjie/tools
```

当然你也可以按需选择安装以下功能模块：

[hejunjie/cache](https://github.com/zxc7563598/php-cache) - 多层缓存系统，基于装饰器模式。

[hejunjie/china-division](https://github.com/zxc7563598/php-china-division) - 中国省市区划分数据包。

[hejunjie/error-log](https://github.com/zxc7563598/php-error-log) - 责任链日志上报系统。

[hejunjie/utils](https://github.com/zxc7563598/php-utils) - 常用工具方法集合。

👀 所有包都遵循「轻量实用、解放双手」的原则，能单独用，也能组合用，自由度高，欢迎 star 🌟 或提 issue。

---

该库后续将持续更新，添加更多实用功能。欢迎大家提供建议和反馈，我会根据大家的意见实现新的功能，共同提升开发效率。








