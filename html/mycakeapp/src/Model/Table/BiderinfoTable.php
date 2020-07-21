<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Biderinfo Model
 *
 * @property \App\Model\Table\BidinfoTable&\Cake\ORM\Association\BelongsTo $Bidinfo
 * @property \App\Model\Table\BidrequestsTable&\Cake\ORM\Association\BelongsTo $Bidrequests
 * @property \App\Model\Table\BiditemsTable&\Cake\ORM\Association\BelongsTo $Biditems
 * @property \App\Model\Table\BidcontactsTable&\Cake\ORM\Association\HasMany $Bidcontacts
 * @property \App\Model\Table\BidratingsTable&\Cake\ORM\Association\HasMany $Bidratings
 *
 * @method \App\Model\Entity\Biderinfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Biderinfo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Biderinfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Biderinfo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Biderinfo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Biderinfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Biderinfo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Biderinfo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BiderinfoTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('biderinfo');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Bidinfo', [
            'foreignKey' => 'bidinfo_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Biditems', [
            'foreignKey' => 'biditem_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Bidcontacts', [
            'foreignKey' => 'biderinfo_id',
        ]);
        $this->hasMany('Bidratings', [
            'foreignKey' => 'biderinfo_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('bider_name')
            ->maxLength('bider_name', 20, '20文字以内で入力してください')
            ->notEmptyString('bider_name', '必須入力です。');

        $validator
            ->scalar('bider_address')
            ->maxLength('bider_address', 30, '30文字以内で入力してください')
            ->notEmptyString('bider_address', '必須入力です。');

        $validator
            ->scalar('bider_tel')
            ->maxLength('bider_tel', 20, '20文字以内で入力してください')
            ->notEmptyString('bider_tel', '必須入力です。');

        $validator
            ->numeric('is_completed')
            ->inList('is_completed', [0, 1]);

        $validator
            ->numeric('is_sended')
            ->inList('is_sended', [0, 1]);

        $validator
            ->numeric('is_received')
            ->inList('is_received', [0, 1]);

        return $validator;
    }

    // 電話番号チェック
    // public function check_tel($value, $con)
    // {
    //     return (bool) preg_match('/^[0-9]{2,5}-?[0-9]{2,5}-?[0-9]{2,5}$/', $value);
    // }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['bidinfo_id'], 'Bidinfo'));
        $rules->add($rules->existsIn(['biditem_id'], 'Biditems'));

        return $rules;
    }
}
