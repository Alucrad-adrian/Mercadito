-- Crear la tabla 'usuario'
CREATE TABLE usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(45) NOT NULL,
    password VARCHAR(60) NOT NULL,
    nombre VARCHAR(45) NOT NULL,
    apellido1 VARCHAR(45) NOT NULL,
    apellido2 VARCHAR(45) NOT NULL,
    rol VARCHAR(45) NOT NULL,
    correo VARCHAR(60) NOT NULL,
    foto VARCHAR(255) DEFAULT NULL,
    carnet VARCHAR(20) NOT NULL,
    celular VARCHAR(20) NOT NULL,
    token VARCHAR(255) DEFAULT NULL,  -- Columna para el token de verificación
    fechaCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fechaActualizacion DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    habilitado TINYINT(1) DEFAULT 1
);

-- Crear la tabla 'puesto'
CREATE TABLE puesto (
    idpuesto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_puesto VARCHAR(45) NOT NULL,
    propietario INT,
    descripcion VARCHAR(45),
    fechaCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fechaActualizacion DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    habilitado TINYINT(1) DEFAULT 1,
    FOREIGN KEY (propietario) REFERENCES usuario(idUsuario)
);

-- Crear la tabla 'producto'
CREATE TABLE producto (
    idproducto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(45) NOT NULL,
    descripcion TEXT,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    categoria VARCHAR(45),
    imagen VARCHAR(255) DEFAULT NULL,
    stock INT DEFAULT 0,
    propietario INT,  -- Columna para el propietario del producto
    fechaCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fechaActualizacion DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    habilitado TINYINT(1) DEFAULT 1,
    FOREIGN KEY (propietario) REFERENCES usuario(idUsuario)
);

-- Crear la tabla 'pedido'
CREATE TABLE pedido (
    idpedido INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATETIME NOT NULL,
    monto_total DOUBLE NOT NULL,
    pedidocol VARCHAR(45),
    cliente INT,
    puesto INT,
    fechaCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fechaActualizacion DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    habilitado TINYINT(1) DEFAULT 1,
    FOREIGN KEY (cliente) REFERENCES usuario(idUsuario),
    FOREIGN KEY (puesto) REFERENCES puesto(idpuesto)
);

-- Crear la tabla 'detalle'
CREATE TABLE detalle (
    idpedido INT,
    cantidad INT NOT NULL,
    producto_idproducto INT NOT NULL,
    fechaCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fechaActualizacion DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    stock INT DEFAULT 0,
    FOREIGN KEY (idpedido) REFERENCES pedido(idpedido),
    FOREIGN KEY (producto_idproducto) REFERENCES producto(idproducto)
);

-- Crear la tabla 'productos_puestos'
CREATE TABLE productos_puestos (
    idproducto INT,
    idpuesto INT,
    stock INT DEFAULT 0,
    fechaCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fechaActualizacion DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    habilitado TINYINT(1) DEFAULT 1,
    FOREIGN KEY (idproducto) REFERENCES producto(idproducto),
    FOREIGN KEY (idpuesto) REFERENCES puesto(idpuesto)
);




