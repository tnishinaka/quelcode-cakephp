<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bidratings Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BiderinfosTable&\Cake\ORM\Association\BelongsTo $Biderinfos
 * @property \App\Model\Table\UserJudgersTable&\Cake\ORM\Association\BelongsTo $UserJudgers
 *
 * @method \App\Model\Entity\Bidrating get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bidrating newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Bidrating[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bidrating|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bidrating saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bidrating patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bidrating[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bidrating findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BidratingsTable extends Table
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

        $this->setTable('bidratings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('Biderinfo', [
            'foreignKey' => 'biderinfo_id',
            'joinType' => 'LEFT',
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
            ->integer('rating')
            ->requirePresence('rating', 'create')
            ->notEmpty('rating')
            ->inList('rating', [1, 2, 3, 4, 5]);


        $validator
            ->scalar('comment')
            ->maxLength('comment', 1000, '1000文字以下で入力してください。')
            ->requirePresence('comment', 'create')
            ->notEmptyString('comment', '必須入力です。');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['biderinfo_id'], 'Biderinfo'));
        $rules->add($rules->existsIn(['user_judger_id'], 'Users'));

        return $rules;
    }
}
