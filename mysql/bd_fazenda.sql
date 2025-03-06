CREATE DATABASE fazendaEtec;

USE fazendaEtec;

CREATE TABLE usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nomeUsuario VARCHAR(50) NOT NULL,
    senhaUsuario VARCHAR(255) NOT NULL,
    emailUsuario VARCHAR(100) UNIQUE NOT NULL,
    nivelAcessoUsuario ENUM('Administrador', 'Auxiliar docente', 'Professor', 'Aluno') NOT NULL,
    dataCadastroUsuario DATE
);

// A atbela de suinos ainda precisa ser aprimorada
CREATE TABLE suinos (
    idSuino INT AUTO_INCREMENT PRIMARY KEY,
    nomeSuino VARCHAR(50),
    tipoSuino ENUM('Matriz', 'Cachaço', 'Leitão', 'Marrã', 'Barrão', 'Terminação'),
    idadeSuino INT(2),
    brincoSuino VARCHAR(5),
);

### 1. Tabela `matrizes`
CREATE TABLE matrizes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    raça VARCHAR(50),
    peso DECIMAL(5,2),
    data_nascimento DATE,
    data_entrada DATE
);

### 2. Tabela `partos`
CREATE TABLE partos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriz_id INT,
    data_parto DATE,
    data_desmame DATE,
    FOREIGN KEY (matriz_id) REFERENCES matrizes(id)
);

### 3. Tabela `crias`
CREATE TABLE crias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parto_id INT,
    nome VARCHAR(50),
    peso_nascimento DECIMAL(5,2),
    data_nascimento DATE,
    FOREIGN KEY (parto_id) REFERENCES partos(id)
);

### 4. Tabela `vacinas`
CREATE TABLE vacinas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    descricao TEXT
);

### 5. Tabela `vacinas_matrizes`
CREATE TABLE vacinas_matrizes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriz_id INT,
    vacina_id INT,
    data_aplicacao DATE,
    FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
    FOREIGN KEY (vacina_id) REFERENCES vacinas(id)
);

### 6. Tabela `vacinas_crias`
CREATE TABLE vacinas_crias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cria_id INT,
    vacina_id INT,
    data_aplicacao DATE,
    FOREIGN KEY (cria_id) REFERENCES crias(id),
    FOREIGN KEY (vacina_id) REFERENCES vacinas(id)
);

### 7. Tabela `procedimentos`
CREATE TABLE procedimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    descricao TEXT
);

### 8. Tabela `procedimentos_crias`
CREATE TABLE procedimentos_crias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cria_id INT,
    procedimento_id INT,
    data_procedimento DATE,
    descricao TEXT,
    FOREIGN KEY (cria_id) REFERENCES crias(id),
    FOREIGN KEY (procedimento_id) REFERENCES procedimentos(id)
);

### 9. Tabela `alimentacao_matrizes`
CREATE TABLE alimentacao_matrizes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriz_id INT,
    tipo_alimento VARCHAR(50),
    quantidade DECIMAL(5,2),
    data DATE,
    FOREIGN KEY (matriz_id) REFERENCES matrizes(id)
);

### 10. Tabela `pesagem_matrizes`
CREATE TABLE pesagem_matrizes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriz_id INT,
    peso DECIMAL(5,2),
    data DATE,
    FOREIGN KEY (matriz_id) REFERENCES matrizes(id)
);

### 11. Tabela `coberturas`
CREATE TABLE coberturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriz_id INT,
    data_cobertura DATE,
    FOREIGN KEY (matriz_id) REFERENCES matrizes(id)
);
