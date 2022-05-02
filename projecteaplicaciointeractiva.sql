-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2022 a las 19:39:05
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `projecteaplicaciointeractiva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activitat`
--

CREATE TABLE `activitat` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcio` text COLLATE utf8_spanish_ci NOT NULL,
  `duracio` int(11) NOT NULL,
  `numero_participants` int(11) NOT NULL,
  `participants_disponibles` int(11) NOT NULL,
  `discapacitat_dirigida` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dia_hora` datetime NOT NULL,
  `preu` int(11) NOT NULL,
  `imatge` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `esta_acceptada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `activitat`
--

INSERT INTO `activitat` (`id`, `id_usuari`, `nom`, `ubicacio`, `descripcio`, `duracio`, `numero_participants`, `participants_disponibles`, `discapacitat_dirigida`, `dia_hora`, `preu`, `imatge`, `esta_acceptada`) VALUES
(1, 1, 'Pujada a Montserrat', 'Montserrat', 'Pujada a Montserrat des de Manresa. La quedada és des del Pavello Nou Congost. Activitat gratuïta. Pujarem al matí i baixarem a la tarda.', 10, 100, 1, 'tothom', '2022-04-27 10:00:00', 0, 'montserrat.jpg', 1),
(2, 2, 'Museu de xocolata', 'Barcelona', 'Visita al museu de xocolata de Barcelona. Activitat subvencionada per la Fundació de la Caixa. Adreça és Comerç, 36 Barcelona. Activitat dirigida per a tothom.', 2, 25, 25, 'tothom', '2022-04-30 00:00:00', 5, 'xocolata.jpg', 1),
(3, 5, 'Campionats de bàsquet', 'Barcelona', 'Organitzo torneig de bàsquet de cadira de rodes. Jugarem als camps de bàsquet de l\'Espanya Indústrial. Partits de 30 minuts (15 cada part).', 5, 120, 120, 'cadira de rodes', '2022-04-29 00:00:00', 0, 'basquet.jpg', 1),
(10, 2, 'Visita al MNAC', 'Barcelona', 'Visitarem el Museu Nacional d\'Art de Catalunya amb l\'historiador català Marc Pérez.', 12, 30, 15, 'tothom', '2022-05-05 10:00:00', 0, 'excursio.jpg', 1),
(11, 3, 'Pujada al Tibidado', 'Cerdanyola del Vallès', 'Pujada al Tibidado des de Collserola a Cerdanyola.', 4, 25, 22, 'sindrome de down', '2022-05-18 10:00:00', 0, 'collserola.jpg', 1),
(12, 1, 'Museu d\'història', 'Barcelona', 'Museu exposició de la Barcelona del segle XX', 1, 27, 25, 'tothom', '2022-06-14 15:30:00', 3, 'museu.jpg', 1),
(14, 5, 'Sortida a Les Golondrines', 'Barcelona', 'Sortida amb les Golondrines des del Port de Barcelona. Visitarem el litoral català.', 3, 10, 1, 'tothom', '2022-06-07 10:30:00', 0, 'maremagum.jpg', 1),
(15, 21, 'Torneig a la bolera', 'El Vendrell', 'Torneig de bolos amb medalles i trofeus. Es disputarà fase de grups, quarts, semifinals i la final.', 4, 32, 9, 'tothom', '2022-05-22 17:15:00', 0, 'bowling.jpg', 1),
(16, 32, 'Excursió a Besalú', 'Besalú', 'Visita a Besalú. Coneixerem la seva història i que amaga darrere de les seves muralles.', 7, 19, 5, 'tothom', '2022-05-24 08:45:00', 2, 'besalu.jpg', 1),
(17, 21, 'Sortida a la muntanya', 'La Molina', 'Sortirem des de plaça Catalunya de Barcelona. Agafarem els autocars i anirem a passar el dia a la muntanya. Farem diferents activitats a La Molina.', 11, 33, 22, 'tothom', '2022-05-09 06:30:00', 0, 'pirineus.jpg', 1),
(18, 8, 'La Costa Brava', 'Cadaqués', 'Visita al poble de Cadaqués. Visitarem el poble de Salvador Dalí amb el seu museu.', 2, 7, 6, 'sindrome de down', '2022-06-20 17:00:00', 0, 'cadaques.jpg', 1),
(19, 1, 'Curs de fotografia', 'Tortosa', 'Curs de fotografia realitzat conjuntament amb La Fundació de la Marbella de Tortosa.', 3, 15, 8, 'tothom', '2022-06-20 11:30:00', 0, 'fotos.jpg', 1),
(20, 1, 'Roses per Sant Jordi', 'Girona', 'Venda de roses per Sant Jordi. Ajudar a recaptar diners per la Fundació Girona.', 6, 40, 38, 'tothom', '2023-04-23 08:15:00', 0, 'santjordi.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `titol` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `text` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `faqs`
--

INSERT INTO `faqs` (`id`, `id_usuari`, `titol`, `text`) VALUES
(1, 1, 'Com puc apuntar a les activitats?', 'Per apuntar-te alguna activitat, primer de tot, t\'has de registrar a la pàgina. A continuació, selecciones l\'activitat que vols realitzar i introdueixes el nombre de participants.'),
(2, 2, 'Són totes les activitats gratuïtes?', 'Les activitats, la gran majoria, són subvencionades per associacions/fundacions, però en alguns casos tenen costos. Si no son gratuïtes es mostren a la informació de l\'activitat.'),
(3, 1, 'Que vol dir activitat per aprovar?', 'Sí, quan es crea una activitat, els administradors de la pàgina han d\'aprovar si l\'activitat creada és vàlida, o no.'),
(4, 2, 'Tenim transport adaptat?', 'Per cada activitat, es posa a disposició diferents vehicles adaptats per aquells usuaris que s\'hagin apuntat a l\'activitat. El transport, si no es diu el contrari, és subvencionat per associacions/fundacions.'),
(5, 2, 'Tenim monitors professionals?', 'Sí, a cada activitat, disposem de monitors professionals i/o voluntaris per tal que l\'activitat es desenvolupi correctament.'),
(9, 1, 'Quantes activitats puc ser-hi?', 'Es pot estar apuntat en tantes activitats com es desitgi.'),
(10, 1, 'On pago les activitats?', 'Si l\'activitat té un cost s\'ha de pagar en el lloc de la quedada.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulari_consultes`
--

