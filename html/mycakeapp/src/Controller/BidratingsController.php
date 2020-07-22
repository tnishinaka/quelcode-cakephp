<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bidratings Controller
 *
 * @property \App\Model\Table\BidratingsTable $Bidratings
 *
 * @method \App\Model\Entity\Bidrating[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BidratingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Biderinfos', 'UserJudgers'],
        ];
        $bidratings = $this->paginate($this->Bidratings);

        $this->set(compact('bidratings'));
    }

    /**
     * View method
     *
     * @param string|null $id Bidrating id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bidrating = $this->Bidratings->get($id, [
            'contain' => ['Users', 'Biderinfos', 'UserJudgers'],
        ]);

        $this->set('bidrating', $bidrating);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bidrating = $this->Bidratings->newEntity();
        if ($this->request->is('post')) {
            $bidrating = $this->Bidratings->patchEntity($bidrating, $this->request->getData());
            if ($this->Bidratings->save($bidrating)) {
                $this->Flash->success(__('The bidrating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bidrating could not be saved. Please, try again.'));
        }
        $users = $this->Bidratings->Users->find('list', ['limit' => 200]);
        $biderinfos = $this->Bidratings->Biderinfos->find('list', ['limit' => 200]);
        $userJudgers = $this->Bidratings->UserJudgers->find('list', ['limit' => 200]);
        $this->set(compact('bidrating', 'users', 'biderinfos', 'userJudgers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bidrating id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bidrating = $this->Bidratings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bidrating = $this->Bidratings->patchEntity($bidrating, $this->request->getData());
            if ($this->Bidratings->save($bidrating)) {
                $this->Flash->success(__('The bidrating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bidrating could not be saved. Please, try again.'));
        }
        $users = $this->Bidratings->Users->find('list', ['limit' => 200]);
        $biderinfos = $this->Bidratings->Biderinfos->find('list', ['limit' => 200]);
        $userJudgers = $this->Bidratings->UserJudgers->find('list', ['limit' => 200]);
        $this->set(compact('bidrating', 'users', 'biderinfos', 'userJudgers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bidrating id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bidrating = $this->Bidratings->get($id);
        if ($this->Bidratings->delete($bidrating)) {
            $this->Flash->success(__('The bidrating has been deleted.'));
        } else {
            $this->Flash->error(__('The bidrating could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
