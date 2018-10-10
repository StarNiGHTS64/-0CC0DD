CREATE TABLE Ninos
(
idNino numeric (5) not null,
nombre varchar(50) not null,
apellidoPaterno varchar(25) not null,
apellidoMaterno varchar(25),
sexo bit,
apodo varchar(25) not null,
fechaNacimiento date not null,
correo char(30) not null,
urlavatar char(70),
equipo numeric(3) not null
)

CREATE TABLE Ninos_Grupos
(
idNino numeric (5) not null,
idClan numeric (5) not null,
fecha date not null,
)

CREATE TABLE Ninos_Competencia
(
idNino numeric(5) not null,
idCompetencia numeric(5) not null,
valor numeric(2) not null,
)

CREATE TABLE Ninos_Maestros
(
idNino numeric(5) not null,
idMaestro numeric(5) not null,
)

CREATE TABLE Ninos_Publicacion
(
idNino numeric(5) not null,
idPublicacion numeric(5) not null,
fecha date not null,
)

CREATE TABLE Publicacion
(
idPublicacion numeric(5) not null,
titulo varchar(30) not null,
fechaPublicacion date,
urlImagen char(70) not null,
)

CREATE TABLE Maestros
(
idMaestros numeric(5) not null,
nombre varchar(50) not null,
apellidoPaterno varchar(25) not null,
apellidoMaterno varchar(25),
apodo varchar(25) not null,
correo char(30) not null,
)

CREATE TABLE Grupos
(
idClan numeric(5) not null,
nombre varchar(50) not null,
nombreAlbergue varchar(50) not null,
municipio varchar(25) not null,
idNivel numeric(5) not null,
)

CREATE TABLE Nivel
(
idNivel numeric(5) not null,
nombre varchar(50) not null,
descripcion varchar(100) not null,
)

CREATE TABLE Grupos_Maestros
(
idClan numeric(5) not null,
idMaestros numeric(5) not null,
)

CREATE TABLE Competencia
(
idCompetencia numeric(5) not null,
nombre varchar(50) not null,
descripcion varchar(100) not null,
)

CREATE TABLE Tareas
(
idMision numeric(5) not null,
nombre varchar(50) not null,
descripcion varchar(700) not null,
)

CREATE TABLE Tareas_Competencia
(
idMision numeric(5) not null,
idCompetencia numeric(5) not null,
)

CREATE TABLE PlanEstudios_Tareas
(
idPlanEstudios numeric(5) not null,
idMision numeric(5) not null,
fechaInicio date not null,
fechaTermino date not null,
)

CREATE TABLE PlanEstudios
(
idPlanEstudios numeric(5) not null,
nombre varchar(50) not null,
descripcion varchar(100) not null,
)

CREATE TABLE PlanEstudios_Grupos
(
idPlanEstudios numeric(5) not null,
idClan numeric(5) not null,
fecha date not null,
)

CREATE TABLE Historias
(
idHistorias numeric(5) not null,
titulo varchar(30) not null,
autor varchar(50) not null,
fechaPublicacion date,
descripcion varchar(2000) not null,
urlImagen char(300) not null,
)

CREATE TABLE Usuario
(
usuario varchar(25) not null,
contrasena varchar(25) not null,
)

CREATE TABLE Rol
(
idRol numeric(5) not null,
nombre varchar(50) not null,
)

CREATE TABLE Usuario_Rol
(
usuario varchar(25) not null,
idRol numeric(5) not null,
)

CREATE TABLE Privilegio
(
idPrivilegio numeric(5) not null,
nombre varchar(50) not null,
descripcion varchar(100) not null,
)

CREATE TABLE Rol_Privilegio
(
idRol numeric(5) not null,
idPrivilegio numeric(5) not null,
)

------------------------------------ASIGNAR LLAVES A LAS TABLAS-----------------------------------------------------

ALTER TABLE Ninos add constraint llaveNinos PRIMARY KEY (idNino)

ALTER TABLE Ninos_Grupos add constraint llaveNinos_Grupos PRIMARY KEY (idNino,idClan)

ALTER TABLE Ninos_Competencia add constraint llaveNinos_Competencia PRIMARY KEY (idNino,idCompetencia)

ALTER TABLE Ninos_Maestros add constraint llaveNinos_Maestros PRIMARY KEY (idNino,idMaestro)

