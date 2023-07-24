<?php

/**
 * Tolgee.php
 *
 * @author libojian <bojian.li@foxmail.com>
 * @since 2023/7/24 11:42 PM
 * @version 0.1
 */

namespace Bojian\TolgeeLang;

use Bojian\TolgeeLang\Extend\Helper;
use WpOrg\Requests\Requests;

class TolgeeClient
{
    //接入地址
    protected string $url;
    //设置请求path信息
    protected string $path = 'v2/projects';

    //api key
    protected string $apiKey;

    //设置请求header信息
    protected array $header = [
        'Content-Type' => 'applictation/json;charset=utf-8',
        'Accept' => 'application/json;charset=utf-8'
    ];

    //设置魔术方法
    protected string $function;

    //设置请求options信息
    protected array $options;

    //设置语言内容
    protected array $params;

    //替换内容
    protected array $vars;

    //设置查询语言
    protected string $languages = 'zh-cn';

    /**
     * 初始化数据
     * @param string $route  路由
     * @param array $params  参数
     * @param array $options 配置
     */
    public function __construct(string $route, array $params = [], array $options = [])
    {
        $this->apiKey = Helper::getEnv('tolgee.api_key');
        $this->params = $params;
        $this->function = $route;
        $this->vars = $params['vars'] ?? [];
        !empty($options) && $this->options = $options;
        $this->languages = $params['lang'] ?? $this->languages;
        $this->url = sprintf('%s/%s/%s', Helper::getEnv('tolgee.url'), $this->path, $this->function);
    }

    /**
     * 返回调用结果
     * @return void
     */
    public function getResult()
    {
        // TODO: Implement getResult() method.
        $this->setAuthorization();
        return $this->{$this->function}();
    }

    /**
     * 设置请求header信息
     * @return void
     */
    protected function setAuthorization()
    {
        $this->header['X-API-Key'] = $this->apiKey;
    }

    /**
     * 获取语言内容
     * @return string
     */
    protected function translations()
    {
        $params = [
            'filterKeyName' => $this->params['name'] ?? '',
            'languages' => $this->languages,
        ];
        $response = Requests::get(sprintf('%s?%s', $this->url, http_build_query($params)), $this->header);
        $body = empty($response->body) ? [] : json_decode($response->body, true);
        $keys = $body['_embedded']['keys'] ?? [];
        $translation = current($keys)['translations'][$this->languages] ?? [];
        return $this->format($translation['text'] ?? '', $this->languages);
    }

    /**
     * 格式化语言
     * @param string $translation
     * @param $lang
     * @return string
     */
    private function format(string $translation, $lang): string
    {
        return \MessageFormatter::formatMessage($lang, $translation, $this->vars);
    }
}
