<?php
namespace local\task30;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

/**
 * Class ContactsDataTable
 * 
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> ENTITY_ID string(50) optional
 * <li> ELEMENT_ID int optional
 * <li> TYPE_ID string(50) optional
 * <li> VALUE_TYPE string(50) optional
 * <li> VALUE string(50) optional
 * <li> NEW_VALUE string(50) optional
 * </ul>
 *
 * @package Bitrix\Original
 **/

class OriginalContactsDataTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'task30_original_contacts_data';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return [
			'ID' => (new IntegerField('ID',
					[]
				))->configureTitle(Loc::getMessage('CONTACTS_DATA_ENTITY_ID_FIELD'))
						->configurePrimary(true)
						->configureAutocomplete(true)
			,
			'ENTITY_ID' => (new StringField('ENTITY_ID',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 50),
							];
						},
					]
				))->configureTitle(Loc::getMessage('CONTACTS_DATA_ENTITY_ENTITY_ID_FIELD'))
			,
			'ELEMENT_ID' => (new IntegerField('ELEMENT_ID',
					[]
				))->configureTitle(Loc::getMessage('CONTACTS_DATA_ENTITY_ELEMENT_ID_FIELD'))
			,
			'TYPE_ID' => (new StringField('TYPE_ID',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 50),
							];
						},
					]
				))->configureTitle(Loc::getMessage('CONTACTS_DATA_ENTITY_TYPE_ID_FIELD'))
			,
			'VALUE_TYPE' => (new StringField('VALUE_TYPE',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 50),
							];
						},
					]
				))->configureTitle(Loc::getMessage('CONTACTS_DATA_ENTITY_VALUE_TYPE_FIELD'))
			,
			'VALUE' => (new StringField('VALUE',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 50),
							];
						},
					]
				))->configureTitle(Loc::getMessage('CONTACTS_DATA_ENTITY_VALUE_FIELD'))
			,
			'NEW_VALUE' => (new StringField('NEW_VALUE',
					[
						'validation' => function()
						{
							return[
								new LengthValidator(null, 50),
							];
						},
					]
				))->configureTitle(Loc::getMessage('CONTACTS_DATA_ENTITY_NEW_VALUE_FIELD'))
			,
		];
	}
}


/*File: /bitrix/modules/original/lang/ru/lib/contactsdatatable.php
<?php
$MESS['CONTACTS_DATA_ENTITY_ID_FIELD'] = "";
$MESS['CONTACTS_DATA_ENTITY_ENTITY_ID_FIELD'] = "";
$MESS['CONTACTS_DATA_ENTITY_ELEMENT_ID_FIELD'] = "";
$MESS['CONTACTS_DATA_ENTITY_TYPE_ID_FIELD'] = "";
$MESS['CONTACTS_DATA_ENTITY_VALUE_TYPE_FIELD'] = "";
$MESS['CONTACTS_DATA_ENTITY_VALUE_FIELD'] = "";
$MESS['CONTACTS_DATA_ENTITY_NEW_VALUE_FIELD'] = "";

*/