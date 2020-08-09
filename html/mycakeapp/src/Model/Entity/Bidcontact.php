<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bidcontact Entity
 *
 * @property int $id
 * @property int $biderinfo_id
 * @property int $user_id
 * @property string $message
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\Biderinfo $biderinfo
 * @property \App\Model\Entity\User $user
 */
class Bidcontact extends Entity
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
        'biderinfo_id' => true,
        'user_id' => true,
        'message' => true,
        'created' => true,
        'biderinfo' => true,
        'user' => true,
    ];
}
