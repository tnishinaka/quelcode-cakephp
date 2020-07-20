<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Biderinfo Controller
 *
 * @property \App\Model\Table\BiderinfoTable $Biderinfo
 *
 * @method \App\Model\Entity\Biderinfo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BiderinfoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bidinfos', 'Bidrequests', 'Biditems'],
        ];
        $biderinfo = $this->paginate($this->Biderinfo);

        $this->set(compact('biderinfo'));
    }

    /**
     * View method
     *
     * @param string|null $id Biderinfo id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $biderinfo = $this->Biderinfo->get($id, [
            'contain' => ['Bidinfos', 'Bidrequests', 'Biditems', 'Bidcontacts', 'Bidratings'],
        ]);

        $this->set('biderinfo', $biderinfo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $biderinfo = $this->Biderinfo->newEntity();
        if ($this->request->is('post')) {
            $biderinfo = $this->Biderinfo->patchEntity($biderinfo, $this->request->getData());
            if ($this->Biderinfo->save($biderinfo)) {
                $this->Flash->success(__('The biderinfo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The biderinfo could not be saved. Please, try again.'));
        }
        $bidinfos = $this->Biderinfo->Bidinfos->find('list', ['limit' => 200]);
        $bidrequests = $this->Biderinfo->Bidrequests->find('list', ['limit' => 200]);
        $biditems = $this->Biderinfo->Biditems->find('list', ['limit' => 200]);
        $this->set(compact('biderinfo', 'bidinfos', 'bidrequests', 'biditems'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Biderinfo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $biderinfo = $this->Biderinfo->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $biderinfo = $this->Biderinfo->patchEntity($biderinfo, $this->request->getData());
            if ($this->Biderinfo->save($biderinfo)) {
                $this->Flash->success(__('The biderinfo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The biderinfo could not be saved. Please, try again.'));
        }
        $bidinfos = $this->Biderinfo->Bidinfos->find('list', ['limit' => 200]);
        $bidrequests = $this->Biderinfo->Bidrequests->find('list', ['limit' => 200]);
        $biditems = $this->Biderinfo->Biditems->find('list', ['limit' => 200]);
        $this->set(compact('biderinfo', 'bidinfos', 'bidrequests', 'biditems'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Biderinfo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $biderinfo = $this->Biderinfo->get($id);
        if ($this->Biderinfo->delete($biderinfo)) {
            $this->Flash->success(__('The biderinfo has been deleted.'));
        } else {
            $this->Flash->error(__('The biderinfo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
