<?php
namespace local\task9;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\TextField;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\Relations\ManyToMany;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class AuthorTable extends DataManager
{
    public static function getTableName(): string
    {
        return 'task9_author';
    }

    public static function getMap(): array
    {
        return [
            (new IntegerField('ID'))
                ->configurePrimary()
                ->configureAutocomplete()
                ->configureTitle(Loc::getMessage('TASK9_AUTHOR_TABLE_ID')),

            (new StringField('FIRST_NAME'))
                ->configureRequired()
                ->configureSize(100)
                ->configureTitle(Loc::getMessage('TASK9_AUTHOR_TABLE_FIRST_NAME')),

            (new StringField('LAST_NAME'))
                ->configureRequired()
                ->configureSize(100)
                ->configureTitle(Loc::getMessage('TASK9_AUTHOR_TABLE_LAST_NAME')),

            (new StringField('SECOND_NAME'))
                ->configureSize(100)
                ->configureTitle(Loc::getMessage('TASK9_AUTHOR_TABLE_SECOND_NAME')),

            (new DateField('BIRTH_DATE'))
                ->configureTitle(Loc::getMessage('TASK9_AUTHOR_TABLE_BIRTH_DATE')),

            (new TextField('BIOGRAPHY'))
                ->configureTitle(Loc::getMessage('TASK9_AUTHOR_TABLE_BIOGRAPHY')),

            (new ManyToMany('BOOKS', BookTable::class))
                ->configureTableName('task9_book_author')
                ->configureLocalPrimary('ID', 'AUTHOR_ID')
                ->configureRemotePrimary('ID', 'BOOK_ID')
                ->configureTitle(Loc::getMessage('TASK9_CRMCUSTOMTAB_AUTHOR_TABLE_BOOKS')),
        ];
    }
}
