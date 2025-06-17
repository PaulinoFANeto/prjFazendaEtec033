-- Inserção de usuários com senha hashada (password_hash)
-- Senha original informada em comentário para testes

INSERT INTO usuarios (nome, senha, email, nivel_acesso, data_cadastro) VALUES
('Lucas123', '$2y$10$uX8Lz4oyG.6Ab6wqzZBeqOJ1WmEcOsmwVkd2/.t93c0UNZFb/hvNS', 'lucas123@example.com', 1, NOW()), -- Senha: Senha@123
('Maria99', '$2y$10$ACeLq0k1XkSv6lrf2J6riOp8cZJzVzI9cznP52XdDxdNcQL84Ccfu', 'maria99@example.com', 0, NOW()), -- Senha: Maria@2024
('JoaoTech', '$2y$10$EzYYmJIR7LTV0GqVFGvqvOVuRnzIRrA.R1yUtSkYcCCxXLqA4l8RO', 'joaotech@example.com', 2, NOW()), -- Senha: JTech@2025
('AnaMendes', '$2y$10$uh2fKj41iFbeGGCk1P8AxuvdI0qcdJAnuC6a2I4hQ/T5NR95uq05C', 'anamendes@example.com', 1, NOW()), -- Senha: AnaM@1234
('CarlosX', '$2y$10$ZOVhg.Cnv9hOGfmp9i4UTOMIp8WhHOZu4WkS4ZKnTzMK2CCwK1Liq', 'carlosx@example.com', 3, NOW()); -- Senha: C@rl0sX99


-- Inserts para tabela matrizes
INSERT INTO matrizes (nome, raca, peso, data_nascimento, data_entrada, usuario_id, data_acao) VALUES
('Matilde', 'Large White', 180.5, '2022-01-10', '2022-06-15', 1, NOW()),
('Flor', 'Landrace', 175.3, '2021-12-12', '2022-05-20', 2, NOW()),
('Bela', 'Duroc', 190.7, '2022-03-05', '2022-07-10', 3, NOW()),
('Dina', 'Pietrain', 165.0, '2022-02-20', '2022-06-01', 4, NOW()),
('Sol', 'Large White', 178.9, '2022-01-25', '2022-06-22', 5, NOW());

-- Inserts para tabela partos
INSERT INTO partos (matriz_id, data_prevista_parto, data_efetiva_parto, data_prevista_desmame, data_efetiva_desmame, 
data_prevista_maternidade, data_efetiva_maternidade, qtd_crias, usuario_id, data_acao) VALUES
(1, '2023-06-01', '2023-06-05', '2023-07-01', '2023-07-02', '2023-05-20', '2023-05-22', 10, 1, NOW()),
(2, '2023-07-01', '2023-07-03', '2023-08-01', '2023-08-02', '2023-06-20', '2023-06-22', 12, 2, NOW()),
(3, '2023-08-01', NULL, '2023-09-01', NULL, '2023-07-20', '2023-07-22', 0, 3, NOW()),
(4, '2023-05-10', '2023-05-12', '2023-06-10', '2023-06-12', '2023-04-30', '2023-05-01', 9, 4, NOW()),
(5, '2023-04-20', '2023-04-22', '2023-05-20', '2023-05-22', '2023-04-10', '2023-04-12', 11, 5, NOW());

-- Inserts para tabela crias
INSERT INTO crias (parto_id, nome, raca, sexo, peso_nascimento, data_nascimento, usuario_id, data_acao) VALUES
(1, 'Leitão 01', 'Large White', 'Macho', 1.4, '2023-06-05', 1, NOW()),
(1, 'Leitão 02', 'Large White', 'Fêmea', 1.5, '2023-06-05', 1, NOW()),
(2, 'Leitão 03', 'Landrace', 'Macho', 1.3, '2023-07-03', 2, NOW()),
(2, 'Leitão 04', 'Landrace', 'Fêmea', 1.6, '2023-07-03', 2, NOW()),
(4, 'Leitão 05', 'Pietrain', 'Macho', 1.2, '2023-05-12', 4, NOW());

-- Inserts para tabela status_crias
INSERT INTO status_crias (cria_id, status, baia, peso, motivo, data_status, usuario_id, data_acao) VALUES
(1, 'Leitão', 'Baia 1', 2.1, 'Nascimento', '2023-06-05', 1, NOW()),
(2, 'Leitão', 'Baia 1', 2.0, 'Nascimento', '2023-06-05', 1, NOW()),
(3, 'Leitão', 'Baia 2', 2.2, 'Nascimento', '2023-07-03', 2, NOW()),
(4, 'Leitão', 'Baia 2', 2.3, 'Nascimento', '2023-07-03', 2, NOW()),
(5, 'Leitão', 'Baia 3', 2.0, 'Nascimento', '2023-05-12', 4, NOW());