ALTER TABLE Ninos_Publicacion add constraint llaveNinos_Publicacion PRIMARY KEY (idNino,idPublicacion)

ALTER TABLE Publicacion add constraint llavePublicacion PRIMARY KEY (idPublicacion)

ALTER TABLE Maestros add constraint llaveMaestros PRIMARY KEY (idMaestros)

ALTER TABLE Grupos add constraint llaveGrupos PRIMARY KEY (idClan)

ALTER TABLE Nivel add constraint llaveNivel PRIMARY KEY (idNivel)

ALTER TABLE Grupos_Maestros add constraint llaveGrupos_Maestros PRIMARY KEY (idClan,idMaestros)

ALTER TABLE Competencia add constraint llaveCompetencia PRIMARY KEY (idCompetencia)

ALTER TABLE Tareas add constraint llaveTareas PRIMARY KEY (idMision)

ALTER TABLE Tareas_Competencia add constraint llaveTareas_Competencia PRIMARY KEY (idMision,idCompetencia)

ALTER TABLE PlanEstudios_Tareas add constraint llavePlanEstudios_Tareas PRIMARY KEY (idPlanEstudios,idMision)

ALTER TABLE PlanEstudios add constraint llavePlanEstudios PRIMARY KEY (idPlanEstudios)

ALTER TABLE PlanEstudios_Grupos add constraint llavePlanEstudios_Grupos PRIMARY KEY (idPlanEstudios,idClan)

ALTER TABLE Historias add constraint llaveHistorias PRIMARY KEY (idHistorias)

ALTER TABLE Usuario add constraint llaveUsuario PRIMARY KEY (usuario)

ALTER TABLE Rol add constraint llaveRol PRIMARY KEY (idRol)

ALTER TABLE Usuario_Rol add constraint llaveUsuario_Rol PRIMARY KEY (usuario,idRol)

ALTER TABLE Privilegio add constraint llavePrivilegio PRIMARY KEY (idPrivilegio)

ALTER TABLE Rol_Privilegio add constraint llaveRol_Privilegio PRIMARY KEY (idRol,idPrivilegio)

   						 --Incluir llaves foráneas

ALTER TABLE Ninos_Grupos add constraint llfNinos_GruposN FOREIGN KEY (idNino) REFERENCES Ninos(idNino);
ALTER TABLE Ninos_Grupos add constraint llfNinos_GruposG FOREIGN KEY (idClan) REFERENCES Grupos(idClan);

ALTER TABLE Ninos_Competencia add constraint llfNinos_CompetenciaN FOREIGN KEY (idNino) REFERENCES Ninos(idNino);
ALTER TABLE Ninos_Competencia add constraint llfNinos_CompetenciaC FOREIGN KEY (idCompetencia) REFERENCES Competencia(idCompetencia);

ALTER TABLE Ninos_Maestros add constraint llfNinos_MaestrosN FOREIGN KEY (idNino) REFERENCES Ninos(idNino);
ALTER TABLE Ninos_Maestros add constraint llfNinos_MaestrosM FOREIGN KEY (idMaestro) REFERENCES Maestros(idMaestros);

ALTER TABLE Ninos_Publicacion add constraint llfNinos_PublicacionN FOREIGN KEY (idNino) REFERENCES Ninos(idNino);
ALTER TABLE Ninos_Publicacion add constraint llfNinos_PublicacionP FOREIGN KEY (idPublicacion) REFERENCES Publicacion(idPublicacion);

ALTER TABLE Grupos add constraint llfGruposNivel FOREIGN KEY (idNivel) REFERENCES Nivel(idNivel);

ALTER TABLE Grupos_Maestros add constraint llfGrupos_MaestrosG FOREIGN KEY (idClan) REFERENCES Grupos(idClan);
ALTER TABLE Grupos_Maestros add constraint llfGrupos_MaestrosM FOREIGN KEY (idMaestros) REFERENCES Maestros(idMaestros);

ALTER TABLE Tareas_Competencia add constraint llfTareas_CompetenciaT FOREIGN KEY (idMision) REFERENCES Tareas(idMision);
ALTER TABLE Tareas_Competencia add constraint llfTareas_CompetenciaC FOREIGN KEY (idCompetencia) REFERENCES Competencia(idCompetencia);

