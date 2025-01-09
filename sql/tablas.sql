---TABLA 1---     ORDEN 1
DROP TABLE IF EXISTS Marca;
CREATE TABLE Marca (
	Id_Marca INT NOT NULL AUTO_INCREMENT,
	Nombre_Marca VARCHAR(11) NOT NULL,
	Estatus CHAR(1) DEFAULT '1',
	PRIMARY KEY(Id_Marca)
); 

----TABLA 2 --   ORDEN 2
DROP TABLE IF EXISTS Proveedor;
CREATE TABLE Proveedor(
	Folio_Proveedor VARCHAR(5) NOT NULL,
	Razon_Social VARCHAR(40) NOT NULL,
   Telefono VARCHAR(5) NOT NULL,
	PRIMARY KEY(Folio_Proveedor)
);

--- TABLA 3----  ORDEN 3
DROP TABLE IF EXISTS Rol;
CREATE TABLE Rol(
	Id_Rol INT NOT NULL AUTO_INCREMENT,
	Nombre_Rol VARCHAR(20) NOT NULL,
	PRIMARY KEY(Id_Rol)
);

--- TABLA 4----  ORDEN 4
DROP TABLE IF EXISTS Unidad;
CREATE TABLE Unidad (
	Id_Unidad INT NOT NULL AUTO_INCREMENT,
	Nombre_Unidad VARCHAR(20) NOT NULL,
	Estatus CHAR(1) DEFAULT '1',
	PRIMARY KEY(Id_Unidad)
);

---TABLA 5 --- ORDEN 5
DROP TABLE IF EXISTS Cliente;
CREATE TABLE Cliente(
	Clv_Cliente VARCHAR(5) NOT NULL,
	Nombre VARCHAR(20) NOT NULL,
	Apellido_Paterno VARCHAR(20) NOT NULL,
	Apellido_Materno VARCHAR(20) NOT NULL,
	Estatus CHAR(1) DEFAULT '1',
	PRIMARY KEY(Clv_Cliente)
);

---TABLA 6 ---- ORDEN 6
DROP TABLE IF EXISTS Categoria;
CREATE TABLE Categoria(
	Id_categoria INT NOT NULL AUTO_INCREMENT,
	Nombre_Categoria VARCHAR(20) NOT NULL,
	Estatus CHAR(1) DEFAULT '1',
	PRIMARY KEY(Id_categoria)
);

--- TABLA 7---- ORDEN 7
DROP TABLE IF EXISTS Usuario;
CREATE TABLE Usuario(
	Clv_Usuario VARCHAR(5) NOT NULL,
	Id_Rol INT NOT NULL,
	Nombre VARCHAR(20) NOT NULL,
	Apellido_Paterno VARCHAR(20) NOT NULL,
	Apellido_Materno VARCHAR(20) NOT NULL,
	Usuario_Nombre VARCHAR(10) NOT NULL,
	Contrasenia VARCHAR(10) NOT NULL,
	Estatus CHAR(1) DEFAULT '1',
	PRIMARY KEY(Clv_Usuario),
	FOREIGN KEY(Id_Rol) REFERENCES Rol(Id_Rol)
);

---Tabla 8 --- ORDEN 8
DROP TABLE IF EXISTS Sesion;
CREATE TABLE Sesion(
	Folio_Sesion VARCHAR(5) NOT NULL,
	Clv_Usuario VARCHAR(5) NOT NULL,
	Estatus CHAR(1) DEFAULT '1',
	Fecha_Hora DATETIME DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY(Folio_Sesion),
	FOREIGN KEY(Clv_Usuario) REFERENCES Usuario(Clv_Usuario)
);

---- Tabla 9---- ORDEN 9
DROP TABLE IF EXISTS Compra;
CREATE TABLE Compra(
	Folio_Compra VARCHAR(5) NOT NULL,
	Folio_Sesion VARCHAR(5) NOT NULL,
	Folio_Proveedor VARCHAR(5) NOT NULL,
	Fecha_Hora DATETIME DEFAULT CURRENT_TIMESTAMP(),
	Total DOUBLE NOT NULL,
	PRIMARY KEY(Folio_Compra),
	FOREIGN KEY(Folio_Sesion) REFERENCES Sesion(Folio_Sesion),
	FOREIGN KEY(Folio_Proveedor) REFERENCES Proveedor(Folio_Proveedor)	
);