-- Inserts para tabela baias
INSERT INTO baias (nome, descricao, capacidade, usuario_id, data_acao) VALUES
('Baia 1', 'Baia para leitões recém-nascidos', 20, 1, NOW()),
('Baia 2', 'Baia para leitões de 1 mês', 20, 2, NOW()),
('Baia 3', 'Baia para leitões de 2 meses', 15, 3, NOW()),
('Baia 4', 'Baia para marrãs', 10, 4, NOW()),
('Baia 5', 'Baia para descarte', 5, 5, NOW());

-- Inserts para tabela baia_crias
INSERT INTO baia_crias (cria_id, baia_id, data_entrada, data_saida, usuario_id, data_acao) VALUES
(1, 1, '2023-06-05', NULL, 1, NOW()),
(2, 1, '2023-06-05', NULL, 1, NOW()),
(3, 2, '2023-07-03', NULL, 2, NOW()),
(4, 2, '2023-07-03', NULL, 2, NOW()),
(5, 3, '2023-05-12', NULL, 4, NOW());

-- Inserts para tabela vacinas
INSERT INTO vacinas (nome, descricao, usuario_id, data_acao) VALUES
('Vacina A', 'Contra gripe suína', 1, NOW()),
('Vacina B', 'Contra pneumonia', 2, NOW()),
('Vacina C', 'Contra diarreia', 3, NOW()),
('Vacina D', 'Contra salmonela', 4, NOW()),
('Vacina E', 'Polivalente', 5, NOW());

-- Inserts para tabela vacinas_matrizes
INSERT INTO vacinas_matrizes (matriz_id, vacina_id, data_aplicacao, usuario_id, data_acao) VALUES
(1, 1, '2023-05-10', 1, NOW()),
(2, 2, '2023-05-15', 2, NOW()),
(3, 3, '2023-06-20', 3, NOW()),
(4, 4, '2023-05-22', 4, NOW()),
(5, 5, '2023-06-18', 5, NOW());

-- Inserts para tabela vacinas_crias
INSERT INTO vacinas_crias (cria_id, vacina_id, data_aplicacao, usuario_id, data_acao) VALUES
(1, 1, '2023-06-10', 1, NOW()),
(2, 2, '2023-06-10', 1, NOW()),
(3, 1, '2023-07-07', 2, NOW()),
(4, 3, '2023-07-07', 2, NOW()),
(5, 2, '2023-05-17', 4, NOW());

-- Inserts para tabela procedimentos
INSERT INTO procedimentos (nome, descricao, usuario_id, data_acao) VALUES
('Corte de dentes', 'Desbaste de dentes dos leitões', 1, NOW()),
('Corte de cauda', 'Corte de cauda para evitar canibalismo', 2, NOW()),
('Aplicação ferro', 'Aplicação de ferro injetável', 3, NOW()),
('Castração', 'Castração de machos', 4, NOW()),
('Pesagem', 'Pesagem mensal', 5, NOW());

-- Inserts para tabela procedimentos_matrizes
INSERT INTO procedimentos_matrizes (matriz_id, procedimento_id, data_procedimento, descricao, usuario_id, data_acao) VALUES
(1, 1, '2023-05-11', 'Corte de dentes após parto', 1, NOW()),
(2, 2, '2023-05-16', 'Corte de cauda', 2, NOW()),
(3, 3, '2023-06-21', 'Aplicação ferro', 3, NOW()),
(4, 4, '2023-05-23', 'Castração machos', 4, NOW()),
(5, 5, '2023-06-19', 'Pesagem mensal', 5, NOW());

-- Inserts para tabela procedimentos_crias
INSERT INTO procedimentos_crias (cria_id, procedimento_id, data_procedimento, descricao, usuario_id, data_acao) VALUES
(1, 1, '2023-06-06', 'Corte de dentes', 1, NOW()),
(2, 2, '2023-06-06', 'Corte de cauda', 1, NOW()),
(3, 3, '2023-07-04', 'Aplicação ferro', 2, NOW()),
(4, 4, '2023-07-04', 'Castração', 2, NOW()),
(5, 5, '2023-05-13', 'Pesagem inicial', 4, NOW());

