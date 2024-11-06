CREATE DATABASE petshop;
USE petshop;

CREATE TABLE Usuarios (
    usuario_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,  
    contrasena VARCHAR(150) NOT NULL,  
    telefono VARCHAR(20),
    direccion VARCHAR(255),
    rol ENUM('cliente', 'veterinario', 'administrador','usuario') DEFAULT 'usuario',  
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Veterinarios (
    veterinario_id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT, 
    especialidad VARCHAR(100),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id) ON DELETE CASCADE
);

CREATE TABLE Veterinarias (
    veterinaria_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    email VARCHAR(100) UNIQUE NOT NULL,
    veterinario_id INT,  
    FOREIGN KEY (veterinario_id) REFERENCES Veterinarios(veterinario_id) ON DELETE CASCADE
);

CREATE TABLE Mascotas (
    mascota_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    especie VARCHAR(50),
    raza VARCHAR(50),
    fecha_nacimiento DATE,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES Clientes(usuario_id) ON DELETE CASCADE
);

CREATE TABLE Servicios (
    servicio_id INT PRIMARY KEY AUTO_INCREMENT,
    descripcion VARCHAR(150) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

CREATE TABLE Horarios (
    horario_id INT PRIMARY KEY AUTO_INCREMENT,
    veterinario_id INT,
    dia_semana VARCHAR(20),  
    hora_inicio TIME,
    hora_fin TIME,
    FOREIGN KEY (veterinario_id) REFERENCES Veterinarios(veterinario_id) ON DELETE CASCADE
);


CREATE TABLE Turnos (
    turno_id INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATETIME NOT NULL,
    cliente_id INT,
    mascota_id INT,
    veterinario_id INT,
    servicio_id INT,
    estado VARCHAR(50) DEFAULT 'pendiente', 
    FOREIGN KEY (cliente_id) REFERENCES Clientes(cliente_id) ON DELETE CASCADE,
    FOREIGN KEY (mascota_id) REFERENCES Mascotas(mascota_id) ON DELETE CASCADE,
    FOREIGN KEY (veterinario_id) REFERENCES Veterinarios(veterinario_id) ON DELETE CASCADE,
    FOREIGN KEY (servicio_id) REFERENCES Servicios(servicio_id) ON DELETE CASCADE
);
