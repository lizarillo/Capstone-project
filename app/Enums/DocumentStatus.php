<?php

namespace App\Enums;

enum DocumentStatus: string
{
    case Pending = 'Pending';
    case Approved = 'Approved';

    // Method to get the label for the status
    public function label(): string
    {
        return match($this) {
            self::Pending => 'Pending',
            self::Approved => 'Approved',
        };
    }

    // Method to get all possible enum values
    public static function values(): array
    {
        return array_map(fn($enum) => $enum->value, self::cases());
    }
}
