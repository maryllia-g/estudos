CREATE DATABASE prontuario;

USE prontuario;

CREATE TABLE Medico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especialidade VARCHAR(100) NOT NULL
);

CREATE TABLE Paciente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    tipo_sanguineo VARCHAR(10) NOT NULL
);

CREATE TABLE Consulta (
    id_medico INT,
    id_paciente INT,
    data_hora TIMESTAMP NOT NULL,
    observacoes TEXT,
    PRIMARY KEY (id_medico, id_paciente, data_hora),
    FOREIGN KEY (id_medico) REFERENCES Medico(id),
    FOREIGN KEY (id_paciente) REFERENCES Paciente(id)
);