CREATE TABLE `formulari_consultes` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `pregunta` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `mobil` int(11) NOT NULL,
  `dia_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `formulari_consultes`
--

INSERT INTO `formulari_consultes` (`id`, `id_usuari`, `pregunta`, `mobil`, `dia_hora`) VALUES
(21, 33, 'Les activitats poden ser nocturnes? Voldria organitzar una a la platja de La Barceloneta', 619830000, '2022-05-02 19:27:32'),
(22, 3, 'Els autocars arriben a dalt de Montserrat? Vull apuntar-me a una activitat.', 619741014, '2022-05-02 19:28:42'),
(23, 32, 'Estic registrat a la pàgina i no em deixa apuntar-me a la visita al MNAC. Queden places disponibles i no puc apuntar-me...', 611102140, '2022-05-02 19:30:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participants_apuntats`
--

CREATE TABLE `participants_apuntats` (
  `id` int(11) NOT NULL,
  `id_activitat` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `numero_participants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `participants_apuntats`
--

INSERT INTO `participants_apuntats` (`id`, `id_activitat`, `id_usuari`, `numero_participants`) VALUES
(6, 10, 1, 15),
(7, 3, 2, 30),
(8, 3, 3, 89),
(9, 3, 5, 100),
(10, 3, 8, 25),
(11, 1, 21, 10),
(12, 1, 32, 89),
(14, 11, 1, 3),
(15, 17, 32, 3),
(16, 18, 5, 1),
(17, 15, 2, 10),
(18, 17, 1, 8),
(19, 12, 32, 2),
(20, 15, 1, 10),
(21, 14, 3, 9),
(22, 19, 32, 7),
(23, 16, 3, 6),
(24, 16, 33, 5),
(25, 20, 33, 2),
(27, 16, 21, 3),
(28, 15, 33, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuari`
--

CREATE TABLE `usuari` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correu` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `contrasenya` text COLLATE utf8_spanish_ci NOT NULL,
  `localitat` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `es_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuari`
--

INSERT INTO `usuari` (`id`, `nom`, `username`, `correu`, `contrasenya`, `localitat`, `es_admin`) VALUES
(1, 'Oriol Mainou', 'oriolmainou97', 'omainou@uoc.edu', '$2y$12$J5a3io3Fqm.xPfSXy8AAn..ImvaBqLekmu4h1BbkuJwj2wLJmVKH6', 'Barcelona', 1),
(2, 'Jaume Vázquez', 'jaume0055', 'jaume0055@gmail.com', '$2y$12$J5a3io3Fqm.xPfSXy8AAn..ImvaBqLekmu4h1BbkuJwj2wLJmVKH6', 'Girona', 1),
(3, 'Jordi Berto', 'jordi97', 'jordi97@gmail.com', '$2y$12$J5a3io3Fqm.xPfSXy8AAn..ImvaBqLekmu4h1BbkuJwj2wLJmVKH6', 'Tarragona', 0),
(5, 'Judit Martinez', 'judit5', 'judit@gmail.com', '$2y$12$J5a3io3Fqm.xPfSXy8AAn..ImvaBqLekmu4h1BbkuJwj2wLJmVKH6', 'Lleida', 0),
(8, 'Xavi Oleguer', 'xavioleguer', 'xavioleguer@gmail.com', '$2y$12$P0IskE.tFXjhnuSV9pYI6OeIMnYJG/0bqzQhKg5GcPGxUV7nHQO6a', 'Castelldefels', 0),
(21, 'Anna Perez', 'annap45', 'annaperez@gmail.com', '$2y$12$C3MupY.qtd1poz8RruPwAuNxROg7DpTO8Wgncf1FIr3kcijqy8e4i', 'Palamós', 0),
(32, 'Josep Bartasar', 'jmb28', 'jf_bartasar@yahoo.es', '$2y$12$8BPhRdYppp5L3iJknCXS..BYjT3eiiIQaFZcJ/rwOywk8ZiUcJb5i', 'Calella de Palafrugell', 0),
(33, 'Oriol', 'oriol', 'oriol@gmail.com', '$2y$12$Lmiu2sMIKxfdPgo8Xa1d0.zKrIeCydn/QcqgJQVvy8ipUjsQZMnyi', 'Barcelona', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activitat`
--
ALTER TABLE `activitat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuari_activitat` (`id_usuari`);

--
-- Indices de la tabla `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuari` (`id_usuari`);

--
-- Indices de la tabla `formulari_consultes`
--
ALTER TABLE `formulari_consultes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_personas` (`id_usuari`);

--
-- Indices de la tabla `participants_apuntats`
--
ALTER TABLE `participants_apuntats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_participants_activitat_fk` (`id_activitat`),
  ADD KEY `id_participants_usuari_fk` (`id_usuari`);

--
-- Indices de la tabla `usuari`
--
ALTER TABLE `usuari`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activitat`
--
ALTER TABLE `activitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `formulari_consultes`
--
ALTER TABLE `formulari_consultes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `participants_apuntats`
--
ALTER TABLE `participants_apuntats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuari`
--
ALTER TABLE `usuari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activitat`
--
ALTER TABLE `activitat`
  ADD CONSTRAINT `id_usuari_activitat` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);

--
-- Filtros para la tabla `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_ibfk_1` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);

--
-- Filtros para la tabla `formulari_consultes`
--
ALTER TABLE `formulari_consultes`
  ADD CONSTRAINT `fk_id_personas` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);

--
-- Filtros para la tabla `participants_apuntats`
--
ALTER TABLE `participants_apuntats`
  ADD CONSTRAINT `id_participants_activitat_fk` FOREIGN KEY (`id_activitat`) REFERENCES `activitat` (`id`),
  ADD CONSTRAINT `id_participants_usuari_fk` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
