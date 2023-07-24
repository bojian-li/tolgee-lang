# tolgee-lang
request tolgee lang message

### Installation

运行环境要求 PHP 7.4 及以上版本，以及[cURL](http://php.net/manual/zh/book.curl.php)。

#### tolgee翻译平台SDK

> composer require bojian/tolgee-lang

.env配置，url翻译平台地址，api_key翻译平台key
```sh
[tolgee]
url =  
api_key =  
```

```php
 /**
 * 获取语言变量值
 * @param string $name
 * @param array $vars  替换使用的变量
 * @param string $lang
 * @return void
 */
$string = tolgeeLang('err_code_23268', [], 'en-us');
```
$vars配置文档[cURL](https://www.php.net/manual/zh/messageformatter.formatmessage.php)。
