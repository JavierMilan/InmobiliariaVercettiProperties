-- Base de datos Vice City Realty (Vercetti Properties)
-- CREATE DATABASE IF NOT EXISTS vercetti_properties;
-- USE vercetti_properties;

-- Tabla de propietarios
CREATE TABLE propietarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100)
);

-- Tabla de propiedades
CREATE TABLE propiedades (
    id INT PRIMARY KEY AUTO_INCREMENT,
    propietario_id INT,
    titulo VARCHAR(150) NOT NULL,
    zona VARCHAR(100) NOT NULL,
    precio DECIMAL(12,2) NOT NULL,
    metros_cuadrados INT NOT NULL,
    num_habitaciones INT,
    fecha_construccion DATE NOT NULL,
    amueblada BOOLEAN DEFAULT FALSE,
    descripcion TEXT,
    imagen VARCHAR(255),
    tipo_inmueble ENUM('Casa', 'Edificio', 'Local', 'Garage') NOT NULL,
    FOREIGN KEY (propietario_id) REFERENCES propietarios(id)
);

-- Insertar propietarios
INSERT INTO propietarios (nombre, telefono, email) VALUES
('Tommy Vercetti', '555-0100', 'tommy@vercetti.vc'),
('Ken Rosenberg', '555-0101', 'ken.rosenberg@lawvc.com'),
('Avery Carrington', '555-0102', 'avery@carrington-realty.vc'),
('Colonel Cortez', '555-0103', 'cortez@military.vc'),
('Ricardo Diaz', '555-0104', 'ricardo@diaz-empire.vc'),
('Umberto Robina', '555-0105', 'umberto@cubangang.vc'),
('Auntie Poulet', '555-0106', 'poulet@haitianpower.vc'),
('Phil Cassidy', '555-0107', 'phil@explosives.vc'),
('Mitch Baker', '555-0108', 'mitch@bikers.vc'),
('Steve Scott', '555-0109', 'steve@interglobal-films.vc');