-- Inserts para tabela alimentos
INSERT INTO alimentos (nome, descricao, tipo_alimento, usuario_id, data_acao) VALUES
('Ração Inicial', 'Ração para leitões até 10kg', 'Ração', 1, NOW()),
('Ração Crescimento', 'Ração para leitões até 20kg', 'Ração', 2, NOW()),
('Ração Final', 'Ração para terminação', 'Ração', 3, NOW()),
('Milho Moído', 'Milho triturado para mistura', 'Grão', 4, NOW()),
('Farelo de Soja', 'Proteína vegetal', 'Grão', 5, NOW());

-- Inserts para tabela alimentacao_matrizes
INSERT INTO alimentacao_matrizes (matriz_id, alimento_ID, quantidade, data_alimentacao, usuario_id, data_acao) VALUES
(1, 1, 3.5, '2023-05-12', 1, NOW()),
(2, 2, 3.8, '2023-05-17', 2, NOW()),
(3, 3, 4.0, '2023-06-22', 3, NOW()),
(4, 4, 3.2, '2023-05-24', 4, NOW()),
(5, 5, 3.9, '2023-06-20', 5, NOW());

-- Inserts para tabela alimentacao_crias
INSERT INTO alimentacao_crias (cria_id, alimento_ID, quantidade, data_alimentacao, usuario_id, data_acao) VALUES
(1, 1, 0.5, '2023-06-07', 1, NOW()),
(2, 1, 0.5, '2023-06-07', 1, NOW()),
(3, 2, 0.6, '2023-07-05', 2, NOW()),
(4, 2, 0.6, '2023-07-05', 2, NOW()),
(5, 3, 0.7, '2023-05-14', 4, NOW());

-- Inserts para tabela pesagem_matrizes
INSERT INTO pesagem_matrizes (matriz_id, peso, data_pesagem, usuario_id, data_acao) VALUES
(1, 220.5, '2023-05-13', 1, NOW()),
(2, 215.2, '2023-05-18', 2, NOW()),
(3, 230.0, '2023-06-23', 3, NOW()),
(4, 210.8, '2023-05-25', 4, NOW()),
(5, 225.7, '2023-06-21', 5, NOW());

-- Inserts para tabela pesagem_crias
INSERT INTO pesagem_crias (cria_id, peso, data_pesagem, usuario_id, data_acao) VALUES
(1, 2.2, '2023-06-08', 1, NOW()),
(2, 2.1, '2023-06-08', 1, NOW()),
(3, 2.3, '2023-07-06', 2, NOW()),
(4, 2.4, '2023-07-06', 2, NOW()),
(5, 2.0, '2023-05-15', 4, NOW());

-- Inserts para tabela coberturas
INSERT INTO coberturas (matriz_id, data_cobertura, tipo_cobertura, usuario_id, data_acao) VALUES
(1, '2023-04-01', 'Monta Natural', 1, NOW()),
(2, '2023-04-02', 'Inceminação Artificial', 2, NOW()),
(3, '2023-05-05', 'Monta Natural', 3, NOW()),
(4, '2023-03-25', 'Inceminação Artificial', 4, NOW()),
(5, '2023-05-15', 'Monta Natural', 5, NOW());

-- Inserts para tabela movimentacao_crias
INSERT INTO movimentacao_crias (cria_id, baia_origem, baia_destino, motivo, data_movimentacao, usuario_id, data_acao) VALUES
(1, 'Baia 1', 'Baia 2', 'Desmame', '2023-06-20', 1, NOW()),
(2, 'Baia 1', 'Baia 2', 'Desmame', '2023-06-20', 1, NOW()),
(3, 'Baia 2', 'Baia 3', 'Crescimento', '2023-07-20', 2, NOW()),
(4, 'Baia 2', 'Baia 3', 'Crescimento', '2023-07-20', 2, NOW()),
(5, 'Baia 3', 'Baia 4', 'Venda', '2023-06-30', 4, NOW());

-- Inserts para tabela logs
INSERT INTO logs (usuario_id, tabela, acao, data_acao) VALUES
(1, 'usuarios', 'inclusao', NOW()),
(2, 'matrizes', 'inclusao', NOW()),
(3, 'crias', 'inclusao', NOW()),
(4, 'partos', 'inclusao', NOW()),
(5, 'vacinas', 'inclusao', NOW());

-- Inserts para tabela configuracoes
INSERT INTO configuracoes (id, dia_previsto_gestacao, dia_preparacao_parto, dia_previsto_desmame, dia_aplicacao_ferro1, dia_aplicacao_ferro2, dia_desbaste_dentes, dia_desbaste_cauda, dia_aplicacao_baycox1, dia_aplicacao_baycox2, dia_comportamento, usuario_id, data_acao) VALUES
(1, 115, 110, 21, 3, 7, 1, 1, 5, 15, 1, 1, NOW());
