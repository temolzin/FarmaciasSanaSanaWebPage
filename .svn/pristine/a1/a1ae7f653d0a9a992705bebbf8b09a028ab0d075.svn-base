
create database FarmaciasSanaSana;

create table privilegios(id_privilegio int identity(1,1) primary key, nombrePrivilegio varchar(70));
insert into privilegios values('Administrador');
insert into privilegios values('Contabilidad');
insert into privilegios values('Compras');
insert into privilegios values('Sucursal');
insert into privilegios values('Proveedor');
insert into privilegios values('Crédito Cliente');
insert into privilegios values('Cliente');
insert into privilegios values('Close Up');
insert into privilegios values('Asistente de Dirección');

create table usuario(id_usuario int primary key IDENTITY(1,1),
nombreUsuario varchar(50),nombre varchar(30), ap_pat varchar(30),
ap_mat varchar(30),edad int, email varchar(100),
genero varchar(30)NOT NULL CHECK (genero IN('Hombre', 'Mujer')), 
telefono bigint, direccion varchar(255), password varchar(20), 
tipoUsuario int, FOREIGN KEY(tipoUsuario) REFERENCES privilegios(id_privilegio), status int);

create table sucursales(id_sucursal int primary key identity(1,1), nombreSucursal varchar(100), nombreDB varchar(100), ipSucursal varchar(255));

insert into sucursales values('512', 'dbsav512');
insert into sucursales values('517', 'dbsav517');
insert into sucursales values('E21', 'dbsavE21');
insert into sucursales values('Tultitlán', 'dbsavTultitlan');
insert into sucursales values('Centro', 'dbsavCentro');
insert into sucursales values('Nuevo Laredo', 'dbsavLaredo');
insert into sucursales values('GH-45', 'dbsavGH45');
insert into sucursales values('Casas Alemán', 'dbsavCasas');
insert into sucursales values('Tezontepec', 'dbsavTezontepec');
insert into sucursales values('Ciudad Azteca', 'dbsavAzteca');
insert into sucursales values('Ciudad Neza', 'dbsavNeza');
insert into sucursales values('San Pablo', 'dbsavSanPablo');
insert into sucursales values('La Rioja', 'dbsavRioja');
insert into sucursales values('Tecámac Centro', 'dbsavTecCen');
insert into sucursales values('Vía Morelos', 'dbsavVia');
insert into sucursales values('Ciudad Cuauhtémoc', 'dbsavCerro');
insert into sucursales values('Tecámac la Principal', 'dbsavTecLP');
insert into sucursales values('Izcalli', 'dbsavIzcalli');

create table sectores (id_sector int primary key identity(1,1),
nombreSector varchar(100), valorSector varchar(10));

insert into sectores values ('Artículos sin sector','++');
insert into sectores values ('Abarrotes','AB');
insert into sectores values ('Formulas','LE');
insert into sectores values ('Límitados','LI');
insert into sectores values ('Material de curación','MC');
insert into sectores values ('Genérico','MG');
insert into sectores values ('Ofertas Mensuales','OF');
insert into sectores values ('Medicamentos OTC','OTC');
insert into sectores values ('Pañales y toallas','PA');
insert into sectores values ('Perfumería','PE');
insert into sectores values ('Patente','PN');
insert into sectores values ('Rebotica','RE');
insert into sectores values ('Sembrado','SE');
insert into sectores values ('Suelto','SU');


create table cliente (id_cliente int primary key identity(1,1), rfc varchar(50) unique, 
email varchar(100), nombre varchar(200), curp varchar(50), calle varchar(100), numExterior int,
numInterior int, colonia varchar(50), municipio varchar(100), ciudad varchar(80), estado varchar(100),
pais varchar(80), codigoPostal varchar(30), telefono bigint);

select * from cliente;

create table factura(id_factura int primary key identity(1,1), id_cliente int, id_sucursal int, 
numTicket bigInt, tipoPago varchar(40), fecha_factura datetime,FOREIGN KEY(id_cliente) REFERENCES cliente(id_cliente),
FOREIGN KEY(id_sucursal) REFERENCES sucursales(id_sucursal));

create table facturaRealizada(id_factura int, id_usuario int, fecha_realizada datetime, FOREIGN KEY(id_factura) REFERENCES factura(id_factura),
FOREIGN KEY(id_usuario) REFERENCES usuario(id_usuario), primary key(id_factura, id_usuario));

create table accesoCliente(id_acceso int IDENTITY(1,1),
id_usuario int, FOREIGN KEY(id_usuario) REFERENCES usuario(id_usuario),
id_sucursal int, FOREIGN KEY(id_sucursal) REFERENCES sucursales(id_sucursal));

create table skuProveedor(id_usuario int, sku varchar(255), primary key(id_usuario, sku), FOREIGN KEY(id_usuario) REFERENCES usuario(id_usuario));

-- Tabla para la encuesta de la página --
create table cuestionario(id_cuestionario int identity(1,1) primary key, edad int, sexo varchar(5),
sucursal varchar(255), pregunta1 int, pregunta2 int, pregunta3a bit, pregunta3b bit, 
pregunta3c bit, pregunta3d bit, pregunta3e bit, pregunta3f bit, pregunta3g bit, 
pregunta4a int, pregunta4b int, pregunta4c int,  pregunta4d int, pregunta4e int, pregunta4f int, 
pregunta5 int, pregunta6a bit, pregunta6b bit, pregunta6c bit, pregunta6d bit, 
pregunta6e bit, pregunta6f bit, comentario varchar(255),fecha varchar(19));