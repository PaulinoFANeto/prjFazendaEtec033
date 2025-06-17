CREATE DATABASE fazendaEtec;
USE fazendaEtec;

-- Tabela usuarios
CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  senha VARCHAR(250) NOT NULL,
  email VARCHAR(100) NOT NULL,
  nivel_acesso TINYINT NOT NULL DEFAULT 0,
  data_cadastro DATETIME DEFAULT NULL,
  UNIQUE (email),
  UNIQUE (nome),
  CHECK (nivel_acesso BETWEEN 0 AND 3)
);

-- Demais tabelas corrigidas (alterando os pontos citados)

CREATE TABLE logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT,
  tabela VARCHAR(50),
  acao ENUM('inclusao', 'exclusao', 'alteracao', 'consulta'),
  data_acao DATETIME,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50),
  raca VARCHAR(50),
  peso DECIMAL(6,2),
  data_nascimento DATE,
  data_entrada DATE,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE partos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT,
  data_prevista_parto DATE,
  data_efetiva_parto DATE,
  data_prevista_desmame DATE,
  data_efetiva_desmame DATE,
  data_prevista_maternidade DATE,
  data_efetiva_maternidade DATE,
  qtd_crias INT,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  parto_id INT,
  nome VARCHAR(50),
  raca VARCHAR(50),
  sexo ENUM('Macho', 'Femea') NOT NULL,
  peso_nascimento DECIMAL(5,2),
  data_nascimento DATE,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (parto_id) REFERENCES partos(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE movimentacao_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  baia_origem VARCHAR(50),
  baia_destino VARCHAR(50) NOT NULL,
  motivo VARCHAR(100),
  data_movimentacao DATE NOT NULL,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE status_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  status ENUM('Leitao', 'Marra', 'Barrao', 'Matriz', 'Cachaco', 'Descarte', 'Venda') NOT NULL,
  baia VARCHAR(50),
  peso DECIMAL(5,2),
  motivo TEXT,
  data_status DATE NOT NULL,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE baias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  descricao TEXT,
  capacidade INT NOT NULL,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE baia_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  baia_id INT NOT NULL,
  data_entrada DATE NOT NULL,
  data_saida DATE,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (baia_id) REFERENCES baias(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE vacinas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50),
  descricao TEXT,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE vacinas_matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT,
  vacina_id INT,
  data_aplicacao DATE,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (vacina_id) REFERENCES vacinas(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE vacinas_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT,
  vacina_id INT,
  data_aplicacao DATE,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (vacina_id) REFERENCES vacinas(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE procedimentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50),
  descricao TEXT,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE procedimentos_matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT,
  procedimento_id INT,
  data_procedimento DATE,
  descricao TEXT,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (procedimento_id) REFERENCES procedimentos(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE procedimentos_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT,
  procedimento_id INT,
  data_procedimento DATE,
  descricao TEXT,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (procedimento_id) REFERENCES procedimentos(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE alimentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50),
  descricao TEXT,
  tipo_alimento VARCHAR(50),
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE alimentacao_matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT,
  alimento_id INT,
  quantidade DECIMAL(5,2),
  data_alimentacao DATE,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (alimento_id) REFERENCES alimentos(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE alimentacao_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT,
  alimento_id INT,
  quantidade DECIMAL(5,2),
  data_alimentacao DATE,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (alimento_id) REFERENCES alimentos(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE pesagem_matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT,
  peso DECIMAL(6,2),
  data_pesagem DATE,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE pesagem_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT,
  peso DECIMAL(5,2),
  data_pesagem DATE,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE coberturas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT,
  data_cobertura DATE,
  tipo_cobertura VARCHAR(25) NOT NULL,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE configuracoes (
  id TINYINT PRIMARY KEY CHECK (id = 1),
  dia_previsto_gestacao INT,
  dia_preparacao_parto INT,
  dia_previsto_desmame INT,
  dia_aplicacao_ferro1 INT,
  dia_aplicacao_ferro2 INT,
  dia_desbaste_dentes INT,
  dia_desbaste_cauda INT,
  dia_aplicacao_baycox1 INT,
  dia_aplicacao_baycox2 INT,
  dia_comportamento INT,
  usuario_id INT,
  data_acao DATETIME,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
