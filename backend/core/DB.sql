-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2024-04-25 00:29:45.516

-- tables
-- Table: Cliente
CREATE TABLE Cliente (
    cu serial  NOT NULL,
    nombre varchar(50)  NOT NULL,
    ci varchar(10)  NOT NULL,
    direccion varchar(50)  NOT NULL,
    telefono varchar(50)  NOT NULL,
    correo varchar(50)  NOT NULL,
    fecha_registro date  NOT NULL,
    segmento_cliente varchar(50)  NOT NULL,
    estado boolean  NOT NULL,
    genero varchar(50)  NOT NULL,
    CONSTRAINT Cliente_pk PRIMARY KEY (cu)
);

-- Table: Editorial
CREATE TABLE Editorial (
    ce serial  NOT NULL,
    nombre varchar(50)  NOT NULL,
    contacto varchar(50)  NOT NULL,
    direccion varchar(50)  NOT NULL,
    telefono varchar(10)  NOT NULL,
    correo varchar(50)  NOT NULL,
    estado boolean  NOT NULL,
    CONSTRAINT Editorial_pk PRIMARY KEY (ce)
);

-- Table: Empleado
CREATE TABLE Empleado (
    ca serial  NOT NULL,
    nombre varchar(50)  NOT NULL,
    ci varchar(10)  NOT NULL,
    password varchar(30)  NOT NULL,
    direccion varchar(50)  NOT NULL,
    telefono varchar(50)  NOT NULL,
    correo varchar(50)  NOT NULL,
    cargo varchar(50)  NOT NULL,
    fecha_contratacion date  NOT NULL,
    salario int  NOT NULL,
    estado boolean  NOT NULL,
    Sucursal_cs int  NOT NULL,
    CONSTRAINT Empleado_pk PRIMARY KEY (ca)
);

-- Table: Envios
CREATE TABLE Envios (
    cen serial  NOT NULL,
    fecha_envio date  NOT NULL,
    fecha_estimada_entrega date  NOT NULL,
    fecha_real_entrega date  NOT NULL,
    estado varchar(30)  NOT NULL,
    metodo_envio varchar(50)  NOT NULL,
    costo_envio numeric(10,2)  NOT NULL,
    direccion_envio varchar(100)  NOT NULL,
    observaciones varchar(500)  NOT NULL,
    Pedidos_cpe int  NOT NULL,
    CONSTRAINT Envios_pk PRIMARY KEY (cen)
);

-- Table: Libros
CREATE TABLE Libros (
    cl serial NOT NULL,
    genero varchar(20) NOT NULL,
    precio numeric(10,2) NOT NULL,
    titulo varchar(50) NOT NULL,
    anioPublicacion int NOT NULL,
    stock int NOT NULL,
    Editorial_ce int NOT NULL,
    Sucursal_cs int NOT NULL,
    estado boolean DEFAULT true NOT NULL,
    CONSTRAINT Libros_pk PRIMARY KEY (cl)
);

-- Table: Pedidos
CREATE TABLE Pedidos (
    cpe serial  NOT NULL,
    cantidad int  NOT NULL,
    fecha date  NOT NULL,
    forma_pago varchar(50)  NOT NULL,
    monto numeric(10,2)  NOT NULL,
    Cliente_cu int  NOT NULL,
    Sucursal_cs int  NOT NULL,
    Empleado_ca int  NOT NULL,
    CONSTRAINT Pedidos_pk PRIMARY KEY (cpe)
);

-- Table: Pedidos_proveedores
CREATE TABLE Pedidos_proveedores (
    cpep serial  NOT NULL,
    cantidad int  NOT NULL,
    fecha_pedido date  NOT NULL,
    fecha_repeccion date  NOT NULL,
    Proveedores_cpr int  NOT NULL,
    CONSTRAINT Pedidos_proveedores_pk PRIMARY KEY (cpep)
);

-- Table: Proveedores
CREATE TABLE Proveedores (
    cpr serial  NOT NULL,
    nombre varchar(50)  NOT NULL,
    contacto varchar(50)  NOT NULL,
    correo varchar(50)  NOT NULL,
    telefono varchar(10)  NOT NULL,
    estado boolean  NOT NULL,
    CONSTRAINT Proveedores_pk PRIMARY KEY (cpr)
);

-- Table: Sucursal
CREATE TABLE Sucursal (
    cs serial  NOT NULL,
    nombre varchar(50)  NOT NULL,
    direccion varchar(50)  NOT NULL,
    telefono varchar(10)  NOT NULL,
    correo varchar(50)  NOT NULL,
    estado boolean  NOT NULL,
    CONSTRAINT Sucursal_pk PRIMARY KEY (cs)
);

-- Table: Ventas
CREATE TABLE Ventas (
    cv serial  NOT NULL,
    fecha_venta date  NOT NULL,
    forma_pago varchar(50)  NOT NULL,
    cantidad int  NOT NULL,
    monto numeric(10,2)  NOT NULL,
    Cliente_cu int  NOT NULL,
    Empleado_ca int  NOT NULL,
    Sucursal_cs int  NOT NULL,
    CONSTRAINT Ventas_pk PRIMARY KEY (cv)
);

-- Table: detalle_pedido
CREATE TABLE detalle_pedido (
    cdo serial  NOT NULL,
    precio_unitario numeric(10,2)  NOT NULL,
    Libros_cl int  NOT NULL,
    Pedidos_cpe int  NOT NULL,
    CONSTRAINT detalle_pedido_pk PRIMARY KEY (cdo)
);

