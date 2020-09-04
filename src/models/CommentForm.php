<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CommentForm extends Model
{
    public $name;

    public $email;

    public $body;

    public $news_id;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'body', 'news_id'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            ['news_id', 'integer'],
        ];
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @return bool whether the model passes validation
     */
    public function save()
    {
        if ($this->validate()) {
            $comment = new Comment();
            $comment->news_id = $this->news_id;
            $comment->content = $this->body;
            $comment->email = $this->email;
            $comment->name = $this->name;

            return $comment->save();
        }

        return false;
    }
}
