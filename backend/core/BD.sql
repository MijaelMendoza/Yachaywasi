-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2024-04-23 20:14:27.89

-- tables
-- Table: Cliente
CREATE TABLE Cliente (
    cu int  NOT NULL,
    nombre varchar(50)  NOT NULL,
    ci varchar(10)  NOT NULL,
    direccion varchar(50)  NOT NULL,
    telefono varchar(50)  NOT NULL,
    correo varchar(50)  NOT NULL,
    fecha_registro date  NOT NULL,
    segmento_cliente varchar(50)  NOT NULL,
    CONSTRAINT Cliente_pk PRIMARY KEY (cu)
);

-- Table: Editorial
CREATE TABLE Editorial (
    ce int  NOT NULL,
    nombre varchar(50)  NOT NULL,
    contacto varchar(50)  NOT NULL,
    direccion varchar(50)  NOT NULL,
    telefono varchar(10)  NOT NULL,
    correo varchar(50)  NOT NULL,
    CONSTRAINT Editorial_pk PRIMARY KEY (ce)
);

-- Table: Empleado
CREATE TABLE Empleado (
    ca int  NOT NULL,
    nombre varchar(50)  NOT NULL,
    ci varchar(10)  NOT NULL,
    password varchar(30)  NOT NULL,
    direccion varchar(50)  NOT NULL,
    telefono varchar(50)  NOT NULL,
    correo varchar(50)  NOT NULL,
    cargo varchar(50)  NOT NULL,
    fecha_contratacion date  NOT NULL,
    salario int  NOT NULL,
    estado  boolean  NOT NULL,
    sucursal int  NOT NULL,
    CONSTRAINT Empleado_pk PRIMARY KEY (ca)
);

-- Table: Envios
CREATE TABLE Envios (
    cen int  NOT NULL,
    fecha_envio date  NOT NULL,
    fecha_estimada_entrega  date  NOT NULL,
    fecha_real_entrega  date  NOT NULL,
    estado  varchar(30)  NOT NULL,
    metodo varchar(50)  NOT NULL,
    costo numeric(10,2)  NOT NULL,
    direccion varchar(100)  NOT NULL,
    observaciones  varchar(500)  NOT NULL,
    pedidos int  NOT NULL,
    CONSTRAINT Envios_pk PRIMARY KEY (cen)
);

-- Table: Libros
CREATE TABLE Libros (
    cl int  NOT NULL,
    nombre varchar(50)  NOT NULL,
    genero varchar(20)  NOT NULL,
    precio numeric(10,2)  NOT NULL,
    titulo varchar(50)  NOT NULL,
    anioPublicacion int  NOT NULL,
    stock int  NOT NULL,
    editorial int  NOT NULL,
    sucursal int  NOT NULL,
    CONSTRAINT Libros_pk PRIMARY KEY (cl)
);

-- Table: Pedidos
CREATE TABLE Pedidos (
    cpe int  NOT NULL,
    cantidad int  NOT NULL,
    fecha date  NOT NULL,
    forma_pago varchar(50)  NOT NULL,
    monto numeric(10,2)  NOT NULL,
    cliente int  NOT NULL,
    sucursal int  NOT NULL,
    empleado int  NOT NULL,
    CONSTRAINT Pedidos_pk PRIMARY KEY (cpe)
);

-- Table: Pedidos_proveedores
CREATE TABLE Pedidos_proveedores (
    cpep int  NOT NULL,
    cantidad int  NOT NULL,
    fecha_pedido date  NOT NULL,
    fecha_repeccion date  NOT NULL,
    proveedores int  NOT NULL,
    CONSTRAINT Pedidos_proveedores_pk PRIMARY KEY (cpep)
);

-- Table: Proveedores
CREATE TABLE Proveedores (
    cpr int  NOT NULL,
    nombre varchar(50)  NOT NULL,
    contacto varchar(50)  NOT NULL,
    correo varchar(50)  NOT NULL,
    telefono varchar(10)  NOT NULL,
    CONSTRAINT Proveedores_pk PRIMARY KEY (cpr)
);

-- Table: Sucursal
CREATE TABLE Sucursal (
    cs int  NOT NULL,
    nombre varchar(50)  NOT NULL,
    direccion varchar(50)  NOT NULL,
    telefono varchar(10)  NOT NULL,
    correo varchar(50)  NOT NULL,
    CONSTRAINT Sucursal_pk PRIMARY KEY (cs)
);

-- Table: Ventas
CREATE TABLE Ventas (
    cv int  NOT NULL,
    fecha_venta date  NOT NULL,
    forma_pago varchar(50)  NOT NULL,
    cantidad int  NOT NULL,
    monto numeric(10,2)  NOT NULL,
    cliente int  NOT NULL,
    empleado int  NOT NULL,
    sucursal int  NOT NULL,
    CONSTRAINT Ventas_pk PRIMARY KEY (cv)
);

-- Table: detalle_pedido
CREATE TABLE detalle_pedido (
    cdo int  NOT NULL,
    libros int  NOT NULL,
    pedidos int  NOT NULL,
    CONSTRAINT detalle_pedido_pk PRIMARY KEY (cdo)
);

-- Table: detalle_venta
CREATE TABLE detalle_venta (
    cdv int  NOT NULL,
    precio_unitario int  NOT NULL,
    ventas int  NOT NULL,
    libros int  NOT NULL,
    CONSTRAINT detalle_venta_pk PRIMARY KEY (cdv)
);

-- Table: pedidos_proveedores_libros
CREATE TABLE pedidos_proveedores_libros (
    cppl int  NOT NULL,
    pedidos_proveedores int  NOT NULL,
    libros int  NOT NULL,
    CONSTRAINT pedidos_proveedores_libros_pk PRIMARY KEY (cppl)
);

