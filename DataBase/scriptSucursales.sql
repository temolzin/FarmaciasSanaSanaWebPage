BEGIN TRANSACTION
SET QUOTED_IDENTIFIER ON
SET ARITHABORT ON
SET NUMERIC_ROUNDABORT OFF
SET CONCAT_NULL_YIELDS_NULL ON
SET ANSI_NULLS ON
SET ANSI_PADDING ON
SET ANSI_WARNINGS ON
COMMIT
BEGIN TRANSACTION
GO
ALTER TABLE dbo.sucursales ADD
	maps text NULL,
	direccion text NULL,
	extension varchar(12) NULL
GO
ALTER TABLE dbo.sucursales SET (LOCK_ESCALATION = TABLE)
GO
COMMIT



update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3758.2463497670497!2d-99.00602468572563!3d19.616763039850593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDM3JzAwLjMiTiA5OcKwMDAnMTMuOCJX!5e0!3m2!1ses-419!2sco!4v1474127129219', 
	direccion='Central de Abastos Nave E Local 512 colonia Santa Cruz Venta de Carpio, Ecatepec de Morelos Estado de Mexico C.P.55065', 
	extension = '40005699' where nombreSucursal='512'

update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3758.2463497670497!2d-99.00602468572563!3d19.616763039850593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDM3JzAwLjMiTiA5OcKwMDAnMTMuOCJX!5e0!3m2!1ses-419!2sco!4v1474127129219', 
	direccion='Av.Central Nave E517 Colonia Santa Cruz Venta de Carpio, Ecatepec de Morelos Estado de Mexico C.P. 55065', 
	extension = '40005699' where nombreSucursal='517'

update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.463724419897!2d-99.0862746857278!3d19.478675044254622!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDI4JzQzLjIiTiA5OcKwMDUnMDIuNyJX!5e0!3m2!1ses-419!2sco!4v1473887784819', 
	direccion='Puerto Mazatlán n°95 Colonia Casas Alemán, Delegación Gustavo A. Madero, México DF C.P. 07580', 
	extension = '40005699' where nombreSucursal='Casas Alemán'

update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.6339882070115!2d-99.13723768572862!3d19.42821404585663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDI1JzQxLjUiTiA5OcKwMDgnMDYuMiJX!5e0!3m2!1ses-419!2sco!4v1473887595504', 
	direccion='5 de Febrero N°47-c colonia Centro de la Ciudad de México Area 8 Delegación Cuauhtémoc,México Distrito Federal C.P. 06080', 
	extension = '40005699' where nombreSucursal='Centro'

update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3760.0112156777877!2d-99.0361166857268!3d19.54113204226625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDMyJzI4LjEiTiA5OcKwMDInMDIuMSJX!5e0!3m2!1ses-419!2sco!4v1473887720636', 
	direccion='Boulevard de los Aztecas Mz509 Lt01 colonia Cd Azteca 1A Sección Ecatepec de Morelos Estado de México C.P. 55120', 
	extension = '40005699' where nombreSucursal='Ciudad Azteca'

update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3757.5616872441215!2d-98.99089668572523!3d19.64602803891356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDM4JzQ1LjciTiA5OMKwNTknMTkuNCJX!5e0!3m2!1ses-419!2sco!4v1473886672836', 
	direccion='Circuito Cuauhtémoc, LT02 MZ 26 colonia Ciudad Cuauhtémoc, Ecatepec de Morelos Estado de México C.P. 55067', 
	extension = '40005699' where nombreSucursal='Ciudad Cuauhtémoc'

update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.8878502025286!2d-99.02073068572882!3d19.417251046204314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDI1JzAyLjEiTiA5OcKwMDEnMDYuOCJX!5e0!3m2!1ses-419!2sco!4v1473887885876', 
	direccion='Av. Via Gustavo Baz Prada N°33 Colonia Benito Juarez Nezahualcóyotl Estado de México C.P. 57000', 
	extension = '40005699' where nombreSucursal='Ciudad Neza'

update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.8105521831453!2d-99.0945406857294!3d19.377354047467566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDIyJzM4LjUiTiA5OcKwMDUnMzIuNSJX!5e0!3m2!1ses-419!2sco!4v1473887817183', 
	direccion='Bodega E-21 Colonia Central de Abastos, Delegacion Iztapalapa Distrito Federal C.P. 09040', 
	extension = '40005699' where nombreSucursal='E21'
