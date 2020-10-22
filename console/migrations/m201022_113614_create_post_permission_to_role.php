<?php

use yii\db\Migration;

/**
 * Class m201022_113614_create_post_permission_to_role
 */
class m201022_113614_create_post_permission_to_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $author = $auth->getRole('author');
        $admin = $auth->getRole('admin');
        $superadmin = $auth->getRole('superadmin');

        $listPost = $auth->getPermission('post-index');
        $createPost = $auth->getPermission('post-create');
        $updatePost = $auth->getPermission('post-update');
        $viewPost = $auth->getPermission('post-view');
        $deletePost = $auth->getPermission('post-delete');

        //assign

        $auth->addChild($author,$createPost);
        $auth->addChild($author,$listPost);
        $auth->addChild($author,$viewPost);
        $auth->addChild($author,$updatePost);

        $auth->addChild($admin,$author);

        $auth->addChild($superadmin,$admin);
        $auth->addChild($superadmin,$deletePost);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        
        $createPost = $auth->getPermission('post-create');
        if($createPost){
            $auth->remove($createPost);
        }

        $listPost= $auth->getPermission('post-index');
        if($listPost){
            $auth->remove($listPost);
        }

        $viewPost = $auth->getPermission('post-view');
        if($viewPost){
            $auth->remove($viewPost);
        }

        $updatePost = $auth->getPermission('post-update');
        if($updatePost){
            $auth->remove($updatePost);
        }

        $deletePost = $auth->getPermission('post-delete');
        if($deletePost){
            $auth->remove($deletePost);
        }

        $author = $auth->getRole('author');
        if($author){
            $auth->remove($author);
        }

        
        $admin = $auth->getRole('admin');
        if($admin){
            $auth->remove($admin);
        }


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201022_113614_create_post_permission_to_role cannot be reverted.\n";

        return false;
    }
    */
}
