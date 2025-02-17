<?php
require_once __DIR__ . '/../config/database.php';

class Doadores {
    private $conn;
    private $table_name = "doadores";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function criarDoador($dados) {
        try {
            $sql = "INSERT INTO " . $this->table_name . " 
                (nome, email, cpf, telefone, data_nascimento, intervalo_doacao, valor_doacao, forma_pagamento, 
                conta_debito, bandeira_cartao, cartao_prefixo, cartao_sufixo, endereco) 
                VALUES (:nome, :email, :cpf, :telefone, :data_nascimento, :intervalo_doacao, :valor_doacao, 
                :forma_pagamento, :conta_debito, :bandeira_cartao, :cartao_prefixo, :cartao_sufixo, :endereco)";

            $stmt = $this->conn->prepare($sql);

            // Verificação do cartão de crédito (evitar duplicação)
            if ($dados['forma_pagamento'] == 'Crédito') {
                $check_sql = "SELECT id FROM " . $this->table_name . " WHERE cartao_prefixo = :cartao_prefixo AND cartao_sufixo = :cartao_sufixo";
                $check_stmt = $this->conn->prepare($check_sql);
                $check_stmt->execute([
                    ':cartao_prefixo' => $dados['cartao_prefixo'],
                    ':cartao_sufixo' => $dados['cartao_sufixo']
                ]);
                if ($check_stmt->rowCount() > 0) {
                    return "Não foi possível cadastrar esse número de cartão, entre em contato com o seu supervisor.";
                }
            }

            // Bind dos valores
            $stmt->execute([
                ':nome' => $dados['nome'],
                ':email' => $dados['email'],
                ':cpf' => $dados['cpf'],
                ':telefone' => $dados['telefone'],
                ':data_nascimento' => $dados['data_nascimento'],
                ':intervalo_doacao' => $dados['intervalo_doacao'],
                ':valor_doacao' => $dados['valor_doacao'],
                ':forma_pagamento' => $dados['forma_pagamento'],
                ':conta_debito' => $dados['conta_debito'] ?? null,
                ':bandeira_cartao' => $dados['bandeira_cartao'] ?? null,
                ':cartao_prefixo' => $dados['cartao_prefixo'] ?? null,
                ':cartao_sufixo' => $dados['cartao_sufixo'] ?? null,
                ':endereco' => $dados['endereco']
            ]);

            return "<script>
                        alert('Doador cadastrado com sucesso!');
                        window.location.href = '../Views/index.php';
                    </script>";

        } catch (PDOException $e) {
            return "Erro ao cadastrar: " . $e->getMessage();
        }
    }
    public function listarDoadores() {
        try {
            if (!$this->conn) {
                throw new Exception("Conexão com o banco de dados não está inicializada.");
            }
    
            if (empty($this->table_name)) {
                throw new Exception("Nome da tabela não foi definido.");
            }
    
            $sql = "SELECT * FROM " . $this->table_name . " ORDER BY data_cadastro DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao listar doadores: " . $e->getMessage());
            return [];
        }
    }
    
    
    public function atualizarDoador($id, $dados) {
        try {
            $sql = "UPDATE " . $this->table_name . " 
                    SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone, 
                        data_nascimento = :data_nascimento, intervalo_doacao = :intervalo_doacao, 
                        valor_doacao = :valor_doacao, forma_pagamento = :forma_pagamento, 
                        conta_debito = :conta_debito, bandeira_cartao = :bandeira_cartao, 
                        cartao_prefixo = :cartao_prefixo, cartao_sufixo = :cartao_sufixo, endereco = :endereco
                    WHERE id = :id";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':nome' => $dados['nome'],
                ':email' => $dados['email'],
                ':cpf' => $dados['cpf'],
                ':telefone' => $dados['telefone'],
                ':data_nascimento' => $dados['data_nascimento'],
                ':intervalo_doacao' => $dados['intervalo_doacao'],
                ':valor_doacao' => $dados['valor_doacao'],
                ':forma_pagamento' => $dados['forma_pagamento'],
                ':conta_debito' => $dados['conta_debito'] ?? null,
                ':bandeira_cartao' => $dados['bandeira_cartao'] ?? null,
                ':cartao_prefixo' => $dados['cartao_prefixo'] ?? null,
                ':cartao_sufixo' => $dados['cartao_sufixo'] ?? null,
                ':endereco' => $dados['endereco']
            ]);
            
            return "<script>
                    alert('Doador atualizado com sucesso!');
                    window.location.href = '../Views/index.php';
                    </script>";
        } catch (PDOException $e) {
            return "Erro ao atualizar: " . $e->getMessage();
        }
    }
    
    
    public function deletarDoador($id) {
        try {
            $sql = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
    
            return "Doador excluído com sucesso!";
        } catch (PDOException $e) {
            return "Erro ao excluir: " . $e->getMessage();
        }
    }
}

?>
