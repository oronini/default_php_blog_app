
<?php
require_once('dbc.php');

Class Blog extends Dbc {
  protected $table_name = 'blog';

  public function setCategoryName($category){
    if ($category === '1') {
      return '日常';
    } else if ($category === '2') {
    return 'プログラミング';
    }else{
      return 'その他';
    }
  }

  public function blogCreate($blogs) {
    $spl = "INSERT INTO
              $this->table_name(title, content, category, publish_status, post_at)
            VALUES
              (:title, :content, :category, :publish_status, NOW())";

        $dbh = $this->dbConnect();
        $dbh->beginTransaction();
        try {
          $stmt = $dbh->prepare($spl);
          $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
          $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
          $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
          $stmt->bindValue(':publish_status', $blogs['publish_status'], PDO::PARAM_INT);
          $stmt->execute();
          $dbh->commit();
          echo 'ブログを投稿しました。';
        } catch(PDOException $e) {
          $dbh->rollBack();
          exit($e);
        }
    }

    public function blogUpdate($blogs) {
      $spl = "UPDATE $this->table_name  SET
                title = :title, content = :content, category = :category, publish_status = :publish_status
      WHERE
        id = :id";

      $dbh = $this->dbConnect();
      $dbh->beginTransaction();
      try {
        $stmt = $dbh->prepare($spl);
        $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
        $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
        $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
        $stmt->bindValue(':publish_status', $blogs['publish_status'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $blogs['id'], PDO::PARAM_INT);
        $stmt->execute();
        $dbh->commit();
        echo 'ブログを更新しました。';
      } catch(PDOException $e) {
        $dbh->rollBack();
        exit($e);
      }
    }

    public function h($s) {
      return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
    }



    // ブログのバリデーション
    public function blogValidate($blogs) {
      if (empty($blogs['title'])) {
        exit('タイトルを入力してください。');
      }

      if(mb_strlen($blogs['title']) > 191 ) {
        exit('タイトルを191文字以内にしてください。');
      }

      if (empty($blogs['content'])) {
        exit('本文を入力してください。');
      }
      if (empty($blogs['category'])) {
        exit('カテゴリーを選択してください。');
      }
      if (empty($blogs['publish_status'])) {
        exit('公開ステータスを選択してください。');
      }
      }
}
?>


