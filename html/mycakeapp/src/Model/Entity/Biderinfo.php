<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Biderinfo Entity
 *
 * @property int $id
 * @property int $bidinfo_id
 * @property int $bidrequest_id
 * @property int $biditem_id
 * @property string|null $bider_name
 * @property string|null $bider_address
 * @property string|null $bider_tel
 * @property bool $is_completed
 * @property bool|null $is_sended
 * @property bool $is_received
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\Bidinfo $bidinfo
 * @property \App\Model\Entity\Bidrequest $bidrequest
 * @property \App\Model\Entity\Biditem $biditem
 * @property \App\Model\Entity\Bidcontact[] $bidcontacts
 * @property \App\Model\Entity\Bidrating[] $bidratings
 */
class Biderinfo extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'bidinfo_id' => true,
        'bidrequest_id' => true,
        'biditem_id' => true,
        'bider_name' => true,
        'bider_address' => true,
        'bider_tel' => true,
        'is_completed' => true,
        'is_sended' => true,
        'is_received' => true,
        'created' => true,
        'bidinfo' => true,
        'bidrequest' => true,
        'biditem' => true,
        'bidcontacts' => true,
        'bidratings' => true,
    ];
}