-- Table: detalle_venta
CREATE TABLE detalle_venta (
    cdv serial  NOT NULL,
    precio_unitario numeric(10,2)  NOT NULL,
    Ventas_cv int  NOT NULL,
    Libros_cl int  NOT NULL,
    CONSTRAINT detalle_venta_pk PRIMARY KEY (cdv)
);

-- Table: pedidos_proveedores_libros
CREATE TABLE pedidos_proveedores_libros (
    cppl serial  NOT NULL,
    Pedidos_proveedores_cpep int  NOT NULL,
    Libros_cl int  NOT NULL,
    CONSTRAINT pedidos_proveedores_libros_pk PRIMARY KEY (cppl)
);

-- Table: reviews
CREATE TABLE reviews (
    cr serial  NOT NULL,
    ratings int  NOT NULL,
    comentario varchar(500)  NOT NULL,
    fecha_review date  NOT NULL,
    Libros_cl int  NOT NULL,
    CONSTRAINT reviews_pk PRIMARY KEY (cr)
);

-- foreign keys
-- Reference: Empleado_Sucursal (table: Empleado)
ALTER TABLE Empleado ADD CONSTRAINT Empleado_Sucursal
    FOREIGN KEY (Sucursal_cs)
    REFERENCES Sucursal (cs)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Libros_Editorial (table: Libros)
ALTER TABLE Libros ADD CONSTRAINT Libros_Editorial
    FOREIGN KEY (Editorial_ce)
    REFERENCES Editorial (ce)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Libros_Sucursal (table: Libros)
ALTER TABLE Libros ADD CONSTRAINT Libros_Sucursal
    FOREIGN KEY (Sucursal_cs)
    REFERENCES Sucursal (cs)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedidos_Empleado (table: Pedidos)
ALTER TABLE Pedidos ADD CONSTRAINT Pedidos_Empleado
    FOREIGN KEY (Empleado_ca)
    REFERENCES Empleado (ca)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedidos_Proveedores (table: Pedidos_proveedores)
ALTER TABLE Pedidos_proveedores ADD CONSTRAINT Pedidos_Proveedores
    FOREIGN KEY (Proveedores_cpr)
    REFERENCES Proveedores (cpr)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedidos_Sucursal (table: Pedidos)
ALTER TABLE Pedidos ADD CONSTRAINT Pedidos_Sucursal
    FOREIGN KEY (Sucursal_cs)
    REFERENCES Sucursal (cs)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Pedidos_Usuarios (table: Pedidos)
ALTER TABLE Pedidos ADD CONSTRAINT Pedidos_Usuarios
    FOREIGN KEY (Cliente_cu)
    REFERENCES Cliente (cu)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Ventas_Empleado (table: Ventas)
ALTER TABLE Ventas ADD CONSTRAINT Ventas_Empleado
    FOREIGN KEY (Empleado_ca)
    REFERENCES Empleado (ca)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Ventas_Sucursal (table: Ventas)
ALTER TABLE Ventas ADD CONSTRAINT Ventas_Sucursal
    FOREIGN KEY (Sucursal_cs)
    REFERENCES Sucursal (cs)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: Ventas_Usuarios (table: Ventas)
ALTER TABLE Ventas ADD CONSTRAINT Ventas_Usuarios
    FOREIGN KEY (Cliente_cu)
    REFERENCES Cliente (cu)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: detalle_pedido_Libros (table: detalle_pedido)
ALTER TABLE detalle_pedido ADD CONSTRAINT detalle_pedido_Libros
    FOREIGN KEY (Libros_cl)
    REFERENCES Libros (cl)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: detalle_pedido_Pedidos (table: detalle_pedido)
ALTER TABLE detalle_pedido ADD CONSTRAINT detalle_pedido_Pedidos
    FOREIGN KEY (Pedidos_cpe)
    REFERENCES Pedidos (cpe)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: detalle_venta_Libros (table: detalle_venta)
ALTER TABLE detalle_venta ADD CONSTRAINT detalle_venta_Libros
    FOREIGN KEY (Libros_cl)
    REFERENCES Libros (cl)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: detalle_venta_Ventas (table: detalle_venta)
ALTER TABLE detalle_venta ADD CONSTRAINT detalle_venta_Ventas
    FOREIGN KEY (Ventas_cv)
    REFERENCES Ventas (cv)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: envios_Pedidos (table: Envios)
ALTER TABLE Envios ADD CONSTRAINT envios_Pedidos
    FOREIGN KEY (Pedidos_cpe)
    REFERENCES Pedidos (cpe)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: pedidos_proveedores_libros_Libros (table: pedidos_proveedores_libros)
ALTER TABLE pedidos_proveedores_libros ADD CONSTRAINT pedidos_proveedores_libros_Libros
    FOREIGN KEY (Libros_cl)
    REFERENCES Libros (cl)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: pedidos_proveedores_libros_Pedidos_proveedores (table: pedidos_proveedores_libros)
ALTER TABLE pedidos_proveedores_libros ADD CONSTRAINT pedidos_proveedores_libros_Pedidos_proveedores
    FOREIGN KEY (Pedidos_proveedores_cpep)
    REFERENCES Pedidos_proveedores (cpep)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- Reference: reviews_Libros (table: reviews)
ALTER TABLE reviews ADD CONSTRAINT reviews_Libros
    FOREIGN KEY (Libros_cl)
    REFERENCES Libros (cl)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- End of file.
