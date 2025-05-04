# hejunjie/mobile-locator

<div align="center">
  <a href="./README.md">English</a>｜<a href="./README.zh-CN.md">简体中文</a>
  <hr width="50%"/>
</div>

基于国内号段规则的手机号码归属地查询库，支持运营商识别与地区定位，适用于注册验证、用户画像、数据归档等场景。

> 目前收录数据量：481,615

---

这是我自己整理的一份手机号码归属地数据包，基于国内号段规则来查询手机号码所属的位置和运营商信息。数据会定期更新，就像我维护的其他数据仓库一样。

简单来说，就是把那些繁琐的号段归属信息整合到一个 JSON 文件里，让你能方便地查询和使用。

如果你不想要部署，只是想要进行使用，可以 👉 [点击此处进行使用](https://tools.hejunjie.life/#/external/mobile-locator)

支持批量查询

## 安装方式

使用 Composer 安装：

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

[hejunjie/utils](https://github.com/zxc7563598/php-utils) - 一个零碎但实用的 PHP 工具函数集合库。包含文件、字符串、数组、网络请求等常用函数的工具类集合，提升开发效率，适用于日常 PHP 项目辅助功能。

[hejunjie/cache](https://github.com/zxc7563598/php-cache) - 基于装饰器模式实现的多层缓存系统，支持内存、文件、本地与远程缓存组合，提升缓存命中率，简化缓存管理逻辑。

[hejunjie/china-division](https://github.com/zxc7563598/php-china-division) - 定期更新，全国最新省市区划分数据，身份证号码解析地址，支持 Composer 安装与版本控制，适用于表单选项、数据校验、地址解析等场景。

[hejunjie/error-log](https://github.com/zxc7563598/php-error-log) - 基于责任链模式的错误日志处理组件，支持多通道日志处理（如本地文件、远程 API、控制台输出），适用于复杂日志策略场景。

[hejunjie/mobile-locator](https://github.com/zxc7563598/php-mobile-locator) - 基于国内号段规则的手机号码归属地查询库，支持运营商识别与地区定位，适用于注册验证、用户画像、数据归档等场景。

[hejunjie/address-parser](https://github.com/zxc7563598/php-address-parser) - 收货地址智能解析工具，支持从非结构化文本中提取姓名、手机号、身份证号、省市区、详细地址等字段，适用于电商、物流、CRM 等系统。

[hejunjie/url-signer](https://github.com/zxc7563598/php-url-signer) - 用于生成带签名和加密保护的URL链接的PHP工具包，适用于需要保护资源访问的场景

[hejunjie/google-authenticator](https://github.com/zxc7563598/php-google-authenticator) - 一个用于生成和验证时间基础一次性密码（TOTP）的 PHP 包，支持 Google Authenticator 及类似应用。功能包括密钥生成、二维码创建和 OTP 验证。

[hejunjie/simple-rule-engine](https://github.com/zxc7563598/php-simple-rule-engine) - 一个轻量、易用的 PHP 规则引擎，支持多条件组合、动态规则执行，适合业务规则判断、数据校验等场景。

👀 所有包都遵循「轻量实用、解放双手」的原则，能单独用，也能组合用，自由度高，欢迎 star 🌟 或提 issue。

---

该库后续将持续更新，添加更多实用功能。欢迎大家提供建议和反馈，我会根据大家的意见实现新的功能，共同提升开发效率。
