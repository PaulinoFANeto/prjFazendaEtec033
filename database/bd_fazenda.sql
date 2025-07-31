-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS fazenda_etec;
USE fazenda_etec;

-- Tabela: usuários
CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL UNIQUE,
  senha VARCHAR(250) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  nivel_acesso TINYINT NOT NULL CHECK (nivel_acesso BETWEEN 0 AND 3),
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela: tipos_acao
CREATE TABLE IF NOT EXISTS tipos_acao (
  id TINYINT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(20) NOT NULL UNIQUE -- Ex: "inclusao", "exclusao", "alteracao", "consulta"
);

INSERT INTO tipos_acao (nome) VALUES
  ('inclusao'),
  ('exclusao'),
  ('alteracao'),
  ('consulta');

-- Tabela: logs
CREATE TABLE IF NOT EXISTS logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT,
  tabela VARCHAR(50),
  tipo_acao_id TINYINT,
  detalhes TEXT,
  data_acao DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
  FOREIGN KEY (tipo_acao_id) REFERENCES tipos_acao(id)
);

-- Tabela auxiliar para finalidade
CREATE TABLE finalidade (
  id TINYINT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(20) NOT NULL UNIQUE
);

INSERT INTO finalidade (nome) VALUES
  ('Corte'),
  ('Reprodução'),
  ('Dupla Aptidão'),
  ('Pesquisa');

-- Tabela auxiliar para tipo de orelha
CREATE TABLE tipos_orelha (
  id TINYINT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(20) NOT NULL UNIQUE
);

INSERT INTO tipos_orelha (nome) VALUES
  ('Ereta'),
  ('Caída'),
  ('Mista');

-- Tabela principal de raças suínas
CREATE TABLE racas_suinas (
  id TINYINT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL UNIQUE,
  origem VARCHAR(100),
  finalidade_id TINYINT NOT NULL,
  descricao TEXT,
  FOREIGN KEY (finalidade_id) REFERENCES finalidade(id)
);

