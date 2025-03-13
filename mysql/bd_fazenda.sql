CREATE DATABASE fazendaEtec;

USE fazendaEtec;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    senha VARCHAR(20) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    nivel_acesso ENUM('Administrador', 'Auxiliar docente', 'Professor', 'Aluno') NOT NULL,
    data_cadastro DATE
);

CREATE TABLE matrizes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    raça VARCHAR(50),
    peso DECIMAL(5,2),
    data_nascimento DATE,
    data_entrada DATE
);

CREATE TABLE partos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriz_id INT,
    data_parto DATE,
    data_desmame DATE,
    FOREIGN KEY (matriz_id) REFERENCES matrizes(id)
);

CREATE TABLE crias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parto_id INT,
    nome VARCHAR(50),
    peso_nascimento DECIMAL(5,2),
    data_nascimento DATE,
    FOREIGN KEY (parto_id) REFERENCES partos(id)
);

CREATE TABLE vacinas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    descricao TEXT
);

CREATE TABLE vacinas_matrizes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriz_id INT,
    vacina_id INT,
    data_aplicacao DATE,
    FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
    FOREIGN KEY (vacina_id) REFERENCES vacinas(id)
);

CREATE TABLE vacinas_crias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cria_id INT,
    vacina_id INT,
    data_aplicacao DATE,
    FOREIGN KEY (cria_id) REFERENCES crias(id),
    FOREIGN KEY (vacina_id) REFERENCES vacinas(id)
);

CREATE TABLE procedimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    descricao TEXT
);

CREATE TABLE procedimentos_matrizes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriz_id INT,
    procedimento_id INT,
    data_procedimento DATE,
    descricao TEXT,
    FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
    FOREIGN KEY (procedimento_id) REFERENCES procedimentos(id)
);

CREATE TABLE procedimentos_crias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cria_id INT,
    procedimento_id INT,
    data_procedimento DATE,
    descricao TEXT,
    FOREIGN KEY (cria_id) REFERENCES crias(id),
    FOREIGN KEY (procedimento_id) REFERENCES procedimentos(id)
);

CREATE TABLE alimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    descricao TEXT,
    tipo_alimento VARCHAR(50)
);

CREATE TABLE alimentacao_matrizes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriz_id INT,
    alimento_ID INT,
    quantidade DECIMAL(5,2),
    data_alimentacao DATE,
    FOREIGN KEY (matriz_id) REFERENCES matrizes(id),
    FOREIGN KEY (alimento_id) REFERENCES alimentos(id)
);

CREATE TABLE alimentacao_crias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cria_id INT,
    alimento_ID INT,
    quantidade DECIMAL(5,2),
    data_alimentacao DATE,
    FOREIGN KEY (cria_id) REFERENCES crias(id),
    FOREIGN KEY (alimento_id) REFERENCES alimentos(id)
);

CREATE TABLE pesagem_matrizes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriz_id INT,
    peso DECIMAL(5,2),
    data_pesagem DATE,
    FOREIGN KEY (matriz_id) REFERENCES matrizes(id)
);

CREATE TABLE pesagem_crias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cria_id INT,
    peso DECIMAL(5,2),
    data_pesagem DATE,
    FOREIGN KEY (cria_id) REFERENCES crias(id)
);

CREATE TABLE coberturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriz_id INT,
    data_cobertura DATE,
    FOREIGN KEY (matriz_id) REFERENCES matrizes(id)
);
