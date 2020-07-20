<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bidrating Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $biderinfo_id
 * @property int $user_judger_id
 * @property bool $rating
 * @property string $comment
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Biderinfo $biderinfo
 * @property \App\Model\Entity\UserJudger $user_judger
 */
class Bidrating extends Entity
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
        'user_id' => true,
        'biderinfo_id' => true,
        'user_judger_id' => true,
        'rating' => true,
        'comment' => true,
        'created' => true,
        'user' => true,
        'biderinfo' => true,
        'user_judger' => true,
    ];
}
