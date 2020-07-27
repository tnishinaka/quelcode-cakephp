<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event; // added.
use Exception; // added.

class AuctionController extends AuctionBaseController
{
	// デフォルトテーブルを使わない
	public $useTable = false;

	// 初期化処理
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Paginator');
		// 必要なモデルをすべてロード
		$this->loadModel('Users');
		$this->loadModel('Biditems');
		$this->loadModel('Bidrequests');
		$this->loadModel('Bidinfo');
		$this->loadModel('Bidmessages');
		$this->loadModel('Biderinfo');
		$this->loadModel('Bidcontacts');
		// ログインしているユーザー情報をauthuserに設定
		$this->set('authuser', $this->Auth->user());
		// レイアウトをauctionに変更
		$this->viewBuilder()->setLayout('auction');
	}

	//ログアウト追加
	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}

	// トップページ
	public function index()
	{
		// ページネーションでBiditemsを取得
		$auction = $this->paginate('Biditems', [
			'order' => ['endtime' => 'desc'],
			'limit' => 10
		]);
		$this->set(compact('auction'));
	}

	// 商品情報の表示
	public function view($id = null)
	{
		// $idのBiditemを取得
		$biditem = $this->Biditems->get($id, [
			'contain' => ['Users', 'Bidinfo', 'Bidinfo.Users']
		]);
		//終了時刻までの差分取得
		$biditem->endtimecount = strtotime($biditem->endtime) - strtotime('now');
		// オークション終了時の処理
		if ($biditem->endtime < new \DateTime('now') and $biditem->finished == 0) {
			// finishedを1に変更して保存
			$biditem->finished = 1;
			$this->Biditems->save($biditem);
			// Bidinfoを作成する
			$bidinfo = $this->Bidinfo->newEntity();

			$biderinfo = $this->Biderinfo->newEntity();
			// Bidinfoのbiditem_idに$idを設定
			$bidinfo->biditem_id = $id;
			//biderinfoテーブルにbiditemsのidをupdate
			$biderinfo->biditem_id = $id;

			// 最高金額のBidrequestを検索
			$bidrequest = $this->Bidrequests->find('all', [
				'conditions' => ['biditem_id' => $id],
				'contain' => ['Users'],
				'order' => ['price' => 'desc']
			])->first();
			// Bidrequestが得られた時の処理
			if (!empty($bidrequest)) {
				// Bidinfoの各種プロパティを設定して保存する
				$bidinfo->user_id = $bidrequest->user->id;
				$bidinfo->user = $bidrequest->user;
				$bidinfo->price = $bidrequest->price;
				$this->Bidinfo->save($bidinfo);
				//biderinfoテーブルにbidinfoのidをupdate
				$biderinfo->bidinfo_id = $bidinfo->id;
				$this->Biderinfo->save($biderinfo);
			}
			// Biditemのbidinfoに$bidinfoを設定
			$biditem->bidinfo = $bidinfo;
		}
		// Bidrequestsからbiditem_idが$idのものを取得
		$bidrequests = $this->Bidrequests->find('all', [
			'conditions' => ['biditem_id' => $id],
			'contain' => ['Users'],
			'order' => ['price' => 'desc']
		])->toArray();
		// オブジェクト類をテンプレート用に設定
		$this->set(compact('biditem', 'bidrequests'));
	}

	// 出品する処理
	public function add()
	{
		$biditem_img = $this->Biditems->find('all', [
			'order' => ['id' => 'desc']
		])->first();

		if (is_null($biditem_img)) {
			$biditem_img_name = "1";
		} else {
			$biditem_img_name = strval($biditem_img->id + 1);
		}

		// Biditemインスタンスを用意
		$biditem = $this->Biditems->newEntity();
		// POST送信時の処理
		if ($this->request->is('post')) {
			$file = $this->request->getData('biditem_img_path');
			$file_extension = strtolower(mb_substr(mb_strrchr($file['name'], "."), 1));
			if ($file_extension === 'png' || $file_extension === 'jpg' || $file_extension === 'jpeg') {
				$fileName = $biditem_img_name . '.' . $file_extension;
				$filePath = WWW_ROOT . 'img/biditem_images/' . $fileName;
				move_uploaded_file($file['tmp_name'], $filePath);
				$data = array(
					'user_id' => $this->request->getData('user_id'),
					'name' => $this->request->getData('name'),
					'finished' => $this->request->getData('finished'),
					'endtime' => $this->request->getData('endtime'),
					'biditem_info' => $this->request->getData('biditem_info'),
					'biditem_img_path' => $biditem_img_name . '.' . $file_extension,
				);

				// $biditemにフォームの送信内容を反映
				$biditem = $this->Biditems->patchEntity($biditem, $data);
				// $biditemを保存する
				if ($this->Biditems->save($biditem)) {
					// 成功時のメッセージ
					$this->Flash->success(__('保存しました。'));
					// トップページ（index）に移動
					return $this->redirect(['action' => 'index']);
				}
				// 失敗時のメッセージ
				$this->Flash->error(__('保存に失敗しました。もう一度入力下さい。'));
			} else {
				$this->Flash->error(__('拡張子はpng,jpg,jpegにして下さい。'));
				return $this->redirect(['action' => 'add']);
			}
		}
		// 値を保管
		$this->set(compact('biditem'));
	}

	// 入札の処理
	public function bid($biditem_id = null)
	{
		// 入札用のBidrequestインスタンスを用意
		$bidrequest = $this->Bidrequests->newEntity();
		// $bidrequestにbiditem_idとuser_idを設定
		$bidrequest->biditem_id = $biditem_id;
		$bidrequest->user_id = $this->Auth->user('id');
		// POST送信時の処理
		if ($this->request->is('post')) {
			// $bidrequestに送信フォームの内容を反映する
			$bidrequest = $this->Bidrequests->patchEntity($bidrequest, $this->request->getData());
			// Bidrequestを保存
			if ($this->Bidrequests->save($bidrequest)) {
				// 成功時のメッセージ
				$this->Flash->success(__('入札を送信しました。'));
				// トップページにリダイレクト
				return $this->redirect(['action' => 'view', $biditem_id]);
			}
			// 失敗時のメッセージ
			$this->Flash->error(__('入札に失敗しました。もう一度入力下さい。'));
		}
		// $biditem_idの$biditemを取得する
		$biditem = $this->Biditems->get($biditem_id);
		$this->set(compact('bidrequest', 'biditem'));
	}

	// 落札者とのメッセージ
	public function msg($bidinfo_id = null)
	{
		// Bidmessageを新たに用意
		$bidmsg = $this->Bidmessages->newEntity();
		// POST送信時の処理
		if ($this->request->is('post')) {
			// 送信されたフォームで$bidmsgを更新
			$bidmsg = $this->Bidmessages->patchEntity($bidmsg, $this->request->getData());
			// Bidmessageを保存
			if ($this->Bidmessages->save($bidmsg)) {
				$this->Flash->success(__('保存しました。'));
			} else {
				$this->Flash->error(__('保存に失敗しました。もう一度入力下さい。'));
			}
		}
		try { // $bidinfo_idからBidinfoを取得する
			$bidinfo = $this->Bidinfo->get($bidinfo_id, ['contain' => ['Biditems']]);
		} catch (Exception $e) {
			$bidinfo = null;
		}
		// Bidmessageをbidinfo_idとuser_idで検索
		$bidmsgs = $this->Bidmessages->find('all', [
			'conditions' => ['bidinfo_id' => $bidinfo_id],
			'contain' => ['Users'],
			'order' => ['created' => 'desc']
		]);
		$this->set(compact('bidmsgs', 'bidinfo', 'bidmsg'));
	}

	// 落札情報の表示
	public function home()
	{
		// 自分が落札したBidinfoをページネーションで取得
		$bidinfo = $this->paginate('Bidinfo', [
			'conditions' => ['Bidinfo.user_id' => $this->Auth->user('id')],
			'contain' => ['Users', 'Biditems'],
			'order' => ['created' => 'desc'],
			'limit' => 10
		])->toArray();
		$this->set(compact('bidinfo'));
	}

	// 出品情報の表示
	public function home2()
	{
		// 自分が出品したBiditemをページネーションで取得
		$biditems = $this->paginate('Biditems', [
			'conditions' => ['Biditems.user_id' => $this->Auth->user('id')],
			'contain' => ['Users', 'Bidinfo'],
			'order' => ['created' => 'desc'],
			'limit' => 10
		])->toArray();
		$this->set(compact('biditems'));
	}

	//list.ctpでの落札者か確認
	public function checkBidderId($id)
	{
		$n = $this->Bidinfo->find()->where(['user_id' => $id])->count();
		return ($n > 0);
	}

	//list.ctpでの出品者か確認
	public function checkBiditemId($id)
	{
		$n = $this->Bidinfo->find()->contain(['Biditems'])->where(['Biditems.user_id' => $id])->count();
		return ($n > 0);
	}

	//info.ctpでの落札者か確認
	public function infoCheckBidinfoId($user_id, $biderinfo_id)
	{
		$n = $this->Biderinfo->find()->contain(['Bidinfo'])->where(['Bidinfo.user_id' => $user_id])
			->andWhere(['Biderinfo.id' => $biderinfo_id])->count();
		return ($n > 0);
	}
	//info.ctpでの出品者か確認
	public function infoCheckBiditemId($user_id, $biderinfo_id)
	{
		$n = $this->Biditems->find()->contain(['Biderinfo', 'Bidinfo'])->where(['Biditems.user_id' => $user_id])
			->andWhere(['Biderinfo.id' => $biderinfo_id])->count();
		return ($n > 0);
	}

	public function list()
	{
		$result1 = 0;
		$result2 = 0;

		//落札した商品情報を持つか判定
		if ($this->checkBidderId($this->Auth->user('id'))) {
			$biderinfo_bider = $this->Bidinfo->find('all')
				->contain(['Biditems', 'Biderinfo'])->where(['Bidinfo.user_id' => $this->Auth->user('id')])
				->order(['Biderinfo.id' => 'ASC'])
				->all();
			$this->set(compact('biderinfo_bider'));
		} else {
			$result1 = "落札情報は存在しません";
		}
		$this->set(compact('result1'));

		//入札した情報を持つか判定
		if ($this->checkBiditemId($this->Auth->user('id'))) {
			$bideritems = $this->Bidinfo->find('all')
				->contain(['Biditems', 'Biderinfo'])->where(['Biditems.user_id' => $this->Auth->user('id')])
				->order(['Biderinfo.id' => 'ASC'])
				->all();
			$this->set(compact('bideritems'));
		} else {
			$result2 = "出品情報は存在しません";
		}
		$this->set(compact('result2'));
	}

	public function info($id = null)
	{
		$biderinfo_id = $this->Biderinfo->get($id)->id;

		//落札者:false 出品者:true 判定
		$isSeller = null;
		if ($this->infoCheckBidinfoId($this->Auth->user('id'), $biderinfo_id)) {
			$isSeller = false;
		} elseif ($this->infoCheckBiditemId($this->Auth->user('id'), $biderinfo_id)) {
			$isSeller = true;
		} else {
			//落札者でも出品者でもない場合indexに戻す
			return $this->redirect(['action' => 'index']);
		}

		//コメント、名前、日付取得
		$bidmsg = $this->Bidcontacts->find('all', [
			'conditions' => ['biderinfo_id' => $biderinfo_id],
			'contain' => ['Users'],
			'order' => ['created' => 'desc']
		]);

		//記入フラグ,id,発送受領受取管理
		$biderinfo = $this->Biderinfo->find('all', [
			'conditions' => ['id' => $biderinfo_id]
		])->first();

		//落札者 出品者で相手側のuser_idを取得
		if ($isSeller === false) {
			$partner_user_id = $this->Biditems->find('all')
				->contain(['Biderinfo'])->where(['Biderinfo.id' => $biderinfo_id])
				->first();
		} elseif ($isSeller === true) {
			$partner_user_id = $this->Bidinfo->find('all')
				->contain(['Biderinfo'])->where(['Biderinfo.id' => $biderinfo_id])
				->first();
		}

		$this->set(compact('isSeller', 'biderinfo', 'bidmsg', 'partner_user_id'));
	}

	public function infoadd()
	{
		$biderinfo_id = $this->request->getData('id');

		// POST送信時の処理
		if ($this->request->is('post')) {
			$biderinfo = $this->Biderinfo->get($this->request->getData('id'));
			// $biditemにフォームの送信内容を反映
			$biderinfo = $this->Biderinfo->patchEntity($biderinfo, $this->request->getData());
			// $biditemを保存する
			if ($this->Biderinfo->save($biderinfo)) {
				// 成功時のメッセージ
				$this->Flash->success(__('保存しました。'));
				// infoに移動
				return $this->redirect(['action' => 'info', $biderinfo_id]);
			}
			// 失敗時のメッセージ
			$this->Flash->error(__('保存に失敗しました。もう一度入力下さい。'));
		}
	}

	public function rewrite($id = null)
	{
		$biderinfo = $this->Biderinfo->get($id);
		$biderinfo->is_completed = 0;

		if ($this->Biderinfo->save($biderinfo)) {
			// 成功時のメッセージ
			$this->Flash->success(__('更新しました'));
			// infoに移動
			return $this->redirect(['action' => 'info', $biderinfo->id]);
		}
		// 失敗時のメッセージ
		$this->Flash->error(__('更新に失敗しました。'));
	}
	public function send($id = null)
	{
		$biderinfo = $this->Biderinfo->get($id);
		//発送済みに変更
		$biderinfo->is_sended = 1;
		if ($this->Biderinfo->save($biderinfo)) {
			// 成功時のメッセージ
			$this->Flash->success(__('更新しました'));
			// infoに移動
			return $this->redirect(['action' => 'info', $biderinfo->id]);
		}
		// 失敗時のメッセージ
		$this->Flash->error(__('更新に失敗しました。'));
	}

	public function receive($id = null)
	{
		$biderinfo = $this->Biderinfo->get($id);
		//受取済みに変更
		$biderinfo->is_received = 1;;

		if ($this->Biderinfo->save($biderinfo)) {
			// 成功時のメッセージ
			$this->Flash->success(__('更新しました'));
			// infoに移動
			return $this->redirect(['action' => 'info', $biderinfo->id]);
		}
		// 失敗時のメッセージ
		$this->Flash->error(__('更新に失敗しました。'));
	}

	public function comment()
	{
		$biderinfo_id = $this->request->getData('biderinfo_id');
		$bidmsg = $this->Bidcontacts->newEntity();
		// POST送信時の処理
		if ($this->request->is('post')) {
			$bidmsg = $this->Bidcontacts->patchEntity($bidmsg, $this->request->getData());
			// Bidmessageを保存
			if ($this->Bidcontacts->save($bidmsg)) {
				$this->Flash->success(__('保存しました。'));
			} else {
				$this->Flash->error(__('保存に失敗しました。もう一度入力下さい。'));
			}
		}
		return $this->redirect(['action' => 'info', $biderinfo_id]);
	}
}
