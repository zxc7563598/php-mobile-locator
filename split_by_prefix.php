<?php

declare(strict_types=1);

ini_set('memory_limit', '-1');

$inputFile  = __DIR__ . '/src/data.json';
$outputDir  = __DIR__ . '/split';

if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}
// 读取原始 JSON
$data = json_decode(file_get_contents($inputFile), true);
if (!is_array($data)) {
    die('JSON 格式错误');
}
// 按前缀分组
$groups = [];
foreach ($data as $key => $value) {
    $prefix = substr($key, 0, 3);
    $groups[$prefix][$key] = $value;
}
// 写入文件
foreach ($groups as $prefix => $items) {
    ksort($items, SORT_STRING);
    $filename = sprintf(
        '%s/carrier_data_%s.json',
        $outputDir,
        $prefix
    );
    file_put_contents(
        $filename,
        json_encode(
            $items,
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
        )
    );
    echo "已生成：{$filename}\n";
}
