<?php

/**
 * TolgeeTest.php
 *
 * @author libojian <bojian.li@foxmail.com>
 * @since 2023/7/24 7:08 PM
 * @version 0.1
 */

namespace Tests\Tolgee;

use Bojian\Phpunit\BaseApi;
use Bojian\TolgeeLang\Extend\Helper;

class TolgeeTest extends BaseApi
{
    /**
     * 语言获取
     * @return void
     */
    public function testProjects()
    {
        $string = tolgeeLang('err_code_23268');
        $this->assertSame('最多查询100条记录', $string);

        $string = tolgeeLang('err_code_23268', [], 'en-us');
        $this->assertSame('Query up to 100 records', $string);
    }

    /**
     * 配置文件获取
     * @return void
     */
    public function testHelper()
    {
        $string = Helper::getEnv('tolgee.url');
        $this->assertSame('https://tolgee.uhouzz.net', $string);
    }
}
