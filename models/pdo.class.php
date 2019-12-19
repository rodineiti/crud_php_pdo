<?php
/**
 * [ php config ] Altera modo de erro e exibi��o do var_dump.
 * display_errors: Erros devem ser exibidos.
 * error_reporting: Todos os tipos de erros
 * overload_var_dump: Omitir a linha de caminho do var_dump.
 */
ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL);
ini_set('xdebug.overload_var_dump', 1);

/**
 * Classe de conex�o ao banco de dados usando PDO no padr�o Singleton.
 * Modo de Usar:
 * require_once './Database.class.php';
 * $db = Database::conexao();
 * E agora use as fun��es do PDO (prepare, query, exec) em cima da vari�vel $db.
 */
class Database
{
    # Vari�vel que guarda a conex�o PDO.
    protected static $db;
    # Private construct - garante que a classe s� possa ser instanciada internamente.
    private function __construct()
    {
        # Informa��es sobre o banco de dados:
        $db_host = "";
        $db_nome = "";
        $db_usuario = "";
        $db_senha = "";
        $db_driver = "mysql";

        try
        {
            # Atribui o objeto PDO � vari�vel $db.
            self::$db = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
            # Garante que o PDO lance exce��es durante erros.
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            # Garante que os dados sejam armazenados com codifica��o UFT-8.
            self::$db->exec('SET NAMES utf8');
        }
        catch (PDOException $e)
        {
            # Envia um e-mail para o e-mail oficial do sistema, em caso de erro de conex�o.
            //mail($email, "PDOException em $titulo", $e->getMessage());
            # Ent�o n�o carrega nada mais da p�gina.
            die("Connection Error: " . $e->getMessage());
        }
    }
    # M�todo est�tico - acess�vel sem instancia��o.
    public static function conexao()
    {
        # Garante uma �nica inst�ncia. Se n�o existe uma conex�o, criamos uma nova.
        if (!self::$db)
        {
            new Database();
        }
        # Retorna a conex�o.
        return self::$db;
    }
}