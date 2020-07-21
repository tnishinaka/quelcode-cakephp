<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use App\Controller\TableRegistry;

use Cake\Event\Event; // added.   git branch -c FILE_NAME(FROM) FILE_NAME(TO)
use Exception; // added.

class RatingController extends AppController
{
    // デフォルトテーブルを使わない
    public $useTable = false;
    // public $autoRender = false;
    // 初期化処理
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        // 必要なモデルをすべてロード
        $this->loadModel('Users');
        $this->loadModel('Biditems');
        $this->loadModel('Bidinfo');
        $this->loadModel('Biderinfo');
        $this->loadModel('Bidratings');
    }

    public function ratingadd()
    {
        $data = $this->request->getData();
        $biderinfo_id = $data['biderinfo_id'];

        //すでに記入済みかどうか確認
        $rating_num = $this->Bidratings->find('all')
            ->where(['Bidratings.biderinfo_id' => $data['biderinfo_id']])->andWhere(['Bidratings.user_id' => $data['user_id']])
            ->count();

        //user評価insert
        $bidratings = $this->Bidratings->newEntity();
        if ($this->request->is('post')) {
            if (empty($data['stopper'])) {
                $bidratings = $this->Bidratings->patchEntity($bidratings, $this->request->getData());
                if ($this->Bidratings->save($bidratings)) {
                    $this->Flash->success(__('保存しました。'));
                    return $this->redirect(['controller' => 'Auction', 'action' => 'info', $biderinfo_id]);
                } else {
                    $this->Flash->error(__('保存に失敗しました。もう一度入力下さい。'));
                    return $this->redirect(['controller' => 'Auction', 'action' => 'info', $biderinfo_id]);
                }
            }
        }
        $this->set(compact('biderinfo_id',  'bidratings', 'rating_num', 'data'));
    }

    public function ratingindex($user_id = null)
    {
        $users = $this->paginate('Users', [
            'conditions' => ['Users.id IS NOT' => $user_id],
            'order' => ['user_id' => 'asc'],
            'limit' => 10
        ])->toArray();
        $this->set(compact('users'));
    }

    public function ratingview($user_id = null)
    {
        $connection = ConnectionManager::get('default');
        $avg = $connection->execute('select round(sum(rating) / count(rating),1) as result from bidratings group by user_id having user_id = :user_id', ['user_id' => $user_id])
            ->fetch('assoc');
        $avg_data = $avg['result'];
        $bidratings = $this->paginate('Bidratings', [
            'conditions' => ['Bidratings.user_id IN' => [$user_id]],
            'join' => ['Users'],
            'order' => ['Bidratings.rating' => 'DESC'],
            'limit' => 10
        ])->toArray();
        $this->set(compact('avg_data', 'bidratings'));
    }
}