---TABLA 10---- ORDEN 10
DROP TABLE IF EXISTS Devolucion;
CREATE TABLE Devolucion (
	Folio_Devolucion VARCHAR(5) NOT NULL,
	Folio_Sesion VARCHAR(5) NOT NULL,
	Id_categoria INT NOT NULL,
	Motivo VARCHAR(40) NOT NULL,
	Total DOUBLE NOT NULL,
	PRIMARY KEY(Folio_Devolucion),
	FOREIGN KEY(Folio_Sesion) REFERENCES Sesion(Folio_Sesion),
	FOREIGN KEY(Id_Categoria) REFERENCES Categoria(Id_Categoria)
);

----- Tabla 11 ---- ORDEN 11
DROP TABLE IF EXISTS Tipo_Dispositivo;
CREATE TABLE Tipo_Dispositivo(
	Id_Tipo_Dispositivo INT NOT NULL AUTO_INCREMENT,
	Nombre_Dispositivo VARCHAR(40) NOT NULL,
	PRIMARY KEY(Id_Tipo_Dispositivo)
);

----- Tabla 12 ----  ORDEN 12
DROP TABLE IF EXISTS Dispositivo;
CREATE TABLE Dispositivo(
	Clv_Dispositivo VARCHAR(5) NOT NULL,
	Id_Tipo_Dispositivo INT NOT NULL,
	Direccion_Mac VARCHAR(17) NOT NULL,
	PRIMARY KEY(Clv_Dispositivo),
	FOREIGN KEY(Id_Tipo_Dispositivo) REFERENCES Tipo_Dispositivo(Id_Tipo_Dispositivo)
);

-- Tabla 13 ---  ORDEN 13
DROP TABLE IF EXISTS Forma_Pago;
CREATE TABLE Forma_Pago(
	Id_Forma_Pago INT NOT NULL AUTO_INCREMENT,
	Nombre_Pago VARCHAR(30) NOT NULL,
	Descripcion VARCHAR(100) NOT NULL,
	PRIMARY KEY(Id_Forma_Pago)
);

---Tabla 14 ---- ORDEN 14
DROP TABLE IF EXISTS Pago_Compra;
CREATE TABLE Pago_Compra(
	Id_Pago_Compra INT NOT NULL AUTO_INCREMENT,
	Folio_Compra VARCHAR(5) NOT NULL,
	Cantidad DOUBLE NOT NULL,
	PRIMARY KEY(Id_Pago_Compra),
	FOREIGN KEY(Folio_Compra) REFERENCES Compra(Folio_Compra)
);

--- Tabla 15 ------ ORDEN 15
DROP TABLE IF EXISTS Producto;
CREATE TABLE Producto(
	Codigo_Barras VARCHAR(13) NOT NULL,
	Id_Marca INT NOT NULL,
	Id_Categoria INT NOT NULL,
	Id_Unidad INT NOT NULL,
	Nombre VARCHAR(30) NOT NULL,
	Estatus CHAR(1) NOT NULL DEFAULT '1',
	Precio DOUBLE NOT NULL,
	Existencia INT NOT NULL, 
	Descripcion VARCHAR(40),
	PRIMARY KEY(Codigo_Barras),
	FOREIGN KEY(Id_Marca) REFERENCES Marca(Id_Marca),
	FOREIGN KEY(Id_Categoria) REFERENCES Categoria(Id_Categoria),
	FOREIGN KEY(Id_Unidad) REFERENCES Unidad(Id_Unidad)
);


--- Tabla 16 -----  ORDEN 16
DROP TABLE IF EXISTS Conexion;
CREATE TABLE Conexion(
	Clv_Conexion VARCHAR(5) NOT NULL,
	Clv_Dispositivo VARCHAR(5) NOT NULL,
	Codigo_Barras VARCHAR(13) NOT NULL,
	Clv_Cliente VARCHAR(5) NOT NULL,
	Estatus CHAR(1) NOT NULL DEFAULT '1',
	Fecha_Inicio DATETIME DEFAULT CURRENT_TIMESTAMP(),
	Fecha_Final DATETIME DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY(Clv_Conexion),
	FOREIGN KEY(Clv_Dispositivo) REFERENCES Dispositivo(Clv_Dispositivo),
	FOREIGN KEY(Codigo_Barras) REFERENCES Producto(Codigo_Barras),
	FOREIGN KEY(Clv_Cliente) REFERENCES Cliente(Clv_Cliente)
);


