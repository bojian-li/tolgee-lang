<?php

use \Bojian\TolgeeLang\TolgeeClient;
 /**
 * 获取语言变量值
 * @param string $name
 * @param array $vars
 * @param string $lang
 * @return void
 */
function tolgeeLang(string $name, array $vars = [], string $lang = 'zh-cn')
{
    $tolgeeClient = new TolgeeClient('translations', [
        'lang' => $lang,
        'name' => $name,
        'vars' => $vars
    ]);

    return $tolgeeClient->getResult();
}