update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.8105521831453!2d-99.0945406857294!3d19.377354047467566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDIyJzM4LjUiTiA5OcKwMDUnMzIuNSJX!5e0!3m2!1ses-419!2sco!4v1473887817183', 
	direccion='Bodega G45 Colonia Central de Abastos Iztapalapa México DF C.P.09040',
	extension = '40005699' where nombreSucursal='GH-45'
update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3758.9667054133506!2d-99.1869426857261!3d19.58592704083648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDM1JzA5LjMiTiA5OcKwMTEnMDUuMSJX!5e0!3m2!1ses-419!2sco!4v1473887545712', 
	direccion='Valle de Eucaliptos N° 33 colonia Izcalli del Valle Tultitlán Estado de México C.P 54945', 
	extension = '40005699' where nombreSucursal='Izcalli'
update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3760.84495990069!2d-99.12733368572744!3d19.505305043407564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDMwJzE5LjEiTiA5OcKwMDcnMzAuNSJX!5e0!3m2!1ses-419!2sco!4v1473887300039', 
	direccion='La rioja N°329 colonia residencial Zacatenco delegación Gustavo A. Madero México DF C.P.07369', 
	extension = '40005699' where nombreSucursal='La Rioja'
update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3759.206006512541!2d-99.0449206857263!3d19.575673041164066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDM0JzMyLjQiTiA5OcKwMDInMzMuOCJX!5e0!3m2!1ses-419!2sco!4v1473887845118', 
	direccion='Av. Río Bravo No.1, Colonia Nuevo Laredo, Ecatepec de Morelos, Estado de México C.P. 55080', 
	extension = '40005699' where nombreSucursal='Nuevo Laredo'
update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3757.243177950464!2d-99.08297168572493!3d19.65962803847756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDM5JzM0LjYiTiA5OcKwMDQnNTAuOCJX!5e0!3m2!1ses-419!2sco!4v1473887512023', 
	direccion='Av. Prados Loc 18-19-20 Colonia Conjunto San Pablo, Tultitlán Estado de México C.P. 54930', 
	extension = '40005699' where nombreSucursal='San Pablo'
update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3756.0014119411767!2d-98.97470168572409!3d19.712564036778108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDQyJzQ1LjIiTiA5OMKwNTgnMjEuMSJX!5e0!3m2!1ses-419!2sco!4v1473873745121', 
	direccion='Av. 5 de Mayo S/N Tecámac de Felipe Villanueva centro, Tecámac Estado de México C.P 55740', 
	extension = '40005699' where nombreSucursal='Tecámac Centro'
update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3756.0161857677076!2d-98.9768666857241!3d19.71193503679834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDQyJzQzLjAiTiA5OMKwNTgnMjguOCJX!5e0!3m2!1ses-419!2sco!4v1473887253325', 
	direccion='Carretera Mexico-Pachuca KM.38.5 Loc G Colonia Tecámac de Felipe Villanueva Centro Estado de México C.P. 55740', 
	extension = '40005699' where nombreSucursal='Tecámac la Principal'
update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3752.056120581902!2d-98.82180868572141!3d19.87985203137955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDUyJzQ3LjUiTiA5OMKwNDknMTAuNiJX!5e0!3m2!1ses-419!2sco!4v1473887699930', 
	direccion='Plaza 16 de Enero S/N colonia Centro Villa de Tezontepec Estado de Hidalgo C.P. 43880', 
	extension = '40005699' where nombreSucursal='Tezontepec'
update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3757.7078729750256!2d-99.14194668572526!3d19.639783039113613!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDM4JzIzLjIiTiA5OcKwMDgnMjMuMSJX!5e0!3m2!1ses-419!2sco!4v1473887579117', 
	direccion='Casco de la Providencia S/N Nave 02 Bodega 09 y 10 colonia Ex-HDA Portales, Tultitlán Estado de México C.P.54900', 
	extension = '40005699' where nombreSucursal='Tultitlán'
update sucursales set 
	maps = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3758.8069410031235!2d-99.041075685726!3d19.592770040617893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDM1JzM0LjAiTiA5OcKwMDInMjAuMCJX!5e0!3m2!1ses-419!2sco!4v1473886591977', 
	direccion='Av. Via Morelos N°02 Colonia San Jose Jajalpa Ecatepec de Morelos Estado de México C.P. 55090', 
	extension = '40005699' where nombreSucursal='Vía Morelos'