-- Table: reviews
CREATE TABLE reviews (
    cr int  NOT NULL,
    ratings int  NOT NULL,
    comentario varchar(500)  NOT NULL,
    fecha_review date  NOT NULL,
    libros int  NOT NULL,
    CONSTRAINT reviews_pk PRIMARY KEY (cr)
);

-- foreign keys
-- Reference: Empleado_Sucursal (table: Empleado)
ALTER TABLE Empleado ADD CONSTRAINT Empleado_Sucursal
    FOREIGN KEY (sucursal)
    REFERENCES Sucursal (cs)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Libros_Editorial (table: Libros)
ALTER TABLE Libros ADD CONSTRAINT Libros_Editorial
    FOREIGN KEY (editorial)
    REFERENCES Editorial (ce)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Libros_Sucursal (table: Libros)
ALTER TABLE Libros ADD CONSTRAINT Libros_Sucursal
    FOREIGN KEY (sucursal)
    REFERENCES Sucursal (cs)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedidos_Empleado (table: Pedidos)
ALTER TABLE Pedidos ADD CONSTRAINT Pedidos_Empleado
    FOREIGN KEY (empleado)
    REFERENCES Empleado (ca)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedidos_Proveedores (table: Pedidos_proveedores)
ALTER TABLE Pedidos_proveedores ADD CONSTRAINT Pedidos_Proveedores
    FOREIGN KEY (proveedores)
    REFERENCES Proveedores (cpr)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedidos_Sucursal (table: Pedidos)
ALTER TABLE Pedidos ADD CONSTRAINT Pedidos_Sucursal
    FOREIGN KEY (sucursal)
    REFERENCES Sucursal (cs)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedidos_Usuarios (table: Pedidos)
ALTER TABLE Pedidos ADD CONSTRAINT Pedidos_Usuarios
    FOREIGN KEY (cliente)
    REFERENCES Cliente (cu)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Ventas_Empleado (table: Ventas)
ALTER TABLE Ventas ADD CONSTRAINT Ventas_Empleado
    FOREIGN KEY (empleado)
    REFERENCES Empleado (ca)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Ventas_Sucursal (table: Ventas)
ALTER TABLE Ventas ADD CONSTRAINT Ventas_Sucursal
    FOREIGN KEY (sucursal)
    REFERENCES Sucursal (cs)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Ventas_Usuarios (table: Ventas)
ALTER TABLE Ventas ADD CONSTRAINT Ventas_Usuarios
    FOREIGN KEY (cliente)
    REFERENCES Cliente (cu)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: detalle_pedido_Libros (table: detalle_pedido)
ALTER TABLE detalle_pedido ADD CONSTRAINT detalle_pedido_Libros
    FOREIGN KEY (libros)
    REFERENCES Libros (cl)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: detalle_pedido_Pedidos (table: detalle_pedido)
ALTER TABLE detalle_pedido ADD CONSTRAINT detalle_pedido_Pedidos
    FOREIGN KEY (pedidos)
    REFERENCES Pedidos (cpe)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: detalle_venta_Libros (table: detalle_venta)
ALTER TABLE detalle_venta ADD CONSTRAINT detalle_venta_Libros
    FOREIGN KEY (libros)
    REFERENCES Libros (cl)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: detalle_venta_Ventas (table: detalle_venta)
ALTER TABLE detalle_venta ADD CONSTRAINT detalle_venta_Ventas
    FOREIGN KEY (ventas)
    REFERENCES Ventas (cv)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: envios_Pedidos (table: Envios)
ALTER TABLE Envios ADD CONSTRAINT envios_Pedidos
    FOREIGN KEY (pedidos)
    REFERENCES Pedidos (cpe)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: pedidos_proveedores_libros_Libros (table: pedidos_proveedores_libros)
ALTER TABLE pedidos_proveedores_libros ADD CONSTRAINT pedidos_proveedores_libros_Libros
    FOREIGN KEY (libros)
    REFERENCES Libros (cl)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: pedidos_proveedores_libros_Pedidos_proveedores (table: pedidos_proveedores_libros)
ALTER TABLE pedidos_proveedores_libros ADD CONSTRAINT pedidos_proveedores_libros_Pedidos_proveedores
    FOREIGN KEY (pedidos_proveedores)
    REFERENCES Pedidos_proveedores (cpep)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: reviews_Libros (table: reviews)
ALTER TABLE reviews ADD CONSTRAINT reviews_Libros
    FOREIGN KEY (libros)
    REFERENCES Libros (cl)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- sequences
-- Sequence: Cliente_seq
CREATE SEQUENCE Cliente_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: Editorial_seq
CREATE SEQUENCE Editorial_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: Empleado_seq
CREATE SEQUENCE Empleado_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: Envios_seq
CREATE SEQUENCE Envios_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: Libros_seq
CREATE SEQUENCE Libros_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: Pedidos_proveedores_seq
CREATE SEQUENCE Pedidos_proveedores_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: Pedidos_seq
CREATE SEQUENCE Pedidos_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: Proveedores_seq
CREATE SEQUENCE Proveedores_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: Sucursal_seq
CREATE SEQUENCE Sucursal_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: Ventas_seq
CREATE SEQUENCE Ventas_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: detalle_pedido_seq
CREATE SEQUENCE detalle_pedido_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: detalle_venta_seq
CREATE SEQUENCE detalle_venta_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: pedidos_proveedores_libros_seq
CREATE SEQUENCE pedidos_proveedores_libros_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- Sequence: reviews_seq
CREATE SEQUENCE reviews_seq
      INCREMENT BY 1
      NO MINVALUE
      NO MAXVALUE
      START WITH 1
      NO CYCLE
;

-- End of file.

