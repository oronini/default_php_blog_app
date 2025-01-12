<?php
require_once(__DIR__ . '/../config/env.php');
// require_once('env.php');
Class Dbc {
  protected $table_name;

  protected function dbConnect() {
    $host = DB_HOST;
    $dbname = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

    try {
      $dbh = new \PDO($dsn,$user,$pass,[
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
      ]);
    } catch (\PDOException $e) {
      echo '接続失敗'.$e->getMessage();
      exit();
    };

      return $dbh;
    }

    public function getAll() {
      $dbh = $this->dbConnect();
      // 1:SQLの準備
      $sql = "SELECT * FROM $this->table_name";
      // 2:SQLの実行
      $stmt = $dbh->query($sql);
      // 3:SQLの結果を受け取る
      $result = $stmt->fetchall(\PDO::FETCH_ASSOC);
      return $result;
      $dbh = null;
    }



  public function getById($id) {
    if (empty($id)) {
      exit('idが不正です。');
    }

    $dbh = $this->dbConnect();

    $stmt = $dbh->prepare("SELECT * FROM $this->table_name WHERE id = :id");
    $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);

    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);

    if(!$result) {
      exit('ブログがありません。');
    }

    return $result;
  }

  public function delete($id) {
    if (empty($id)) {
      exit('idが不正です。');
    }

    $dbh = $this->dbConnect();

    $stmt = $dbh->prepare("DELETE FROM $this->table_name WHERE id = :id");
    $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);

    $stmt->execute();
    echo 'ブログを削除しました。';
  }

}
?>