--- Tabla 17 ---  ORDEN 17
DROP TABLE IF EXISTS Detalle_Compra;
CREATE TABLE Detalle_Compra(
	Id_Detalle_Compra INT NOT NULL AUTO_INCREMENT,
	Codigo_Barras VARCHAR(13) NOT NULL, 
	Folio_Compra VARCHAR(5) NOT NULL,
	Cantidad DOUBLE NOT NULL,
	Precio DOUBLE NOT NULL,
	PRIMARY KEY(Id_Detalle_Compra),
	FOREIGN KEY(Codigo_Barras) REFERENCES Producto(Codigo_Barras),
	FOREIGN KEY(Folio_Compra) REFERENCES Compra(Folio_Compra)
);

--- Tabla 19 ----
DROP TABLE IF EXISTS Detalle_Devolucion;
CREATE TABLE Detalle_Devolucion(
	Id_Detalle_Devolucion INT NOT NULL AUTO_INCREMENT,
	Codigo_Barras VARCHAR(13) NOT NULL,
	Folio_Devolucion VARCHAR(5) NOT NULL,
	Cantidad DOUBLE NOT NULL,
	PRIMARY KEY(Id_Detalle_Devolucion),
	FOREIGN KEY(Codigo_Barras) REFERENCES Producto(Codigo_Barras),
	FOREIGN KEY(Folio_Devolucion) REFERENCES Devolucion(Folio_Devolucion)
);


---- Tabla 20 ---
DROP TABLE IF EXISTS Venta;
CREATE TABLE Venta(
	Folio_Venta VARCHAR(5) NOT NULL,
	Folio_Sesion VARCHAR(5) NOT NULL,
	Clv_Cliente VARCHAR(5) NOT NULL,
	Fecha DATETIME DEFAULT CURRENT_TIMESTAMP(),
	Total DOUBLE NOT NULL,
	PRIMARY KEY(Folio_Venta),
	FOREIGN KEY(Folio_Sesion) REFERENCES Sesion(Folio_Sesion),
	FOREIGN KEY(Clv_Cliente) REFERENCES Cliente(Clv_Cliente)
);


--- Tabla 21 ---
DROP TABLE IF EXISTS Detalle_Venta;
CREATE TABLE Detalle_Venta(
	Id_Detalle_Venta INT NOT NULL AUTO_INCREMENT,
	Codigo_Barras VARCHAR(13) NOT NULL,
	Folio_Venta VARCHAR(5) NOT NULL,
	Cantidad DOUBLE NOT NULL,	
	PRIMARY KEY(Id_Detalle_Venta),
	FOREIGN KEY(Codigo_Barras) REFERENCES Producto(Codigo_Barras),
	FOREIGN KEY(Folio_Venta) REFERENCES Venta(Folio_Venta)
);

--- Tabla 22 ---
DROP TABLE IF EXISTS Operacion;
CREATE TABLE Operacion(
	Folio_Operacion VARCHAR(5) NOT NULL, 
	Folio_Sesion VARCHAR(5) NOT NULL,
	Id_Categoria INT NOT NULL,
	Monto DOUBLE NOT NULL,
	Descripcion VARCHAR(50) NOT NULL,
	Fecha DATETIME DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY(Folio_Operacion),
	FOREIGN KEY(Folio_Sesion) REFERENCES Sesion(Folio_Sesion)
);

--- Tabla 23 ---
DROP TABLE IF EXISTS Pago_Venta;
CREATE TABLE Pago_Venta(
	Id_Pago_Venta INT NOT NULL AUTO_INCREMENT,
	Folio_Venta VARCHAR(5) NOT NULL,
	Id_Forma_Pago INT NOT NULL,
	Cantidad DOUBLE NOT NULL,
	PRIMARY KEY(Id_Pago_Venta),
	FOREIGN KEY(Folio_Venta) REFERENCES Venta(Folio_Venta),
	FOREIGN KEY(Id_Forma_Pago) REFERENCES Forma_Pago(Id_Forma_Pago)
);



