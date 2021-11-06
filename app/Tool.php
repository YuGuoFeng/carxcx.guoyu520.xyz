<?php


namespace App;


class Tool
{
    public const CommonDateFormat = 'Y-m-d H:i:s';
    public const DefaultPage = 1;
    public const DefaultRow = 10;

    /**
     * 计算页次跟笔数.
     * @param int|null $inputPage 输入页次
     * @param int|null $inputRow 输入笔数.
     * @return int[] [页次, 笔数]
     */
    public static function filterPageRow(?int $inputPage, ?int $inputRow): array
    {
        $page = $inputPage !== '' && $inputPage !== null && $inputPage > 0
            ? $inputPage
            : self::DefaultPage;
        $row = $inputRow === null || $inputRow === 0 ? self::DefaultRow : $inputRow;

        return [$page, $row];
    }

    /**
     * @param int|null $page
     * @param int|null $row
     * @return int
     */
    public static function getOffSet(?int $page = 1, ?int $row = 10): int
    {
        return ($page - 1) * $row;
    }

    /**
     * @return false|string
     */
    public static function DBDateTime(): string
    {
        return date(self::CommonDateFormat);
    }

    /**
     * @param string $val
     * @return bool
     */
    public static function IsEmptyString(string $val): bool
    {
        return trim($val) === '';
    }
}