-- Insertar las 30 propiedades
INSERT INTO propiedades (propietario_id, titulo, zona, precio, metros_cuadrados, num_habitaciones, fecha_construccion, amueblada, tipo_inmueble, descripcion, imagen) VALUES
-- Propiedades originales del JSON (actualizadas con datos completos)
(1, 'Ocean View Hotel', 'Ocean Beach', 300000.00, 800, 12, '1978-05-15', TRUE, 'Edificio', 'Icónico hotel art deco en primera línea de playa. Incluye bar, piscina y vistas panorámicas al océano.', 'imagenes/propiedadesVC/oceanhotel.png'),
(1, 'Washington Beach Safehouse', 'Washington Beach', 4000.00, 45, 1, '1982-03-20', FALSE, 'Casa', 'Apartamento compacto ideal para comenzar en Vice City. Zona tranquila cerca de la playa.', 'imagenes/propiedadesVC/washington.jpg'),
(2, 'Vice Point Safehouse', 'Vice Point', 8000.00, 60, 1, '1981-07-12', TRUE, 'Casa', 'Moderno apartamento con garaje. Perfecto para profesionales.', 'imagenes/propiedadesVC/vicepoint.jpg'),
(2, 'Skumole Shack', 'Vice Point', 7000.00, 50, 1, '1979-11-30', FALSE, 'Casa', 'Cabaña estilo playero con acceso directo a la costa.', 'imagenes/propiedadesVC/skumole.jpg'),
(3, 'Links View Apartment', 'Vice Point', 6000.00, 55, 1, '1983-02-14', TRUE, 'Casa', 'Apartamento con vistas al campo de golf. Zona exclusiva.', 'imagenes/propiedadesVC/links.jpg'),
(3, 'El Swanko Casa', 'Vice Point', 8000.00, 70, 1, '1980-09-08', TRUE, 'Casa', 'Casa de lujo con piscina privada y jardín tropical.', 'imagenes/propiedadesVC/swanko.jpg'),
(4, 'Hyman Condo', 'Downtown', 14000.00, 90, 2, '1984-06-22', TRUE, 'Casa', 'Condominio en el corazón de Downtown. Ideal para ejecutivos.', 'imagenes/propiedadesVC/hyman.jpg'),
(4, '1102 Washington Street', 'Washington Beach', 3000.00, 40, 1, '1976-12-05', FALSE, 'Casa', 'Primer apartamento de Tommy Vercetti en Vice City.', 'imagenes/propiedadesVC/1102.jpg'),
(1, 'Vercetti Estate', 'Starfish Island', 1200000.00, 600, 8, '1985-04-10', TRUE, 'Casa', 'Mansión exclusiva en la isla más prestigiosa de Vice City. Piscina, helipuerto y seguridad 24/7.', 'imagenes/propiedadesVC/mansion.jpg'),
(5, 'Cherry Popper Ice Cream Factory', 'Little Havana', 20000.00, 200, NULL, '1975-08-17', FALSE, 'Local', 'Fábrica de helados totalmente equipada. Ideal para negocio.', 'imagenes/propiedadesVC/cherrypopper.jpg'),
(6, 'Sunshine Autos', 'Little Havana', 250000.00, 500, NULL, '1977-01-25', FALSE, 'Local', 'Concesionario de autos con taller mecánico y showroom.', 'imagenes/propiedadesVC/sunshine.jpg'),
(6, 'Print Works', 'Little Havana', 70000.00, 350, NULL, '1980-10-12', FALSE, 'Local', 'Imprenta industrial con maquinaria incluida.', 'imagenes/propiedadesVC/printworks.jpg'),
(1, 'Malibu Club', 'Vice Point', 120000.00, 400, NULL, '1983-05-20', TRUE, 'Local', 'Discoteca de lujo con pista de baile, barra completa y zona VIP.', 'imagenes/propiedadesVC/malibu.jpg'),
(5, 'Pole Position Club', 'Washington Beach', 400000.00, 300, NULL, '1982-11-08', TRUE, 'Local', 'Club de entretenimiento para adultos. Negocio en funcionamiento.', 'imagenes/propiedadesVC/poleposition.jpg'),
(7, 'Kaufman Cabs', 'Little Haiti', 40000.00, 250, NULL, '1978-03-15', FALSE, 'Local', 'Compañía de taxis con flota de vehículos y radio central.', 'imagenes/propiedadesVC/kaufman.jpg'),
(8, 'Boathouse', 'Vice Port', 10000.00, 150, NULL, '1976-07-30', FALSE, 'Local', 'Almacén náutico con muelle privado.', 'imagenes/propiedadesVC/boathouse.jpg'),
(10, 'InterGlobal Films', 'Prawn Island', 60000.00, 450, NULL, '1981-09-18', FALSE, 'Local', 'Estudio cinematográfico con platós y equipamiento.', 'imagenes/propiedadesVC/interglobal.jpg'),
(4, 'Downtown Safehouse', 'Downtown', 12000.00, 75, 1, '1983-12-01', TRUE, 'Casa', 'Apartamento céntrico con seguridad y parking.', 'imagenes/propiedadesVC/downtown.jpg'),
(7, 'Little Haiti Safehouse', 'Little Haiti', 9000.00, 55, 1, '1979-06-22', FALSE, 'Casa', 'Casa sencilla en barrio auténtico de Vice City.', 'imagenes/propiedadesVC/haiti.jpg'),
(9, 'Biker Bar', 'Downtown', 200000.00, 280, NULL, '1980-04-05', TRUE, 'Local', 'Bar motero con escenario para conciertos.', 'imagenes/propiedadesVC/bikerbar.jpg'),
(1, 'Empire Site – Strip Club', 'Vice Point', 300000.00, 350, NULL, '1984-02-28', TRUE, 'Local', 'Club de striptease de alto nivel. Negocio rentable.', 'imagenes/propiedadesVC/stripclub.jpg'),
(5, 'Empire Site – Drug Den', 'Little Haiti', 250000.00, 200, NULL, '1982-08-14', FALSE, 'Local', 'Propiedad comercial para negocio discreto.', 'imagenes/propiedadesVC/drugden.jpg'),
(9, 'Empire Site – Protection Racket', 'Downtown', 220000.00, 180, NULL, '1981-11-20', FALSE, 'Local', 'Local comercial en zona estratégica del centro.', 'imagenes/propiedadesVC/protection.jpg'),
(6, 'Viceport Warehouse', 'Vice Port', 350000.00, 600, NULL, '1979-05-09', FALSE, 'Local', 'Almacén portuario de gran capacidad con acceso marítimo.', 'imagenes/propiedadesVC/warehouse.jpg'),

-- 6 PROPIEDADES NUEVAS para completar las 30 requeridas
(2, 'Prawn Island Villa', 'Prawn Island', 850000.00, 420, 6, '1984-07-15', TRUE, 'Casa', 'Villa de lujo en isla privada con embarcadero propio y jardines tropicales.', 'imagenes/propiedadesVC/prawnvilla.jpg'),
(3, 'Vice Beach Penthouse', 'Ocean Beach', 500000.00, 220, 3, '1985-01-10', TRUE, 'Casa', 'Penthouse con terraza panorámica y jacuzzi. Vistas de 360 grados.', 'imagenes/propiedadesVC/penthouse.jpg'),
(8, 'Leaf Links Mansion', 'Leaf Links', 950000.00, 480, 7, '1983-09-25', TRUE, 'Casa', 'Residencia frente al campo de golf con cancha de tenis privada.', 'imagenes/propiedadesVC/leaflinks.jpg'),
(10, 'Vice Point Mall Unit', 'Vice Point', 175000.00, 120, NULL, '1982-04-18', FALSE, 'Local', 'Local comercial en centro comercial de alto tráfico.', 'imagenes/propiedadesVC/mall.jpg'),
(4, 'Downtown Parking Garage', 'Downtown', 85000.00, 300, NULL, '1980-12-12', FALSE, 'Garage', 'Estacionamiento de 3 pisos con capacidad para 50 vehículos.', 'imagenes/propiedadesVC/parking.jpg'),
(7, 'Little Havana Townhouse', 'Little Havana', 95000.00, 150, 3, '1981-03-07', TRUE, 'Casa', 'Casa adosada con patio interior y balcón. Zona familiar.', 'imagenes/propiedadesVC/townhouse.jpg');