-- Tabela: matrizes
CREATE TABLE IF NOT EXISTS matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  raca_id TINYINT,
  data_nascimento DATE,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (raca_id) REFERENCES racas_suinas(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: partos
CREATE TABLE IF NOT EXISTS partos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT,
  data_prevista_parto DATE,
  data_efetiva_parto DATE,
  data_prevista_desmame DATE,
  data_efetiva_desmame DATE,
  data_prevista_maternidade DATE,
  data_efetiva_maternidade DATE,
  qtd_crias INT,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: tipos_baia
CREATE TABLE IF NOT EXISTS tipos_baia (
  id TINYINT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(30) NOT NULL UNIQUE -- Ex: "Gestação", "Maternidade", "Desmame"
);

INSERT INTO tipos_baia (nome) VALUES
  ('Baia de Gestação'),
  ('Baia de Maternidade'),
  ('Baia de Desmame'),
  ('Baia de Crias'),
  ('Baia de Engorda'),
  ('Baia de Quarentena'),
  ('Baia de Tratamento'),
  ('Baia de Isolamento'),
  ('Baia de Vendas'),
  ('Baia de Descarte'),
  ('Baia de Morte'),
  ('Baia de espera'),
  ('Baia de manejo'),
  ('Baia de Reprodução');

-- Tabela: baias
CREATE TABLE IF NOT EXISTS baias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  tipo_baia_id TINYINT,
  descricao TEXT,
  capacidade INT NOT NULL CHECK (capacidade >= 0),
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (tipo_baia_id) REFERENCES tipos_baia(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: tipos_sexo
CREATE TABLE IF NOT EXISTS tipos_sexo (
  id TINYINT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(10) NOT NULL UNIQUE -- Ex: "Macho", "Fêmea"
);

INSERT INTO tipos_sexo (nome) VALUES
  ('Macho'),
  ('Fêmea');

-- Tabela: tipos_status
CREATE TABLE IF NOT EXISTS tipos_status (
  id TINYINT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(20) NOT NULL UNIQUE -- Ex: "Ativo", "Inativo", "Em tratamento"
); 

INSERT INTO tipos_status (nome) VALUES
  ('Ativo'),
  ('Inativo'),
  ('Em tratamento'),
  ('Descarte'),
  ('Venda'),
  ('Morte');

-- Tabela: crias
CREATE TABLE IF NOT EXISTS crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  parto_id INT,
  nome VARCHAR(50) NOT NULL,
  raca_id TINYINT,
  tipo_sexo_id TINYINT,
  peso_nascimento DECIMAL(5,2) CHECK (peso_nascimento >= 0),
  data_nascimento DATE,
  tipo_status_id TINYINT,
  baia_id INT,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (parto_id) REFERENCES partos(id),
  FOREIGN KEY (raca_id) REFERENCES racas_suinas(id),
  FOREIGN KEY (tipo_sexo_id) REFERENCES tipos_sexo(id),
  FOREIGN KEY (tipo_status_id) REFERENCES tipos_status(id),
  FOREIGN KEY (baia_id) REFERENCES baias(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: vacinas
CREATE TABLE IF NOT EXISTS vacinas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  descricao TEXT,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: vacinas_matrizes
CREATE TABLE IF NOT EXISTS vacinas_matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT NOT NULL,
  vacina_id INT NOT NULL,
  data_aplicacao DATE NOT NULL,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (vacina_id) REFERENCES vacinas(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: vacinas_crias
CREATE TABLE IF NOT EXISTS vacinas_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  vacina_id INT NOT NULL,
  data_aplicacao DATE NOT NULL,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (vacina_id) REFERENCES vacinas(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: procedimentos
CREATE TABLE IF NOT EXISTS procedimentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  descricao TEXT,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: procedimentos_matrizes
CREATE TABLE IF NOT EXISTS procedimentos_matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT NOT NULL,
  procedimento_id INT NOT NULL,
  data_procedimento DATE NOT NULL,
  descricao TEXT,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (procedimento_id) REFERENCES procedimentos(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: procedimentos_crias
CREATE TABLE IF NOT EXISTS procedimentos_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  procedimento_id INT NOT NULL,
  data_procedimento DATE NOT NULL,
  descricao TEXT,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (procedimento_id) REFERENCES procedimentos(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: alimentos
CREATE TABLE IF NOT EXISTS alimentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL UNIQUE,
  descricao TEXT,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: alimentação_matrizes
CREATE TABLE IF NOT EXISTS alimentacao_matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT NOT NULL,
  alimento_id INT NOT NULL,
  quantidade DECIMAL(5,2) CHECK (quantidade >= 0),
  data_alimentacao DATE NOT NULL,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (alimento_id) REFERENCES alimentos(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: alimentação_crias
CREATE TABLE IF NOT EXISTS alimentacao_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  alimento_id INT NOT NULL,
  quantidade DECIMAL(5,2) CHECK (quantidade >= 0),
  data_alimentacao DATE NOT NULL,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (alimento_id) REFERENCES alimentos(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: pesagem_matrizes
CREATE TABLE IF NOT EXISTS pesagem_matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT NOT NULL,
  peso DECIMAL(6,2) CHECK (peso >= 0),
  data_pesagem DATE NOT NULL,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: pesagem_crias
CREATE TABLE IF NOT EXISTS pesagem_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  peso DECIMAL(5,2) CHECK (peso >= 0),
  data_pesagem DATE NOT NULL,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: movimentacao_matrizes
CREATE TABLE IF NOT EXISTS movimentacao_matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT NOT NULL,
  baia_origem_id INT,
  baia_destino_id INT NOT NULL,
  motivo VARCHAR(100),
  data_movimentacao DATE NOT NULL,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (baia_origem_id) REFERENCES baias(id),
  FOREIGN KEY (baia_destino_id) REFERENCES baias(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: movimentacao_crias
CREATE TABLE IF NOT EXISTS movimentacao_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  baia_origem_id INT,
  baia_destino_id INT NOT NULL,
  motivo VARCHAR(100),
  data_movimentacao DATE NOT NULL,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (baia_origem_id) REFERENCES baias(id),
  FOREIGN KEY (baia_destino_id) REFERENCES baias(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: status_matrizes
CREATE TABLE IF NOT EXISTS status_matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT NOT NULL,
  status_id TINYINT NOT NULL,
  motivo TEXT,
  data_status DATE NOT NULL,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (status_id) REFERENCES tipos_status(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: status_crias
CREATE TABLE IF NOT EXISTS status_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  status_id TINYINT NOT NULL,
  motivo TEXT,
  data_status DATE NOT NULL,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (status_id) REFERENCES tipos_status(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: baias_matrizes
CREATE TABLE IF NOT EXISTS baia_matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT NOT NULL,
  baia_id INT NOT NULL,
  data_entrada DATE NOT NULL,
  data_saida DATE,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (baia_id) REFERENCES baias(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: baias_crias
CREATE TABLE IF NOT EXISTS baia_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  baia_id INT NOT NULL,
  data_entrada DATE NOT NULL,
  data_saida DATE,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (baia_id) REFERENCES baias(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: tipos_cobertura
CREATE TABLE IF NOT EXISTS tipos_cobertura (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(30) NOT NULL UNIQUE -- Ex: "Natural", "Artificial", "Inseminação Artificial"
);

INSERT INTO tipos_cobertura (nome) VALUES
  ('Natural'),
  ('Artificial'),
  ('Inseminação Artificial');

-- Tabela: coberturas
CREATE TABLE IF NOT EXISTS coberturas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT NOT NULL,
  data_cobertura DATE NOT NULL,
  tipo_cobertura_id INT NOT NULL,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (tipo_cobertura_id) REFERENCES tipos_cobertura(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: configuracoes
CREATE TABLE IF NOT EXISTS configuracoes (
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
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: reprodutores
CREATE TABLE IF NOT EXISTS reprodutores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  raca_id TINYINT,
  origem VARCHAR(100),
  data_nascimento DATE,
  status_id TINYINT,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME,
  data_atualizacao DATETIME,
  FOREIGN KEY (raca_id) REFERENCES racas_suinas(id),
  FOREIGN KEY (status_id) REFERENCES tipos_status(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: tipos_evento
CREATE TABLE IF NOT EXISTS tipos_evento (
  id TINYINT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(30) NOT NULL UNIQUE -- Ex: "Vacinação", "Tratamento", "Desinfecção"
);  

INSERT INTO tipos_evento (nome) VALUES
  ('Vacinação'),
  ('Tratamento'),
  ('Desinfecção');

-- Tabela: eventos_sanitários
CREATE TABLE IF NOT EXISTS eventos_sanitarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tipo_evento_id TINYINT,
  descricao TEXT,
  data_inicio DATE,
  data_fim DATE,
  afetou_matrizes BOOLEAN DEFAULT FALSE,
  afetou_crias BOOLEAN DEFAULT FALSE,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME,
  data_atualizacao DATETIME,
  FOREIGN KEY (tipo_evento_id) REFERENCES tipos_evento(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: lotes
CREATE TABLE IF NOT EXISTS lotes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  identificador VARCHAR(50) NOT NULL UNIQUE,
  descricao TEXT,
  data_inicio DATE,
  data_fim DATE,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME,
  data_atualizacao DATETIME,
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: crias_lotes
CREATE TABLE IF NOT EXISTS crias_lotes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  lote_id INT NOT NULL,
  data_entrada DATE NOT NULL,
  data_saida DATE,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME,
  data_atualizacao DATETIME,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (lote_id) REFERENCES lotes(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: mortalidade_matrizes
CREATE TABLE IF NOT EXISTS mortalidade_matrizes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  matriz_id INT NOT NULL,
  data_ocorrencia DATE NOT NULL,
  causa TEXT,
  observacoes TEXT,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME,
  data_atualizacao DATETIME,
  FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: mortalidade_crias
CREATE TABLE IF NOT EXISTS mortalidade_crias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  data_ocorrencia DATE NOT NULL,
  causa TEXT,
  observacoes TEXT,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME,
  data_atualizacao DATETIME,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: clientes
CREATE TABLE IF NOT EXISTS clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  documento VARCHAR(20),
  telefone VARCHAR(20),
  email VARCHAR(100),
  endereco TEXT,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME,
  data_atualizacao DATETIME,
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: vendas
CREATE TABLE IF NOT EXISTS vendas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cria_id INT NOT NULL,
  cliente_id INT NOT NULL,
  data_venda DATE NOT NULL,
  preco DECIMAL(10,2),
  observacoes TEXT,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME,
  data_atualizacao DATETIME,
  FOREIGN KEY (cria_id) REFERENCES crias(id),
  FOREIGN KEY (cliente_id) REFERENCES clientes(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Tabela: tipos_financeiro
CREATE TABLE IF NOT EXISTS tipos_financeiro (
  id TINYINT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(20) NOT NULL UNIQUE -- Ex: "Entrada", "Saída"
);

INSERT INTO tipos_financeiro (nome) VALUES
  ('Entrada'),
  ('Saída');

-- Tabela: financeiro (Entradas e Saídas)
CREATE TABLE IF NOT EXISTS financeiro (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tipo_financeiro_id TINYINT,
  categoria VARCHAR(100),
  descricao TEXT,
  valor DECIMAL(10,2) NOT NULL,
  data_movimentacao DATE NOT NULL,
  usuario_criacao_id INT,
  usuario_atualizacao_id INT,
  data_criacao DATETIME,
  data_atualizacao DATETIME,
  FOREIGN KEY (tipo_financeiro_id) REFERENCES tipos_financeiro(id),
  FOREIGN KEY (usuario_criacao_id) REFERENCES usuarios(id),
  FOREIGN KEY (usuario_atualizacao_id) REFERENCES usuarios(id)
);

-- Características produtivas
CREATE TABLE caracteristicas_produtivas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  raca_id TINYINT NOT NULL,
  ganho_peso_diario DECIMAL(5,2),
  conversao_alimentar DECIMAL(4,2),
  idade_abate INT,
  rendimento_carcaca DECIMAL(5,2),
  qualidade_carne TEXT,
  FOREIGN KEY (raca_id) REFERENCES racas_suinas(id)
);

-- Características reprodutivas
CREATE TABLE caracteristicas_reprodutivas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  raca_id TINYINT NOT NULL,
  tamanho_leitegada_medio DECIMAL(4,2),
  intervalo_partos INT,
  habilidade_materna TEXT,
  FOREIGN KEY (raca_id) REFERENCES racas_suinas(id)
);

-- Características morfológicas
CREATE TABLE caracteristicas_morfologicas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  raca_id TINYINT NOT NULL,
  cor_pelo VARCHAR(50),
  tipo_orelha_id TINYINT,
  peso_medio_adulto DECIMAL(5,2),
  observacoes TEXT,
  FOREIGN KEY (raca_id) REFERENCES racas_suinas(id),
  FOREIGN KEY (tipo_orelha_id) REFERENCES tipos_orelha(id)
);

-- Resistência e adaptação
CREATE TABLE resistencia_adaptacao (
  id INT AUTO_INCREMENT PRIMARY KEY,
  raca_id TINYINT NOT NULL,
  resistencia_doencas TEXT,
  adaptacao_climatica TEXT,
  comportamento TEXT,
  FOREIGN KEY (raca_id) REFERENCES racas_suinas(id)
);
