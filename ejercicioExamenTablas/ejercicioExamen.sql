CREATE TABLE Usuarios(
	id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    clave VARCHAR(100) NOT NULL
);

CREATE TABLE Mensaje(
    idUsuario INT NOT NULL,
    numMensaje INT PRIMARY KEY,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    texto TEXT NOT NULL
);

/*
Añadimos la restriccion para añadir la foreign key
*/

--En visual studio no sirve añadir comentarios mediante #

ALTER TABLE mensaje
ADD CONSTRAINT fk_pk_idUsuario --Nombre de la clave foranea que lo añadimos con constraint
FOREIGN KEY (idUsuario) --IdUsuario va a ser la clave foranea
REFERENCES usuarios(id) --Referenciamos la columna id en la tabla usuario
ON DELETE RESTRICT --No permite eliminar un usuario si tiene mensajes asociados
ON UPDATE RESTRICT; --No permite actualizar el id de un usuario si tiene mensajes asociados
