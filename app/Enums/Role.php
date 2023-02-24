<?php

namespace App\Enums;

enum Role: string
{

    case GUEST = 'Guest';
    case ADMIN = 'Admin';

    public function text(): string
    {
        return match($this) {
            self::GUEST => 'Default access level, can leave tributes, share media and stories',
            self::ADMIN => 'Can control all aspects of the website, including moderating content posted by others and changing website settings',
        };
    }

    public static function list(): array
    {
        $arr = [];
        foreach (self::cases() as $item) {
            $arr[] = [
                'value' => $item->value,
                'text' => $item->text(),
            ];
        }

        return $arr;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function rand(): self
    {
        return self::cases()[array_rand(self::values())];
    }
}
