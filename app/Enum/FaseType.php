<?php
namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static UserStatus PENDING()
 * @method static UserStatus ACTIVE()
 * @method static UserStatus BLOCKED()
 */
class FaseType extends Enum
{
    const PERENCANAAN = 'PERENCANAAN';
    const PELAKSANAAN = 'PELAKSANAAN';
    const PENGAWASAN = 'PENGAWASAN';

    public function label()
    {
        return "<span class=\"ui basic mini label {$this->getCssClass()} \">{$this->value}</span>";
    }

    public function getCssClass()
    {
        return array_get($this->getAvailableClass(), $this->value);
    }

    protected function getAvailableClass()
    {
        return [
            static::PERENCANAAN => 'teal',
            static::PELAKSANAAN => 'green',
            static::PENGAWASAN => 'yellow',
        ];
    }
}