ALTER TABLE PlanEstudios_Tareas add constraint llfPlanEstudios_TareasPE FOREIGN KEY (idPlanEstudios) REFERENCES PlanEstudios(idPlanEstudios);
ALTER TABLE PlanEstudios_Tareas add constraint llfPlanEstudios_TareasT FOREIGN KEY (idMision) REFERENCES Tareas(idMision);

ALTER TABLE PlanEstudios_Grupos add constraint llfPlanEstudios_GruposPE FOREIGN KEY (idPlanEstudios) REFERENCES PlanEstudios(idPlanEstudios);
ALTER TABLE PlanEstudios_Grupos add constraint llfPlanEstudios_GruposG FOREIGN KEY (idClan) REFERENCES Grupos(idClan);

ALTER TABLE Usuario_Rol add constraint llfUsuario_RolU FOREIGN KEY (usuario) REFERENCES Usuario(usuario);
ALTER TABLE Usuario_Rol add constraint llfUsuario_RolR FOREIGN KEY (idRol) REFERENCES Rol(idRol);

ALTER TABLE Rol_Privilegio add constraint llfRol_PrivilegioR FOREIGN KEY (idRol) REFERENCES Rol(idRol);
ALTER TABLE Rol_Privilegio add constraint llfRol_PrivilegioP FOREIGN KEY (idPrivilegio) REFERENCES Privilegio(idPrivilegio);



------------------------------------LLENAR LAS TABLAS CON DATOS-----------------------------------------------------
set DATEFORMAT dmy;
BULK INSERT equipo03.equipo03.[Ninos]
   FROM 'e:\wwwroot\equipo03\tablas\Ninos.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	);

BULK INSERT equipo03.equipo03.[Ninos_Grupos]
   FROM 'e:\wwwroot\equipo03\tablas\Grupos-Ninos.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Ninos_Competencia]
   FROM 'e:\wwwroot\equipo03\tablas\Ninos-Competencia.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Ninos_Maestros]
   FROM 'e:\wwwroot\equipo03\tablas\Ninos-Maestros.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Ninos_Publicacion]
   FROM 'e:\wwwroot\equipo03\tablas\Ninos-Publicaciones.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

SET DATEFORMAT DMY;
BULK INSERT equipo03.equipo03.[Publicacion]
   FROM 'e:\wwwroot\equipo03\tablas\Publicaciones.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Maestros]
   FROM 'e:\wwwroot\equipo03\tablas\Maestros.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Grupos]
   FROM 'e:\wwwroot\equipo03\tablas\Grupos.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Nivel]
   FROM 'e:\wwwroot\equipo03\tablas\Nivel.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Grupos_Maestros]
   FROM 'e:\wwwroot\equipo03\tablas\Grupos-Maestros.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Competencia]
   FROM 'e:\wwwroot\equipo03\tablas\Competencias.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Tareas]
   FROM 'e:\wwwroot\equipo03\tablas\Tareas.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Tareas_Competencia]
   FROM 'e:\wwwroot\equipo03\tablas\Tareas-Competencias.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

SET DATEFORMAT DMY;
BULK INSERT equipo03.equipo03.[PlanEstudios_Tareas]
   FROM 'e:\wwwroot\equipo03\tablas\PlanEstudios-Tareas.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[PlanEstudios]
   FROM 'e:\wwwroot\equipo03\tablas\Plan de Estudios.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[PlanEstudios_Grupos]
   FROM 'e:\wwwroot\equipo03\tablas\PlanEstudios-Grupos.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Historias]
   FROM 'e:\wwwroot\equipo03\tablas\Historias.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Usuario]
   FROM 'e:\wwwroot\equipo03\tablas\Usuario.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Rol]
   FROM 'e:\wwwroot\equipo03\tablas\Rol.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Usuario_Rol]
   FROM 'e:\wwwroot\equipo03\tablas\Usuario-Rol.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Privilegio]
   FROM 'e:\wwwroot\equipo03\tablas\Privilegio.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)

BULK INSERT equipo03.equipo03.[Rol_Privilegio]
   FROM 'e:\wwwroot\equipo03\tablas\Rol-Privilegio.tsv'
   WITH
  	(
     	CODEPAGE = 'ACP',
     	FIELDTERMINATOR = '\t',
     	ROWTERMINATOR = '\n'
  	)







