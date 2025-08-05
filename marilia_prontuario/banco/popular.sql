USE sistema_prontuario;

-- Inserir usuários (usuários genéricos para médicos e pacientes)
INSERT INTO usuarios (username, password) VALUES 
('drjoao', '$2y$10$abcdabcdabcdabcdabcdabcuO6xLr7Py9uXwGpNEx6XEz3yFz0mRSq'), -- senha: 123
('drmarcia', '$2y$10$abcdabcdabcdabcdabcdabcuO6xLr7Py9uXwGpNEx6XEz3yFz0mRSq'), -- senha: 123
('mariasilva', '$2y$10$abcdabcdabcdabcdabcdabcuO6xLr7Py9uXwGpNEx6XEz3yFz0mRSq'), -- senha: 123
('carlosoliveira', '$2y$10$abcdabcdabcdabcdabcdabcuO6xLr7Py9uXwGpNEx6XEz3yFz0mRSq'); -- senha: 123

-- Inserir médicos
INSERT INTO medicos (nome, especialidade, usuario_id) VALUES 
('Dr. João Souza', 'Cardiologia', 1),
('Dra. Márcia Lima', 'Dermatologia', 2);

-- Inserir pacientes
INSERT INTO pacientes (nome, data_nascimento, tipo_sanguineo, usuario_id) VALUES 
('Maria da Silva', '1990-05-10', 'O+', 3),
('Carlos Oliveira', '1985-09-22', 'A-', 4);

-- Inserir consultas
INSERT INTO consultas (id_medico, id_paciente, data_hora, observacoes) VALUES 
(1, 1, '2025-08-10 09:00:00', 'Paciente relatou dor no peito. Exame de ECG solicitado.'),
(2, 2, '2025-08-11 14:30:00', 'Paciente com irritação na pele. Prescrito pomada anti-inflamatória.'),
(1, 2, '2025-08-12 11:00:00', 'Retorno para avaliação de pressão arterial.');
