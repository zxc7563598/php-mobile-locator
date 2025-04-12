<?php

namespace Hejunjie\MobileLocator;

class MobileLocator
{
    private static $instance = null;    // 单例实例
    private $cache = [];                // 查询缓存

    /**
     * 获取完整数据
     * 
     * @return array 
     */
    public static function getData(): array
    {
        ini_set('memory_limit', '-1');
        $filePath = __DIR__ . "/data.json";
        if (!file_exists($filePath)) {
            throw new \Exception("运营商数据文件不存在: $filePath");
        }
        $jsonData = file_get_contents($filePath);
        $data = json_decode($jsonData, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("解析 JSON 文件时出错: " . json_last_error_msg());
        }
        return $data;
    }

    /**
     * 根据手机号获取运营商信息
     * 
     * 该方法仅保障了最低可用性，如果需要提升响应速度与效率，建议调用 getAll() 获取全部数据存储 Redis 自行处理
     * 
     * @param string $phoneNumber 手机号
     * @param string $returnUnknown 未知信息返回内容
     * 
     * @return array ['province' => '省', 'city' => '市', 'isp' => '运营商']
     * @throws Exception 
     */
    public static function getCarrierInfo(string $phoneNumber, string $returnUnknown = '未知'): array
    {
        $instance = self::getInstance();
        // 检查缓存
        if (isset($instance->cache[$phoneNumber])) {
            return $instance->cache[$phoneNumber];
        }
        // 获取手机号前3位作为分类依据
        $prefix = substr($phoneNumber, 0, 3);
        $carrierData = $instance->loadCarrierData($prefix);
        // 获取手机号前7位
        $phonePrefix = substr($phoneNumber, 0, 7);
        $carrierInfo = $carrierData[$phonePrefix] ?? null;
        if ($carrierInfo === null) {
            $result = [
                'province' => $returnUnknown,
                'city' => $returnUnknown,
                'isp' => $returnUnknown,
            ];
        } else {
            $result = [
                'province' => $carrierInfo['province'],
                'city' => $carrierInfo['city'],
                'isp' => $carrierInfo['isp'],
            ];
        }
        // 缓存结果
        $instance->cache[$phoneNumber] = $result;
        return $result;
    }

    // 单例模式获取实例
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // 根据手机号前3位加载对应的数据文件
    private function loadCarrierData(string $prefix): array
    {
        $filePath = __DIR__ . "/carrier_data_{$prefix}.json";
        if (!file_exists($filePath)) {
            return [];
        }
        $jsonData = file_get_contents($filePath);
        $data = json_decode($jsonData, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [];
        }
        return $data;
    }
}
