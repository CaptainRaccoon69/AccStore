<?php

namespace app\models;

use yii\base\Model;

class Ticket extends model {

    public $id;
    public $user_id;
    public $subject;
    public $status;
    public $date;
    public $message;
    public $response;

    public function rules() {
        return [
                [['user_id', 'subject', 'message'], 'required'],
                [['response'], 'string'],
                [['id'], 'integer']
        ];
    }

    public function addTicket(){
        $ticket = new Tickets();
        $this->status = "new";
        $ticket->user_id = $this->user_id;
        $ticket->subject = $this->subject;
        $ticket->status = $this->status;
        $ticket->message = $this->message;
        return $ticket->save();
    }

    public function responseTicket(){
        $ticket = Tickets::getTicketById($this->id);
        $ticket->response = $this->response;
        $this->status = "close";
        return $ticket->save();
    }



}
